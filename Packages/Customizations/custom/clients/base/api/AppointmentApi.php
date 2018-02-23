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

class AppointmentApi extends SugarApi {
    use UtHelper;

    public function registerApiRest() {
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
                'pathVars' => array('module', 'bookAppointment'),
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
            )
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
        $this->requireArgs($args, array(
                'postalcode','preferred_language_1', 'preferred_language_2', 'codecie_c', 'categories'
            )
        );
        //$GLOBALS['log']->fatal('getAvailableAppointments args: '.print_r($args,1));
        $postalcode = trim($args['postalcode']);
        if (strlen($args['postalcode']) > 3) {
            $postalcode = substr($postalcode, 0, 3);
        }

        //get language code for codelangue_rep field in users from the arguments
        if ($args['preferred_language_1'] == 'true' && $args['preferred_language_2'] == 'true') {
            $lang_code = array('1', '2', '3'); //french , english, bilingual
        } else if ($args['preferred_language_1'] == 'true') {
            $lang_code = array('1', '3'); //french, bilingual
        } else {
            $lang_code = array('2', '3'); //english, bilingual
        }
        $categories_where = $this->getCategoryWhere($args['categories'], 'pc_u');

        // meeting start time should be after and before the hours and datetime saved in config
        $x_hours = $this->getSugarConfig()->get('appointment_config')['x_hours'];
        $start_time_before = $this->getSugarConfig()->get('appointment_config')['appointments_upto'];
        $start_time_after = $this->getTimeDate()->getNow()->modify('+'.$x_hours.'hours')->asDb();
        
        // query to get available appointments based on postal code
        $s_query = $this->getSugarQuery();
        $s_query->from(BeanFactory::newBean('rt_postal_codes'), array('team_security' => false));
        $s_query->select(
            array(
                array($s_query->getFromAlias().'.name', 'postalcode')
            )
        );
        $s_query->select()->fieldRaw('m.id', 'meeting_id');
        $s_query->select()->fieldRaw('m.name', 'meeting');
        $s_query->select()->fieldRaw('m.timeslot_name', 'timeslot');
        $s_query->select()->fieldRaw('count(m.timeslot_name)', 'available_count');
        $s_query->select()->fieldRaw('DAYNAME(m.timeslot_datetime)', 'dayname');
        $s_query->select()->fieldRaw('DATE(m.timeslot_datetime)', 'dateonly');
        //join users
        $s_query->join(
            'rt_postal_codes_users',
            array(
                'alias' => 'pc_u',
                'team_security' => false
            )
        )->on()->equals('pc_u.status', 'Active')
        ->in('pc_u.codelangue_rep', $lang_code)
        ->equals('pc_u.codecie_rep_c', $args['codecie_c'])
        ->starts($s_query->getFromAlias().'.name', $postalcode)
        ->addRaw($categories_where);
        
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
                'm.created_by',
                'pc_u.id'
            )
            ->gt('m.date_start', $start_time_after)
            ->lt('m.date_start', $start_time_before)
            ->equals('m.status', 'disponible')
            ->equals('m.deleted', 0);
        $s_query->groupBy('m.timeslot_name');
        $s_query->groupByRaw('DATE(m.timeslot_datetime)');
        //$GLOBALS['log']->fatal('getAvailableAppointments sql: '.$s_query->compile());
        $result = $s_query->execute();
        return $result;
    }

    /**
     * Book appointment for contact
     *
     * @param ServiceBase $api
     * @param array $args API arguments
     *
     */
    public function bookAppointment(ServiceBase $api, array $args)
    {
        //$GLOBALS['log']->fatal('in book appointment');
        $this->requireArgs($args, array('meeting_id'));
        if (!empty($args['contact_id'])) {
            //retrieve contact
            $contact = $this->retrieveBean('Contacts', $args['contact_id']);
            //$GLOBALS['log']->fatal('contact last_name: '.$contact->last_name);
        } else if (!empty($args['postalcode']) && 
            (!empty($args['phone_home']) || !empty($args['phone_mobile']) ||
             !empty($args['phone_work']) || !empty($args['phone_other']))
        ) {
            $contact = $this->searchContact($args);
        } else {
            throw new SugarApiExceptionMissingParameter(
                'Please either provide contact_id or postalcode and one of the phone numbers'
            );
        }

        if (is_array($contact) && count($contact > 0))
        {
            $contact = $this->retrieveBean('Contacts', $contact[0]['id']);
            if (count($contact) > 1 ) {
                $GLOBALS['log']->fatal(
                    'duplicate contacts found based on postal code and phone number. contact ids: '.print_r($contact, 1)
                );
            }
        }
        $this->updateMeeting($args['meeting_id'], $contact);
        return true;
    }

    /**
    * Book meeting
    */
    protected function updateMeeting($meeting_id, SugarBean $contact)
    {
        $meeting = $this->retrieveBean('Meetings', $meeting_id);
        //$GLOBALS['log']->fatal('meeting bean: '.print_r($meeting,1));
        if (empty($meeting)) {
            throw new SugarApiExceptionMissingParameter('Meeting not found in SugarCRM');
        }
        //$meeting->timeslot_datetime = '2018-02-21T20:30:00-05:00';
        // check if the meeting is today. For today's meetings they should be assigned directly, without waiting for
        // scheduled job which will assign future (next days ) meetings at day end
        // meeting date in Y-m-d format e.g 2018-02-21
        $meeting_date = substr($meeting->timeslot_datetime, 0, strpos($meeting->timeslot_datetime, "T"));
        //get timezone from meeting date
        $iso_datetime = date_create_from_format ( "Y-m-d\TH:i:se" , $meeting->timeslot_datetime);
        $meeting_timezone = $iso_datetime->getTimezone();
        //get current datetime in GMT
        $now_datetime = $this->getTimeDate()->getNow();
        // convert current datetime to date in the timezone in which the meeting was saved
        $now_date = $now_datetime->setTimezone($meeting_timezone)->format('Y-m-d');
        if ($meeting_date == $now_date) {
            $meeting->status = 'assigne';
            $meeting_id->assigned_user_id = $meeting_id->created_by;
        } else {
            $meeting->status = 'en_attente_dassignation';
        }
        
        $meeting->save();
        $link = 'contacts';
        //$GLOBALS['log']->fatal('timeslot_datetime for meeting: '.$meeting->timeslot_datetime);
        //$GLOBALS['log']->fatal('now for saved timezone: '.$now_date);

        if ($meeting->load_relationship($link)) {
            //$GLOBALS['log']->fatal('relationship is loaded');
            $meeting->$link->add($contact->id);
        }
    }

    protected function updateAccount($args, SugarBean $meeting, SugarBean $contact)
    {

    }

    /**
    * search contact based on postal code and phone numbers
    */
    protected function searchContact($args)
    {
        $this->requireArgs($args, array('postalcode'));

        if (empty($args['phone_home']) && empty($args['phone_mobile']) && 
            empty($args['phone_work']) && empty($args['phone_other'])) {
            throw new SugarApiExceptionMissingParameter('Please provide atleaset one phone number');
        }

        $s_query = $this->getSugarQuery();
        $s_query->from(BeanFactory::newBean('Contacts'), array('team_security' => false));
        $s_query->select(
            array(
                $s_query->getFromAlias().'.id'
            )
        );
        $s_query->where()->equals($s_query->getFromAlias().'.primary_address_postalcode', $args['postalcode']);

        $s_query->whereRaw($this->getPhoneWhere(
                $args['phone_home'],
                $args['phone_mobile'],
                $args['phone_work'],
                $args['phone_other']
            )
        );
        //$GLOBALS['log']->fatal('complete query: '.$s_query->compile());
        $result = $s_query->execute();
        //$GLOBALS['log']->fatal('result: '.print_r($result,1));
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
            $sql_parts[] = " digits(phone_home) = ".$db->quoted($phone_home);
        }
        if (!empty($phone_mobile)) {
            $phone_mobile =  preg_replace('/[^0-9]/s', '', $phone_mobile);
            $sql_parts[] = " digits(phone_mobile) = ".$db->quoted($phone_mobile);
        }
        if (!empty($phone_work)) {
             $phone_work =  preg_replace('/[^0-9]/s', '', $phone_work);
            $sql_parts[] = " digits(phone_work) = ".$db->quoted($phone_work);
        }
        if (!empty($phone_other)) {
            $phone_other =  preg_replace('/[^0-9]/s', '', $phone_other);
            $sql_parts[] = " digits(phone_other) = ".$db->quoted($phone_other);
        }

        if (count($sql_parts) > 1) {
            $sql = implode(' OR ', $sql_parts);
        } else if (count($sql_parts) == 1){
            $sql = $sql_parts[0];
        }
        //$GLOBALS['log']->fatal('phone sql : '.$sql);
        return $sql;
    }

    /**
    * Prepare where part to match categories
    * @param $categories array
    * @return string
    */
    protected function getCategoryWhere($categories = array(), $join_alias)
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
        } else if (count($sql_parts) == 1) {
            $sql = $sql_parts[0];
        }
        //$GLOBALS['log']->fatal('categories sql : '.$sql);
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
        //Save the new setting
        $config_obj->saveConfig();
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
            if(!empty($response['data']['appointments_upto'])) {
                $response['data']['appointments_upto'] = $time_date->fromDbType(
                    $response['data']['appointments_upto'],
                    'datetime'
                );
                $response['data']['appointments_upto'] = $time_date->asIso($response['data']['appointments_upto']);
            }
        }
        return $response;
    }

}
