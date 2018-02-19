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

        $this->requireArgs($args, array('postalcode', 'preferred_language_1', 'preferred_language_2'));
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

        // meeting start time should be after and before the hours and datetime saved in config
        $x_hours = $this->getSugarConfig()->get('appointment_config')['x_hours'];
        $start_time_before = $this->getSugarConfig()->get('appointment_config')['appointments_upto'];
        $start_time_after = $this->getTimeDate()->getNow()->modify('+'.$x_hours.'hours')->asDb();
        
        // query to get available appointments based on postal code
        $s_query = $this->getSugarQuery();
        $s_query->from(BeanFactory::newBean('rt_postal_codes'), array('team_security' => false));
        $s_query->select(
            array(
                array($s_query->getFromAlias().'.name', 'postalcode'),
                'pc_u.id',
                'pc_u.user_name'
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
        ->starts($s_query->getFromAlias().'.name', $postalcode);
        
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
                'pc_u.id'
            )
            ->gt('m.date_start', $start_time_after)
            ->lt('m.date_start', $start_time_before)
            ->equals('m.status', 'disponible')
            ->equals('m.deleted', 0);
        $s_query->groupBy('m.timeslot_name');
        $s_query->groupByRaw('DATE(m.timeslot_datetime)');
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
        $GLOBALS['log']->fatal('in book appointment');
        $this->requireArgs($args, array('meeting_id'));
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
