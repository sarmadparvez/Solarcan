<?php
array_push($job_strings, 'meetingAssignationWorkflow');
require_once('custom/clients/base/api/AppointmentApi.php');

function meetingAssignationWorkflow()
{
    global $db;

    // get all meetings with 'waiting for assignation' = 1 and status = 'disponsible'(available)
    // the meetings should have a contact assoicated with them
    // also get the classification of user to use later to find a better qualified user
    $meetings_query = " SELECT m.id, c.primary_address_postalcode, c.codecie_c, c.preferred_language,
                        m.assigned_user_id,
                        (a.nombre_fenetres_achanger > 0) as window,
                        (a.nombre_portes_achanger > 0) as door,
                        (a.nombre_garage_achanger > 0) as garage,
                        DATE(m.timeslot_datetime) as date, m.timeslot_name AS timeslot,
                        rc.name as class
                        FROM meetings m
                        INNER JOIN meetings_contacts mc on mc.meeting_id = m.id AND mc.deleted = 0
                        INNER JOIN contacts c on mc.contact_id = c.id AND c.deleted = 0
                        INNER JOIN accounts_contacts ac ON ac.contact_id = c.id AND ac.deleted = 0
                        INNER JOIN accounts a ON ac.account_id = a.id AND a.deleted = 0
                        LEFT JOIN rt_classification_users_c rc_m ON 
                        m.assigned_user_id = rc_m.rt_classification_usersusers_idb
                        AND rc_m.deleted = 0
                        LEFT JOIN rt_classification rc ON 
                        rc.id = rc_m.rt_classification_usersrt_classification_ida
                        AND rc.deleted = 0
                        WHERE m.status = 'disponible'
                        AND m.waiting_for_assignation = 1
                        AND m.deleted = 0
                        AND c.deleted = 0
                        AND DATE(m.timeslot_datetime) > CURDATE()
                        ORDER BY m.date_start ASC";
    $result = $db->query($meetings_query, true, "Could not fetch 'en_attente_dassignation' meetings from DB");

    // collect in array according to sorted date_start index
    $meetings_and_reps = array();
    while($row = $db->fetchByAssoc($result)) {
        $arr = array(
            'id' => $row['id'],
            'codecie_c' => $row['codecie_c'],
            'preferred_language' => ($row['preferred_language'] == 'francais') ? '1' : '2',
            'postalcode' => $row['primary_address_postalcode'],
            'window' => $row['window'],
            'door' => $row['door'],
            'garage' => $row['garage'],
            'date' => $row['date'],
            'timeslot' => $row['timeslot'],
            'classification' => !empty($row['class']) ? $row['class'] : ''
        );
        //$meetings_and_reps[$row['date'].' '.$row['timeslot']]['waiting'][] = $arr;
        $rep_data = getQualifiedRepsForSlot($arr, $arr['assigned_user_id']);
        $GLOBALS['log']->fatal('rep_data: '.print_r($rep_data , 1));
        // if a more qualified rep found
        if (!empty($rep_data)) {
            // Book this rep's meeting

            //1. Fetch the new qualified meeting bean with id $rep_data[0]['meeting_id']
            //2. Fetch the old qualified meeting bean with id $row['id']
            //3. Copy old meeting bean attributes to new meeting bean attributes e.g contact rel, opp rel
            // tel marketer rep and all those fields which are synced from portal to sugar for meeting
            //4. Revert attributes for old meeting and break the realtionships, revert waiting_for_assignation to 0
                    
            /**
             DO YOUR CODE HERE... Continue from here
            */
            $meetingBean = BeanFactory::newBean('Meetings')->retrieve($rep_data[0]['meeting_id']);
            $oldMeetingBean = BeanFactory::newBean('Meetings')->retrieve($row['id']);
            $meetingBean->financement = $oldMeetingBean->financement;
            $meetingBean->description = $oldMeetingBean->description;
            $meetingBean->partenaire_info = $oldMeetingBean->partenaire_info;
            $meetingBean->potential_sales = $oldMeetingBean->potential_sales;
            $meetingBean->status = 'assigne';
            $meetingBean->waiting_for_assignation = 0;
			$meetingBean->save();
            // link new meeting with contact, account, opportunity and telemarketar linked to old meeting
            $link = 'contacts';

            if ($meetingBean->load_relationship($link)) {
                $meetingBean->$link->add($oldMeetingBean->contact_id);
            }
            $link = 'meeting_telemarketer';
            if ($meetingBean->load_relationship($link)) {
                $meetingBean->$link->add($oldMeetingBean->telemarketer_id);
            }
			$contactBean = BeanFactory::newBean('Contacts')->retrieve($oldMeetingBean->contact_id);
            $link = 'accounts';
            if ($meetingBean->load_relationship($link)) {
                $meetingBean->$link->add($contactBean->account_id);
            }
            $link = 'opportunity';
            if ($meetingBean->load_relationship($link)) {
                $meetingBean->$link->add($oldMeetingBean->parent_id);
            }			
			// update the old meeting fields and unlink from contact, account, opportunity and telemarketar
            $link = 'contacts';

            if ($oldMeetingBean->load_relationship($link)) {
                $oldMeetingBean->$link->delete($oldMeetingBean->id,$oldMeetingBean->contact_id);
            }
            $oldMeetingBean->telemarketer_id = '';
            $oldMeetingBean->parent_id = '';
            $oldMeetingBean->parent_type = '';
            $oldMeetingBean->financement = '';
            $oldMeetingBean->description = '';
            $oldMeetingBean->partenaire_info = '';
            $oldMeetingBean->potential_sales = 0;
            $oldMeetingBean->status = 'disponible';
            $oldMeetingBean->waiting_for_assignation = 0;
            $oldMeetingBean->save();
            
        } else {
            // just change the status for the meeting as this is already best qualified sales rep
            // for the meting
            $meetingBean = BeanFactory::newBean('Meetings')->retrieve($row['id']);
            $meetingBean->status = 'assigne';
            $meetingBean->waiting_for_assignation = 0;
            $meetingBean->save();
        }

        // send assignment notification
        if (!empty($meetingBean)) {
            $admin = Administration::getSettings();
            $appointment_api = new AppointmentApi();
            $notify_list = $appointment_api->get_notification_recipients(
                $meetingBean
            );
            foreach ($notify_list as $notify_user)
            {
                $meetingBean->send_assignment_notifications($notify_user, $admin);
            }
            unset($meetingBean);
        }
    }

    return true;
}

    /**
    * Given a meeting slot information ($meeting_data), get a more qualifed rep then the passed $user_id
    * @param array $meeting_data an array containing timeslot information
    * @param string $user_id id of the sales rep to exclude and find a more qualified one
    */

    function getQualifiedRepsForSlot($meeting_data, $user_id)
    {
        $db = DBManagerFactory::getInstance();
        $timedate = Timedate::getInstance();
        $sugar_config = SugarConfig::getInstance();
        $start_time_before = $sugar_config->get('appointment_config')['appointments_upto'];
        // if length of postal code is greater than 3, do a complete match, otherwise if its 3
        // just match first 3 charcters

        $postalcode = trim($meeting_data['postalcode']);
        if (strlen($meeting_data['postalcode']) > 3) {
            $postalcode = substr($postalcode, 0, 3);
        }
        //get language code for codelangue_rep field in users from the arguments
        if ($meeting_data['preferred_language'] == '1') {
            $lang_code = array('1', '3'); //french , bilingual
        } elseif ($meeting_data['preferred_language'] == '2') {
            $lang_code = array('2', '3'); //english, bilingual
        }

        // following query will get sorted users by classification in ascending order
        // if a user is not in any classification then they are not considered available
        // returned in following order Classification: A, then B, then C, then D, then none
        // only get those users who have this postal code in their
        // related postal codes AND exclude those sales reps who have meeting assiged to them already
        // on this specific date and timeslot (this avoids reassigning to same sales rep)
        $query = "SELECT u.id, m.id as meeting_id, m.status as status
                    FROM users u
                    INNER JOIN rt_postal_codes_users_c pcu 
                    ON pcu.rt_postal_codes_usersusers_idb = u.id
                    AND u.deleted = 0
                    INNER JOIN rt_postal_codes rpc
                    ON rpc.id = pcu.rt_postal_codes_usersrt_postal_codes_ida
                    AND rpc.deleted = 0
                    AND ((rpc.name = ".$db->quoted($meeting_data['postalcode']).")
                    OR ((LENGTH(rpc.name) = 3)
                    AND (rpc.name LIKE ".$db->quoted($postalcode.'%').")))
                    INNER JOIN rt_classification_users_c cu on u.id = cu.rt_classification_usersusers_idb AND cu.deleted = 0
                    INNER JOIN rt_classification rc on cu.rt_classification_usersrt_classification_ida = rc.id AND rc.deleted = 0
                    AND rc.name < ".$db->quoted($meeting_data['classification'])."
                    INNER JOIN meetings m ON u.id = m.assigned_user_id
                    AND m.waiting_for_assignation = 0
                    AND m.status = 'disponible'
                    AND m.deleted = 0 
                    AND DATE(m.timeslot_datetime) = ".$db->quoted($meeting_data['date'])."
                    AND m.timeslot_name = ".$db->quoted($meeting_data['timeslot'])."
                    AND u.codecie_rep_c LIKE '%".$meeting_data['codecie_c']."%'
                    AND u.codelangue_rep IN ('".implode("','", $lang_code)."')";

        if (!empty($meeting_data['door']) &&
            (int) $meeting_data['door'] > 0) {
            $query .= " AND u.qualified_doors_rep_c = 1 ";
        }
        if (!empty($meeting_data['window']) &&
            (int) $meeting_data['window'] > 0) {
            $query .= " AND u.qualified_windows_rep_c = 1 ";
        }
        if (!empty($meeting_data['garage']) &&
            (int) $meeting_data['garage'] > 0) {
            $query .= " AND u.qualified_garage_rep_c = 1 ";
        }

        // left join with the result set containing users whose daily limit is reached for this timeslot
        // to get only those whose day limit is not reached by placing a NULL check in where part
        $query.= "
            left join
            (select 
                u.id as user_id,
                    count(m.id) as count_for_day,
                    DATE(m.timeslot_datetime) as dateonly,
                    rt_c.appointment_per_day
            from
                users u
            inner join rt_classification_users_c rt_c_u ON u.id = rt_c_u.rt_classification_usersusers_idb
                AND rt_c_u.deleted = 0
            inner join rt_classification rt_c ON rt_c.id = rt_c_u.rt_classification_usersrt_classification_ida
                AND rt_c.deleted = 0
            inner join meetings m ON u.id = m.assigned_user_id
                AND (m.status = 'assigne' OR m.waiting_for_assignation = 1)
                AND m.deleted = 0
                AND u.status = 'Active'
                AND m.timeslot_datetime IS NOT NULL
                AND DATE(m.timeslot_datetime) = ".$db->quoted($meeting_data['date'])." 
            group by u.id , DATE(m.timeslot_datetime)
            HAVING count_for_day >= rt_c.appointment_per_day) day_limits 
            ON u.id = day_limits.user_id
                AND DATE(m.timeslot_datetime) = day_limits.dateonly ";

        // left join with the result set containing users whose weekly limit is reached to get only those
        // whose weekly limit is not reached by placing a NULL check in where part
        $query.="        
            left join
            (select 
                u.id as user_id,
                    count(m.id) as count_for_week,
                    DATE_ADD(DATE(m.timeslot_datetime), INTERVAL (- WEEKDAY(DATE(m.timeslot_datetime))) DAY) as week_of,
                    rt_c.max_appointment_per_week
            from
                users u
            inner join rt_classification_users_c rt_c_u ON u.id = rt_c_u.rt_classification_usersusers_idb
                AND rt_c_u.deleted = 0
            inner join rt_classification rt_c ON rt_c.id = rt_c_u.rt_classification_usersrt_classification_ida
                AND rt_c.deleted = 0
            inner join meetings m ON u.id = m.assigned_user_id
                AND (m.status = 'assigne' OR m.waiting_for_assignation = 1)
                AND m.deleted = 0
                AND u.status = 'Active'
                AND m.timeslot_datetime IS NOT NULL
                AND DATE(m.timeslot_datetime) >= DATE_ADD(DATE(".$db->quoted($meeting_data['date'])."), INTERVAL (- WEEKDAY(DATE(".$db->quoted($meeting_data['date'])."))) DAY) 
                AND DATE(m.timeslot_datetime) <= ".$db->quoted($start_time_before)."
            group by u.id , DATE_ADD(DATE(m.timeslot_datetime), INTERVAL (- WEEKDAY(DATE(m.timeslot_datetime))) DAY)
            HAVING count_for_week >= rt_c.max_appointment_per_week) week_limits 
            ON u.id = week_limits.user_id
                AND DATE_ADD(DATE(m.timeslot_datetime),
                INTERVAL (- WEEKDAY(DATE(m.timeslot_datetime))) DAY) = week_limits.week_of ";

            $query.= " WHERE
                day_limits.user_id IS NULL
                AND week_limits.user_id IS NULL";

        $query .= " ORDER BY rpc.name ASC LIMIT 1";

        $GLOBALS['log']->fatal('queryy: '.$query);
        $stmt = $db->getConnection()->executeQuery($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    /**
     * Given a user id, return if daily limit reached or not
     */
    function reachedDailyLimit($user_id, $dateToCheck)
    {
        if (empty($user_id)) return true;
        $query = "SELECT u.id, count(u.id) as assigned, c.appointment_per_day as maximum
                  FROM users u 
                  INNER JOIN meetings m ON u.id = m.assigned_user_id
                  INNER JOIN rt_classification_users_c cu on u.id = cu.rt_classification_usersusers_idb AND cu.deleted = 0
                  INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted = 0
                  WHERE u.deleted = 0 AND m.deleted = 0
                  AND u.id = '$user_id'
                  AND DATE(m.timeslot_datetime) = '$dateToCheck'
                  GROUP BY u.id
                  HAVING assigned >= maximum;";
        $result = $GLOBALS['db']->query($query, true, 'Meeting Assignation WF::Failed to get daily limit');
        $row = $GLOBALS['db']->fetchByAssoc($result);
        if ($row && !empty($row['id'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Given a user id, return true or false based on weekly limit reached or not
     * @param string $user_id
     * @param string date_to_check the date for which the week limit needs to be checked
     */
    function reachedWeeklyLimit($user_id, $date_to_check)
    {
        $db = DBManagerFactory::getInstance();

        $s_query = new SugarQuery();
        $s_query->from(BeanFactory::newBean('Users'), array('team_security' => false));
        $s_query->select(
            array(
                array($s_query->getFromAlias().'.id', 'user_id'),
            )
        );
        $s_query->select()->fieldRaw('rt_c.max_appointment_per_week', 'max_appointment_per_week');
        $s_query->select()->fieldRaw('count(m.id)', 'count_for_week');

        // join with user classfication middle table
        $s_query->joinTable(
            'rt_classification_users_c',
            array(
                'alias' => 'rt_c_u',
                'joinType' => 'INNER',
                'linkingTable' => true
            )
        )->on()
            ->equalsField(
                $s_query->getFromAlias().'.id',
                'rt_c_u.rt_classification_usersusers_idb'
            )
            ->equals('rt_c_u.deleted', 0)
            ->equals($s_query->getFromAlias().'.status', 'Active');

        // join with user classfication table
        $s_query->joinTable(
            'rt_classification',
            array(
                'alias' => 'rt_c',
                'joinType' => 'INNER',
                'linkingTable' => true
            )
        )->on()
            ->equalsField(
                'rt_c.id',
                'rt_c_u.rt_classification_usersrt_classification_ida'
            )
            ->equals('rt_c.deleted', 0);

        // join with meetings
        $s_query->joinTable(
            'meetings',
            array(
                'alias' => 'm',
                'joinType' => 'INNER',
                'linkingTable' => true
            )
        )->on()
            ->equalsField(
                'm.assigned_user_id',
                $s_query->getFromAlias().'.id'
            )
            ->notNull('m.timeslot_datetime')
            ->equals('m.deleted', 0)
            ->addRaw(
                'DATE(m.timeslot_datetime) >= DATE_ADD('.$db->quoted($date_to_check).',
                INTERVAL(-WEEKDAY('.$db->quoted($date_to_check).')) DAY)
                AND DATE(m.timeslot_datetime) <= DATE_ADD('.$db->quoted($date_to_check).',
                INTERVAL(7-DAYOFWEEK('.$db->quoted($date_to_check).')) DAY)'
            );
        $s_query->where()->equals($s_query->getFromAlias().'.id', $user_id);
        $s_query->groupBy($s_query->getFromAlias().'.id');
        $s_query->havingRaw('count_for_week >= max_appointment_per_week');
        
        $result = $s_query->execute();
        if (!empty($result)) {
            if ($result[0]['user_id'] == $user_id) {
                return true;
            }
        }
        return false;
    }
