<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */
require_once 'custom/include/helpers/UtHelper.php';

class AppointmentApi extends SugarApi
{
    use UtHelper;

    public function registerApiRest()
    {
        return array(
            'getAvailableAppointments' => array(
                'reqType' => 'POST',
                'path' => array('<module>','getAvailableAppointments'),
                'pathVars' => array('module',''),
                'method' => 'getAvailableAppointments',
                'shortHelp' => 'Returns available appointments by sales reps by postal code'
            ),
            'bookAppointment' => array(
                'reqType' => 'POST',
                'path' => array('<module>', 'bookAppointment'),
                'pathVars' => array('module', ''),
                'method' => 'bookAppointment',
                'shortHelp' => 'Book appointment for contact',
            ),
            'saveAppointmentConfig' => array(
                'reqType' => 'POST',
                'path' => array('save_appointment_config'),
                'pathVars' => array(''),
                'method' => 'saveAppointmentConfig',
                'shortHelp' => 'Stores appointment related configuration in sugar config',
            ),
            'getAppointmentConfig' => array(
                'reqType' => 'GET',
                'path' => array('get_appointment_config'),
                'pathVars' => array(''),
                'method' => 'getAppointmentConfig',
                'shortHelp' => 'Stores appointment related configuration in sugar config',
            ),
            'saveInfoandAccount' => array(
                'reqType' => 'POST',
                'path' => array('<module>', 'saveInfoandAccount'),
                'pathVars' => array('module', 'saveInfoandAccount'),
                'method' => 'saveInfoandAccount',
                'shortHelp' => 'Save Contact and Batiment information',
            ),
        );
    }

    /**
     * Get available appointments based on postal code
     *
     * @param ServiceBase $api
     * @param array $args API arguments
     *
     */
    public function getAvailableAppointments(ServiceBase $api, array $args)
    {
        $this->requireArgs(
            $args,
            array(
                'postalcode','preferred_language_1', 'preferred_language_2', 'codecie_c', 'categories'
            )
        );
        $db = DBManagerFactory::getInstance();
        $postalcode = trim($args['postalcode']);
        if (strlen($args['postalcode']) > 3) {
            $postalcode = substr($postalcode, 0, 3);
        }

        //get language code for codelangue_rep field in users from the arguments
        if ($args['preferred_language_1'] == 'true' && $args['preferred_language_2'] == 'true') {
            $lang_code = array('1', '2', '3'); //french , english, bilingual
        } elseif ($args['preferred_language_1'] == 'true') {
            $lang_code = array('1', '3'); //french, bilingual
        } else {
            $lang_code = array('2', '3'); //english, bilingual
        }
        $categories_where = $this->getCategoryWhere('pc_u', $args['categories']);

        // meeting start time should be after and before the hours and datetime saved in config
        $x_hours = $this->getSugarConfig()->get('appointment_config')['x_hours'];
        $start_time_before = $this->getSugarConfig()->get('appointment_config')['appointments_upto'];
        $start_time_after = $this->getTimeDate()->getNow()->modify('+'.$x_hours.'hours')->asDb();
        // query to get available appointments based on postal code

        // Get available appointments by excluding those appointments/users for whom daily or weekly limit is
        // reached
        $sql = "
            SELECT 
                rt_postal_codes.name postalcode,
                m.id meeting_id,
                m.timeslot_name timeslot,
                count(distinct m.id) available_count,
                DAYNAME(m.timeslot_datetime) dayname,
                DATE(m.timeslot_datetime) dateonly
            FROM
                rt_postal_codes
                    INNER JOIN
                rt_postal_codes_users_c rt_postal_codes_users ON (rt_postal_codes.id = rt_postal_codes_users.rt_postal_codes_usersrt_postal_codes_ida)
                    AND (rt_postal_codes_users.deleted = 0)
                    INNER JOIN
                users pc_u ON (pc_u.id = rt_postal_codes_users.rt_postal_codes_usersusers_idb)
                    AND (pc_u.deleted = 0)
                    AND (pc_u.status = 'Active')
                    AND (pc_u.codelangue_rep IN ('".implode("','", $lang_code)."') )
                    AND (pc_u.codecie_rep_c LIKE '%".$args['codecie_c']."%')
                    AND ((rt_postal_codes.name = ".$db->quoted($args['postalcode']).")
                    OR ((LENGTH(rt_postal_codes.name) = 3)
                    AND (rt_postal_codes.name LIKE ".$db->quoted($postalcode.'%').")))
                    INNER JOIN
                meetings m ON (m.assigned_user_id = pc_u.id)
                    AND (m.date_start > ".$db->quoted($start_time_after).")
                    AND (m.date_start < ".$db->quoted($start_time_before).")
                    AND (m.status = 'disponible')
                    AND m.waiting_for_assignation = 0
                    AND (m.deleted = 0)
                    inner join
                rt_classification_users_c u_c ON pc_u.id = u_c.rt_classification_usersusers_idb
                    AND u_c.deleted = 0 ";
        // left join with the result set containing users whose daily limit is reached to get only those
        // whose day limit is not reached by placing a NULL check in where part
        $sql.= "
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
                AND DATE(m.timeslot_datetime) >= ".$db->quoted($this->getTimeDate()->nowDbDate())."
                AND DATE(m.timeslot_datetime) <= ".$db->quoted($start_time_before)."
            group by u.id , DATE(m.timeslot_datetime)
            HAVING count_for_day >= rt_c.appointment_per_day) day_limits ON pc_u.id = day_limits.user_id
                AND DATE(m.timeslot_datetime) = day_limits.dateonly ";

        // left join with the result set containing users whose weekly limit is reached to get only those
        // whose weekly limit is not reached by placing a NULL check in where part
        $sql.="        
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
                AND DATE(m.timeslot_datetime) >= DATE_ADD(DATE(".$db->quoted($this->getTimeDate()->nowDbDate())."), INTERVAL (- WEEKDAY(DATE(".$db->quoted($this->getTimeDate()->nowDbDate())."))) DAY) 
                AND DATE(m.timeslot_datetime) <= ".$db->quoted($start_time_before)."
            group by u.id , DATE_ADD(DATE(m.timeslot_datetime), INTERVAL (- WEEKDAY(DATE(m.timeslot_datetime))) DAY)
            HAVING count_for_week >= rt_c.max_appointment_per_week) week_limits ON pc_u.id = week_limits.user_id
                AND DATE_ADD(DATE(m.timeslot_datetime),
                INTERVAL (- WEEKDAY(DATE(m.timeslot_datetime))) DAY) = week_limits.week_of ";

        $sql.= "
            WHERE
                (".$categories_where.")
                    AND (rt_postal_codes.deleted = 0)
                    AND day_limits.user_id IS NULL
                    AND week_limits.user_id IS NULL
            GROUP BY m.timeslot_name , DATE(m.timeslot_datetime);";

        $stmt = $db->getConnection()->executeQuery($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * Book appointment for contact$result
     *
     * @param ServiceBase $api
     * @param array $args API arguments
     *
     */
    public function bookAppointment(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('meeting_id', 'contact_model', 'account_model', 'noagent'));
        if (!empty($args['contact_id'])) {
            //retrieve contact
            $contact = $this->retrieveBean('Contacts', $args['contact_id']);
        } elseif (!empty($args['contact_model']['phone_home']) || !empty($args['contact_model']['phone_mobile']) ||
             !empty($args['contact_model']['phone_work']) || !empty($args['contact_model']['phone_other'])
        ) {
            $contact = $this->searchContact($args);
        } else {
            throw new SugarApiExceptionInvalidParameter(
                'Please either provide contact id or one of the phone numbers'
            );
        }

        if (is_array($contact) && count($contact) > 0) {
            $contact = $this->retrieveBean('Contacts', $contact[0]['id']);
            if (count($contact) > 1) {
                $GLOBALS['log']->fatal(
                    'duplicate contacts found based on postal code and phone number. contact ids: '.print_r($contact, 1)
                );
            }
        }
        
        if (empty($contact)) {
            if (empty($args['contact_model']['first_name']) && empty($args['contact_model']['last_name'])) {
                throw new SugarApiExceptionMissingParameter(
                    'Please either provide Nom or Prenom to create Contact'
                );
            } else {
                $contact = BeanFactory::newBean('Contacts');
            }
        }
        //populate contact fields and update it
        $this->updateContact($args, $contact);
        $this->updateMeeting($args, $args['meeting_id'], $contact, $api);
        return true;
    }

    /**
     * Creates/updates contact and batiment in sugar
     * @param ServiceBase $api
     * @param array $args
     * @return boolean
     * @throws SugarApiExceptionInvalidParameter
     */
    public function saveInfoandAccount(ServiceBase $api, array $args)
    {
        $this->requireArgs($args, array('contact_model', 'account_model', 'noagent', 'postalcode'));
        if (!empty($args['contact_model']['id'])) {
            //retrieve contact
            $contact = $this->retrieveBean('Contacts', $args['contact_model']['id']);
        } elseif (!empty($args['contact_model']['phone_home']) || !empty($args['contact_model']['phone_mobile']) ||
             !empty($args['contact_model']['phone_work']) || !empty($args['contact_model']['phone_other'])
        ) {
            $contact_id = $this->searchContact($args);
            if (!empty($contact_id) && !empty($contact_id[0]['id'])) {
                $contact = BeanFactory::newBean('Contacts')->retrieve($contact_id[0]['id']);
            } else {
                // if reseller, then create account if firstname and lastname is provided
                if (empty($args['contact_model']['first_name']) && empty($args['contact_model']['last_name'])) {
                    throw new SugarApiExceptionMissingParameter(
                        'Please either provide Nom or Prenom to create Contact'
                    );
                } else {
                    $contact = BeanFactory::newBean('Contacts');
                }
            }
        } else {
            throw new SugarApiExceptionInvalidParameter(
                'Please either provide contact_id or one of the phone numbers'
            );
        }
        //populate contact fields and update it
        $this->updateContact($args, $contact);
        $this->saveAccount($args, $contact);
        return true;
    }

    /**
    * Populate contact fields from arguments and update contact
    */
    protected function updateContact($args, Contact $contact)
    {
        if (empty($args['contact_model'])) {
            return false;
        }
        $contact_args = $args['contact_model'];

        if (!empty($contact_args['primary_address_street'])) {
            $contact->primary_address_street = $contact_args['primary_address_street'];
        }
        if (!empty($contact_args['primary_address_city'])) {
            $contact->primary_address_city = $contact_args['primary_address_city'];
        }
        if (!empty($contact_args['primary_address_state'])) {
            $contact->primary_address_state = $contact_args['primary_address_state'];
        }
        if (!empty($args['postalcode'])) {
            $contact->primary_address_postalcode = $args['postalcode'];
        }
        if (!empty($contact_args['phone_home'])) {
            $contact->phone_home = $contact_args['phone_home'];
        }
        if (!empty($contact_args['phone_mobile'])) {
            $contact->phone_mobile = $contact_args['phone_mobile'];
        }
        if (!empty($contact_args['phone_work'])) {
            $contact->phone_work = $contact_args['phone_work'];
        }
        if (!empty($contact_args['phone_other'])) {
            $contact->phone_other = $contact_args['phone_other'];
        }
        if (!empty($contact_args['first_name'])) {
            $contact->first_name = $contact_args['first_name'];
        }
        if (!empty($contact_args['last_name'])) {
            $contact->last_name = $contact_args['last_name'];
        }
        if (!empty($contact_args['email'])) {
            $contact->email1 = $contact_args['email'];
        }
        if (!empty($contact_args['codecie_c'])) {
            $contact->codecie_c = $contact_args['codecie_c'];
        }
        if (!empty($contact_args['etat_de_proprietaire'])) {
            $contact->etat_de_proprietaire = $contact_args['etat_de_proprietaire'];
        }
        if (!empty($contact_args['preferred_language_1']) && $contact_args['preferred_language_1'] == 'true') {
            $contact->preferred_language = 'francais';
        } else if (
            !empty($contact_args['preferred_language_2']) &&
            $contact_args['preferred_language_2'] == 'true'
        ) {
            $contact->preferred_language = 'anglais';
        }
        $account_model = $args['account_model'];
        if (!empty($account_model['occupant_depuis'])) {
            $contact->occupant_depuis = $account_model['occupant_depuis'];
        }
        if (!empty($account_model['etat_de_proprietaire'])) {
            $contact->etat_de_proprietaire = $account_model['etat_de_proprietaire'];
        }
        if (!empty($contact_args['consentement']) && $contact_args['consentement'] == 'true') {
            $contact->consentement = true;
        } else {
            $contact->consentement = false;
        }

        if (!empty($contact_args['do_not_call']))
        {
            if ($contact_args['do_not_call'] == 'true') {
                $contact->do_not_call = true;
            } else if ($contact_args['do_not_call'] == 'false'){
                $contact->do_not_call = false;
            }
        }

        if (isset($args['noagent'])) {
            if ($args['noagent'] == '1000') {
                $contact->source = 'partenaire';
                $contact->source_details = 'hit';
            } elseif ($args['noagent'] == '2000') {
                $contact->source = 'partenaire';
                $contact->source_details = 'reno_depot';
            } else {
                $contact->source_details = '';
            }
        }
        $contact->save();
    }

    /**
    * Book meeting
    */
    protected function updateMeeting($args, $meeting_id, SugarBean $contact, $api)
    {
        $meeting = $this->retrieveBean('Meetings', $meeting_id);
        if (empty($meeting)) {
            throw new SugarApiExceptionInvalidParameter('Meeting not found in SugarCRM');
        }
        /**
         * JIRA DEV-593
         * Added By SMQB 05/06/2018
         */
        // check if meeting is still available
        // meeting is considered as available if its status is 'disponible' and
        // waiting_for_assignation is 0
        if ($meeting->status != 'disponible' || $meeting->waiting_for_assignation == 1) {
            // meeting is no more available, again get available appointments from database
            // and book another meeting of the same slot
            $appointment_args = array(
                'postalcode' => $args['postalcode'],
                'preferred_language_1' => $args['contact_model']['preferred_language_1'],
                'preferred_language_2' => $args['contact_model']['preferred_language_2'],
                'codecie_c' => $args['contact_model']['codecie_c'],
                'categories' => $args['categories']
            );
            $appointments = $this->getAvailableAppointments($api, $appointment_args);
            $meeting_found = false;
            if(!empty($appointments)){
                // meeting date in Y-m-d format e.g 2018-02-21
                $meeting_date = substr(
                    $meeting->timeslot_datetime,
                    0,
                    strpos($meeting->timeslot_datetime, "T")
                );
                // find the desrired meeting
                foreach ($appointments as $appointment) {
                    if(
                        !$meeting_found &&
                        $appointment['timeslot'] == $meeting->timeslot_name &&
                        $appointment['dateonly'] == $meeting_date
                        ) {
                            $meeting_found = true;
                            $this->updateMeeting($args, $appointment['meeting_id'], $contact, $api);
                            return true;
                    }
                }
            }
            if(!$meeting_found){
                throw new SugarApiExceptionInvalidParameter('Meeting Already Booked');
            }
        }
        
        // check if the meeting is within 48 hours(today or tomorrow). Such meetings
        // should be assigned directly, without waiting for scheduled job which will assign future 
        // (next days ) meetings at day end
        // meeting date in Y-m-d format e.g 2018-02-21
        $meeting_date = substr($meeting->timeslot_datetime, 0, strpos($meeting->timeslot_datetime, "T"));
        //get timezone from meeting date
        $iso_datetime = date_create_from_format("Y-m-d\TH:i:se", $meeting->timeslot_datetime);
        $meeting_timezone = $iso_datetime->getTimezone();
        //get current datetime in GMT
        $now_datetime = $this->getTimeDate()->getNow();
        // convert current datetime to date in the timezone in which the meeting was saved
        $now_date = $now_datetime->setTimezone($meeting_timezone)->format('Y-m-d');

        $md = new DateTime($meeting_date);
        $nd = new DateTime($now_date);
        $date_diff = $md->diff($nd);
        $send_notification = false; // set to true to send email notification to meeting's assignee

        // now get available sales rep of this slot
        // that match the following criteria
        // date, timeslot, codecie, language, category, postal code, best classification
        global $db;
        $language = "('3', ";
        if ($contact->preferred_language == 'francais') {
            $language .= "'1')";
        } else {
            $language .= "'2')";
        }
    // Start DEV-320 : QA Portail : Postal Code: Not found in CRM
    // get first 3 characters of postalcode
        $pcode = trim($contact->primary_address_postalcode);
        if (strlen($contact->primary_address_postalcode) > 3) {
        $pcode = substr($pcode, 0, 3);
        }
       // get postalcode id from crm
        $s_query = $this->getSugarQuery();
        $s_query->from(BeanFactory::newBean('rt_postal_codes'), array('team_security' => false));
        $s_query->select(array('id'));
        $s_query->where()->queryOr()
            ->equals($s_query->getFromAlias().'.name', trim($contact->primary_address_postalcode))
            ->queryAnd()->starts($s_query->getFromAlias().'.name', $pcode)
            ->addRaw("LENGTH(".$s_query->getFromAlias().".name) = 3");
        $s_query->orderByRaw("LENGTH(".$s_query->getFromAlias().".name)");
        $compiled2 = $s_query->compile();
        $pcode_id = $s_query->getOne();
    // End DEV-320 : QA Portail : Postal Code: Not found in CRM
        if (empty($pcode_id)) {
            throw new SugarApiExceptionNotFound("Postal Code: $pcode not found in Postal Codes module in CRM");
        }
        // following query will get sorted users by classification in ascending order
        // if a user is not in any classification then they are not considered available
        // returned in following order Classification: A, then B, then C, then D, then none
        // only get those users who have this postal code in their
        // related postal codes AND exclude those sales reps who have meeting assiged to them already
        // on this specific date and timeslot (this avoids reassigning to same sales rep)
        $query = "  SELECT u.id, m.id as meeting_id, m.status as status
                    FROM users u
                    INNER JOIN rt_postal_codes_users_c pcu 
                    ON pcu.rt_postal_codes_usersusers_idb = u.id
                    AND pcu.rt_postal_codes_usersrt_postal_codes_ida = '$pcode_id'
                    AND u.deleted = 0
                    INNER JOIN rt_classification_users_c cu on u.id = cu.rt_classification_usersusers_idb AND cu.deleted = 0
                    INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted = 0
                    INNER JOIN meetings m ON u.id = m.assigned_user_id
                    AND m.waiting_for_assignation = 0
                    AND m.status = 'disponible'
                    AND m.deleted = 0
                    WHERE
                    DATE(m.timeslot_datetime) = '$meeting_date'
                    AND m.timeslot_name = '$meeting->timeslot_name'
                    AND u.codecie_rep_c LIKE '%$contact->codecie_c%'
                    AND u.codelangue_rep IN $language
                    ";
        $account_model = $args['account_model'];
        if (!empty($account_model['nombre_portes_achanger']) &&
            (int) $account_model['nombre_portes_achanger'] > 0) {
            $query .= " AND u.qualified_doors_rep_c = 1
                        ";
        }
        if (!empty($account_model['nombre_fenetres_achanger']) &&
            (int) $account_model['nombre_fenetres_achanger'] > 0) {
            $query .= " AND u.qualified_windows_rep_c = 1
                        ";
        }
        if (!empty($account_model['nombre_garage_achanger']) &&
            (int) $account_model['nombre_garage_achanger'] > 0) {
            $query .= " AND u.qualified_garage_rep_c = 1
                        ";
        }

        $query .= " ORDER BY c.name ASC";
        //$query .= " ORDER BY c.name IS NULL, c.name ASC";
        $result = $db->query($query, true, "Error finding users for specified Meeting");
        $potential_assignees = array();
        $users_meetings = array(); //will contain meeting id against user id
        while($row = $db->fetchByAssoc($result)) {
            $potential_assignees[] = $row['id'];
            $users_meetings[$row['id']]['meeting_id'] = $row['meeting_id'];
        }
        if (!empty($potential_assignees)) {
            $GLOBALS['log']->debug('POTENTIAL ASSIGNEES', $potential_assignees);
            // now discard users with daily limit reached
            $filtered_assignees = $this->filterDayLimitReached($potential_assignees, $meeting_date);

            if (!empty($filtered_assignees)) {
                // now discard users with weekly limit reached
                $filtered_assignees = $this->filterWeekLimitReached($filtered_assignees, $meeting_date);
            }
            if (!empty($filtered_assignees)) {
                $GLOBALS['log']->debug('FILTERED ASSIGNEES', $filtered_assignees);
                // assign sales rep's own meeting
                if ($meeting->id != $users_meetings[reset($filtered_assignees)]['meeting_id']) {
                    $meeting = $this->retrieveBean(
                        'Meetings',
                        $users_meetings[reset($filtered_assignees)]['meeting_id']
                    );
                    if (empty($meeting)) {
                        throw new SugarApiExceptionInvalidParameter('Meeting not found in SugarCRM');
                    }
                }
                // today and tomorrow meetings
                if ($meeting_date == $now_date ||
                    ($meeting_date > $now_date && $date_diff->d == 1)) {
                    $meeting->status = 'assigne';
                    $send_notification = true;

                } else {
                    // after tomorrow
                    $meeting->waiting_for_assignation = 1;
                }

            } else {
                throw new SugarApiExceptionNotFound('Sales Rep available but their daily/weekly limit has been reached');
            }
        } else {
            throw new SugarApiExceptionNotFound('No Sales Rep available for this Meeting');
        }
		$meeting->financement = 'no';
		if ($args['financement'] == 'true') {
            $meeting->financement = 'yes';			
		}
        
        $meeting->description = $args['description'];
        $meeting->partenaire_info = isset($args['partenaire_info']) ? $args['partenaire_info'] : '';
        
        // calculate potential amount of sales
        $sugar_config = $this->getSugarConfig();
        if (!empty($sugar_config->get('appointment_config'))) {
            $config = $sugar_config->get('appointment_config');
            if (!empty($config['param_portes']) && !empty($config['param_fenetres']) &&
                !empty($config['param_garage'])) {
                $account_args = $args['account_model'];
                //if int, convert to int, if float, covert to float
                $param_portes = ($config['param_portes'] == (int) $config['param_portes']) ?
                (int) $config['param_portes'] : (float) $config['param_portes'];
                $param_fenetres = ($config['param_fenetres'] == (int) $config['param_fenetres']) ?
                (int) $config['param_fenetres'] : (float) $config['param_fenetres'];
                $param_garage = ($config['param_garage'] == (int) $config['param_garage']) ?
                (int) $config['param_garage'] : (float) $config['param_garage'];

                $sum = ($param_portes *  (int)$account_args['nombre_portes_achanger']) +
                ($param_fenetres *  (int)$account_args['nombre_fenetres_achanger']) +
                ($param_garage *  (int)$account_args['nombre_garage_achanger']);
                $meeting->potential_sales = $sum;
            }
        }
        
        $meeting->save();
        // send notification email
        if($send_notification) {
            
            $admin = Administration::getSettings();
            $notify_list = $this->get_notification_recipients($meeting);
            foreach ($notify_list as $notify_user)
            {
                $meeting->send_assignment_notifications($notify_user, $admin);
            }
        }
        $link = 'contacts';

        if ($meeting->load_relationship($link)) {
            $meeting->$link->add($contact->id);
        }
        // DEV-713
        $link = 'meeting_telemarketer';
        if ($meeting->load_relationship($link)) {
            $meeting->$link->add($args['telemaketer_id']);
        }
        //create/update account

        if (isset($args['noagent'])) {
            if ($args['noagent'] == '1000') {
                $contact->lead_source = 'hit';
            } elseif ($args['noagent'] == '2000') {
                $contact->lead_source = 'reno_depot';
            } else {
                $contact->lead_source = 'solarcan';
            }
        }
        $contact->statut_contact = 'prospect_avec_rv';
        $contact->save();
        $this->saveAccount($args, $contact, $meeting);
    }
    
    /**
     * Given an array of user ids, remove those which have daily limit reached
     * @param array $users Users list to filter from
     * @param string date to check the limit for
     */
    protected function filterDayLimitReached($users, $dateToCheck) {
        $users_overlimit_query = "SELECT u.id, count(u.id) as assigned, c.appointment_per_day as maximum
                            FROM users u 
                            INNER JOIN meetings m ON u.id = m.assigned_user_id
                            AND (m.status = 'assigne' || m.waiting_for_assignation = 1)
                            INNER JOIN rt_classification_users_c cu on u.id = cu.rt_classification_usersusers_idb AND cu.deleted = 0
                            INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted = 0
                            WHERE u.deleted = 0 AND m.deleted = 0
                            AND u.id IN ('".implode("','", $users)."')
                            AND DATE(m.timeslot_datetime) = '$dateToCheck'
                            GROUP BY u.id
                            HAVING assigned >= maximum;";
        $result = $GLOBALS['db']->query($users_overlimit_query, true, 'Error finding users over limit');
        $users_overlimit = array();
        while($row = $GLOBALS['db']->fetchByAssoc($result)) {
            $users_overlimit[] = $row['id'];
        }
        $available_for_assignation = array_diff($users, $users_overlimit);
        return $available_for_assignation;
    }

    /**
     * Given an array of user ids, remove those which have weekly limit reached
     * @param array $users_list Users list to filter from
     * @param string date_to_check the date for which the week limit needs to be checked
     */
    private function filterWeekLimitReached($users_list ,$date_to_check)
    {
        $db = DBManagerFactory::getInstance();

        $s_query = $this->getSugarQuery();
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
                '(m.status = "assigne" || m.waiting_for_assignation = 1) AND
                DATE(m.timeslot_datetime) >= DATE_ADD('.$db->quoted($date_to_check).',
                INTERVAL(-WEEKDAY('.$db->quoted($date_to_check).')) DAY)
                AND DATE(m.timeslot_datetime) <= DATE_ADD('.$db->quoted($date_to_check).',
                INTERVAL(7-DAYOFWEEK('.$db->quoted($date_to_check).')) DAY)'
            );
        $s_query->where()->in($s_query->getFromAlias().'.id', $users_list);
        $s_query->groupBy($s_query->getFromAlias().'.id');

        $s_query->havingRaw('count_for_week >= max_appointment_per_week');

        $result = $s_query->execute();
        foreach ($result as $row) {
            // remove user id from potential users list
            if (in_array($row['user_id'] ,$users_list)) {
                $users_list = array_diff($users_list, array($row['user_id']));
            }
        }

        return $users_list;
    }

    /**
    * Save/update account when an appointment is booked
    */
    protected function saveAccount($args, SugarBean $contact, SugarBean $meeting = null)
    {
        //if no account is related to contact, create account
        if (!empty($args['account_model'])) {
            $account = null;
            if (empty($contact->account_id)) {
                $account = BeanFactory::newBean('Accounts');
            } else {
                $account = BeanFactory::newBean('Accounts')->retrieve($contact->account_id);
            }
            $account_args = $args['account_model'];
            //copy address from contact
            $account->billing_address_street = $contact->primary_address_street;
            $account->billing_address_city = $contact->primary_address_city;
            $account->billing_address_postalcode = $contact->primary_address_postalcode;
            $account->billing_address_state = $contact->primary_address_state;
            $acount->name = $account->billing_address_street . " " . $account->billing_address_city . " "
            . $account->billing_address_postalcode;
            $account->annee_construction = $account_args['annee_construction'];
            $account->nombre_portes_total = $account_args['nombre_portes_total'];
            $account->nombre_portes_achanger = $account_args['nombre_portes_achanger'];
            $account->nombre_fenetres_total = $account_args['nombre_fenetres_total'];
            $account->nombre_fenetres_achanger = $account_args['nombre_fenetres_achanger'];
            $account->nombre_garage_total = $account_args['nombre_garage_total'];
            $account->nombre_garage_achanger = $account_args['nombre_garage_achanger'];

            // DEV-305
            $account->postalcode_id = $contact->postalcode_id;
            // DEV-305
            $account->save();
            //relate account to contact
            $link = 'contacts';
            if ($account->load_relationship($link)) {
                $account->$link->add($contact->id);
            }
            //relate account to meeting
            $link = 'meetings';
            if ($account->load_relationship($link) && $meeting) {
                $account->$link->add($meeting->id);
            }
            if ($meeting) {
                $this->saveOpportunity($args, $account, $contact, $meeting);
            }
        }
    }

    /**
    * create Opportunity when an appointment is booked
    */
    protected function saveOpportunity($args, Account $account, Contact $contact, Meeting $meeting)
    {
        // create opportunity and relate to account, contact and meeting
        $opp = $this->getNewBean('Opportunities');
        $opp->name = $contact->name . " " . $account->name;
        $opp->account_id = $account->id;
        $opp->save();
        
        $link = 'contacts';
        if ($opp->load_relationship($link)) {
            $opp->$link->add($contact->id);
        }
        $link = 'meetings';
        if ($opp->load_relationship($link)) {
            $opp->$link->add($meeting->id);
        }
    }

    /**
    * search contact based on postal code and phone numbers
    */
    protected function searchContact($args)
    {
        $this->requireArgs($args, array('postalcode', 'contact_model'));
        $contact_args = $args['contact_model'];

        if (empty($contact_args['phone_home']) && empty($contact_args['phone_mobile']) &&
            empty($contact_args['phone_work']) && empty($contact_args['phone_other'])) {
            throw new SugarApiExceptionInvalidParameter('Please provide atleaset one phone number');
        }

        $s_query = $this->getSugarQuery();
        $s_query->from(BeanFactory::newBean('Contacts'), array('team_security' => false));
        $s_query->select(
            array(
                $s_query->getFromAlias().'.id'
            )
        );
        // $s_query->where()->equals($s_query->getFromAlias().'.primary_address_postalcode', $args['postalcode']);

        $s_query->whereRaw(
            $this->getPhoneWhere(
                $contact_args['phone_home'],
                $contact_args['phone_mobile'],
                $contact_args['phone_work'],
                $contact_args['phone_other']
            )
        );
        $result = $s_query->execute();
        return $result;
    }

    /**
    * Prepare where part to search for phone number
    * @param $phone_home string
    * @param $phone_mobile string
    * @param $phone_work string
    * @param $phone_other string
    * @return string
    */
    protected function getPhoneWhere($phone_home, $phone_mobile, $phone_work, $phone_other)
    {
        global $db;
        $sql_parts = array();
        $sql = '';

        if (!empty($phone_home)) {
            $phone_home =  preg_replace('/[^0-9]/s', '', $phone_home);
            $sql_parts[] = " phone_home = ".$db->quoted($phone_home);
        }
        if (!empty($phone_mobile)) {
            $phone_mobile =  preg_replace('/[^0-9]/s', '', $phone_mobile);
            $sql_parts[] = " phone_mobile = ".$db->quoted($phone_mobile);
        }
        if (!empty($phone_work)) {
             $phone_work =  preg_replace('/[^0-9]/s', '', $phone_work);
            $sql_parts[] = " phone_work = ".$db->quoted($phone_work);
        }
        if (!empty($phone_other)) {
            $phone_other =  preg_replace('/[^0-9]/s', '', $phone_other);
            $sql_parts[] = " phone_other = ".$db->quoted($phone_other);
        }

        if (count($sql_parts) > 1) {
            $sql = implode(' OR ', $sql_parts);
        } elseif (count($sql_parts) == 1) {
            $sql = $sql_parts[0];
        }
        return $sql;
    }

    /**
    * Prepare where part to match categories
    * @param $categories array
    * @return string
    */
    protected function getCategoryWhere($join_alias, $categories = array())
    {
        $sql_parts = array();
        $sql = '';

        if (empty($join_alias)) {
            return $sql;
        }

        foreach ($categories as $category) {
            $sql_parts[] = $join_alias . '.' .$category . " = 1 ";
        }

        if (count($sql_parts) > 1) {
            $sql = implode(' AND ', $sql_parts);
        } elseif (count($sql_parts) == 1) {
            $sql = $sql_parts[0];
        }
        return $sql;
    }

    /**
     * Stores appointment configuration in sugar config file
     *
     * @param ServiceBase $api
     * @param array $args API arguments
     *
     */
    public function saveAppointmentConfig(ServiceBase $api, array $args)
    {
        global $current_user;
        if (!$current_user->is_admin) {
            throw new SugarApiExceptionNotAuthorized('User not permitted for this action');
        }
        $this->requireArgs($args, array('data'));
        $config_obj = $this->getConfigurator();
        //Load config
        $config_obj->loadConfig();
        $sugarField = SugarFieldHandler::getSugarField('datetime');
        foreach ($args['data'] as $key => $value) {
            if ($key == 'appointments_upto' && !empty($value)) {
                $value  = $sugarField->apiUnformatField($value);
            }
            $config_obj->config['appointment_config'][$key] = $value;
        }
        /**
         * Save the new setting
         * DEV-780 : Portal showing meeting within 2 or 4 hours ( config panel)
         * Not using $config_obj->saveConfig(); because it clears cache which 
         * makes metadata outdated does not let user to save settings again
         */
        $config_obj->handleOverride();
        return true;
    }

    /**
     * Stores appointment configuration in sugar config file
     *
     * @param ServiceBase $api
     * @param array $args API arguments
     *
     */
    public function getAppointmentConfig(ServiceBase $api, array $args)
    {
        $response = array();
        $sugar_config = $this->getSugarConfig();
        $time_date = $this->getTimeDate();
        if (!empty($sugar_config->get('appointment_config'))) {
            $response['data'] = $sugar_config->get('appointment_config');
            if (!empty($response['data']['appointments_upto'])) {
                $response['data']['appointments_upto'] = $time_date->fromDbType(
                    $response['data']['appointments_upto'],
                    'datetime'
                );
                $response['data']['appointments_upto'] = $time_date->asIso($response['data']['appointments_upto']);
            }
        }
        return $response;
    }

    /**
    * Determines which users receive a notification
    * @param SugarBean $meeting
    */
    public function get_notification_recipients(SugarBean $meeting) {
        $userList = array();
        if(isset($meeting->assigned_user_id) && !empty($meeting->assigned_user_id)) {
            $notify_user = BeanFactory::retrieveBean('Users', $meeting->assigned_user_id);
            if ( ! $notify_user ) {
                // The user to notify has been deleted.
                return $userList;
            }
            $meeting->new_assigned_user_name = $notify_user->full_name;

            if ($notify_user->receive_notifications) {
                $GLOBALS['log']->info("Notifications: recipient is $meeting->new_assigned_user_name");
                $userList[] = $notify_user;
            }
        }
        return $userList;
    }
}
