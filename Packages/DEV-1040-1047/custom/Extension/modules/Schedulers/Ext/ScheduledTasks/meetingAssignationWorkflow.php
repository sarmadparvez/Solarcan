<?php
array_push($job_strings, 'meetingAssignationWorkflow');
require_once('custom/clients/base/api/AppointmentApi.php');

function meetingAssignationWorkflow()
{
    global $db;

    // get all meetings with 'waiting for assignation' status
    $meetings_query = " SELECT m.id, c.primary_address_postalcode, c.codecie_c, c.preferred_language,
                        (a.nombre_fenetres_achanger > 0) as window,
                        (a.nombre_portes_achanger > 0) as door,
                        (a.nombre_garage_achanger > 0) as garage,
                        DATE(m.timeslot_datetime) as date, m.timeslot_name AS timeslot
                        FROM meetings m
                        INNER JOIN meetings_contacts mc on mc.meeting_id = m.id AND mc.deleted = 0
                        INNER JOIN contacts c on mc.contact_id = c.id AND c.deleted = 0
                        INNER JOIN accounts_contacts ac ON ac.contact_id = c.id AND ac.deleted = 0
                        INNER JOIN accounts a ON ac.account_id = a.id AND a.deleted = 0
                        WHERE m.status = 'en_attente_dassignation'
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
            'timeslot' => $row['timeslot']
        );
        $meetings_and_reps[$row['date'].' '.$row['timeslot']]['waiting'][] = $arr;
    }

    $sales_rep_query = "SELECT c.name as classification, m.created_by, u.codecie_rep_c, u.codelangue_rep, 
                        u.qualified_doors_rep_c, u.qualified_windows_rep_c, u.qualified_garage_rep_c,
                        DATE(m.timeslot_datetime) as date, m.timeslot_name as timeslot
                        FROM meetings m
                        INNER JOIN rt_classification_users_c cu on m.created_by = cu.rt_classification_usersusers_idb AND cu.deleted =0
                        INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted =0
                        INNER JOIN users u on u.id = m.created_by
                        WHERE (m.status = 'disponible' OR m.status = 'en_attente_dassignation')
                        AND m.deleted = 0
                        AND u.deleted = 0
                        AND DATE(m.date_start) > CURDATE()
                        ORDER BY m.date_start ASC, c.name ASC";
    $result = $db->query($sales_rep_query, true, "Could not fetch sales_reps from DB");

    while($row = $db->fetchByAssoc($result)) {
        $key = $row['date'].' '.$row['timeslot'];
        if (isset($meetings_and_reps[$key])) {
            $arr = array(
                'id' => $row['created_by'],
                'classification' => $row['classification'],
                'codecie_rep_c' => $row['codecie_rep_c'],
                'codelangue_rep' => $row['codelangue_rep'],
                'door' => $row['qualified_doors_rep_c'],
                'window' => $row['qualified_windows_rep_c'],
                'garage' => $row['qualified_garage_rep_c'],
                'date' => $row['date'],
                'timeslot' => $row['timeslot']
            );
            $meetings_and_reps[$key]['reps'][] = $arr;
        }
    }

    // for each timeslot check if the available reps match remaining criterias
    foreach($meetings_and_reps as $key => $timeslot) {
        if (isset($timeslot['waiting']) && isset($timeslot['reps'])) {
            foreach($timeslot['waiting'] as $m => $meeting) {
        // Start DEV-320 : QA Portail : Postal Code: Not found in CRM
        // get first 3 characters of postalcode
            $pcode = trim($meeting['postalcode']);
            if (strlen($meeting['postalcode']) > 3) {
            $pcode = substr($pcode, 0, 3);
            }
        // get postalcode id from crm
            $s_query = new SugarQuery();
            $s_query->from(BeanFactory::newBean('rt_postal_codes'), array('team_security' => false));
            $s_query->select(array('id'));
            $s_query->where()->queryOr()
                ->equals($s_query->getFromAlias().'.name', trim($meeting['postalcode']))
                ->queryAnd()->starts($s_query->getFromAlias().'.name', $pcode)
                ->addRaw("LENGTH(".$s_query->getFromAlias().".name) = 3");
            $s_query->orderByRaw("LENGTH(".$s_query->getFromAlias().".name)");
            $pcode_id = $s_query->getOne();
        // End DEV-320 : QA Portail : Postal Code: Not found in CRM
                
        if (!empty($pcode_id)) {
                    $assigned = false;
                    foreach($timeslot['reps'] as $r => $rep) {
                        // first match all critereas to make sure this sales rep is qualified
                        if (strpos($rep['codecie_rep_c'], $meeting['codecie_c']) !== false &&
                           ($rep['codelangue_rep'] == '3' || $rep['codelangue_rep'] == $meeting['preferred_language']) &&
                           (($meeting['door'] == 1) ? ($meeting['door'] == $rep['door']) : true) &&
                           (($meeting['window'] == 1) ? ($meeting['window'] == $rep['window']) : true) &&
                           (($meeting['garage'] == 1) ? ($meeting['garage'] == $rep['garage']) : true)) {
                            // now check if this sales rep has this postal code
                            $query = "  SELECT id
                                        FROM rt_postal_codes_users_c pcu
                                        WHERE pcu.rt_postal_codes_usersusers_idb = '".$rep['id']."'
                                        AND pcu.rt_postal_codes_usersrt_postal_codes_ida = '".$pcode_id."'
                                        AND pcu.deleted = 0";
                            $result = $db->query($query, true, "Failed to check postal code from DB");
                            $row = $db->fetchByAssoc($result);
                            if ($row) {
                                // already checking for best classification sales_rep (sorted in $sales_rep_query)
                                // inside this loop means this rep can go to the postal code
                                // now just assign this sales rep the meeting and remove him from this timeslot array
                                if (!reachedDailyLimit($rep['id'], explode(' ', $key)[0])
                                    && !reachedWeeklyLimit($rep['id'], explode(' ', $key)[0])
                                    ) {
                                    $meetingBean = BeanFactory::newBean('Meetings')->retrieve($meeting['id']);
                                    $meetingBean->status = 'assigne';
                                    $meetingBean->assigned_user_id = $rep['id'];
                                    $meetingBean->save();
                                    $GLOBALS['log']->fatal("Meeting $meetingBean->id is assinged to User ".$rep['id']." $r");
                                    unset($timeslot['reps'][$r]);
                                    $assigned = true;
                                    // send assignment notification        
                                    $admin = Administration::getSettings();
                                    $appointment_api = new AppointmentApi();
                                    $notify_list = $appointment_api->get_notification_recipients(
                                        $meetingBean
                                    );
                                    foreach ($notify_list as $notify_user)
                                    {
                                        $meetingBean->send_assignment_notifications($notify_user, $admin);
                                    }
        
                                } else {
                                    $GLOBALS['log']->fatal("Daily/Weekly Limit reached for User => ".$rep['id']." $r". " meeting_id: ".$meeting['id']);
                                }
                            }
                            if ($assigned) break;
                        }
                    }
                } else {
                    $GLOBALS['log']->fatal("Could not find Postal Code ".$meeting['postalcode']." in system");
                }
            }
        }
    }

    return true;
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
