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
        //$GLOBALS['log']->fatal('getAvailableAppointments args: '.print_r($args,1));
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
        $s_query->select()->fieldRaw('count(distinct m.id)', 'available_count');
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
        //$GLOBALS['log']->fatal('in book appointment args: '.print_r($args,1));
        $this->requireArgs($args, array('meeting_id', 'contact_model', 'account_model', 'noagent'));
        if (!empty($args['contact_id'])) {
            //retrieve contact
            $contact = $this->retrieveBean('Contacts', $args['contact_id']);
            //$GLOBALS['log']->fatal('contact last_name: '.$contact->last_name);
        } elseif (!empty($args['contact_model']['phone_home']) || !empty($args['contact_model']['phone_mobile']) ||
             !empty($args['contact_model']['phone_work']) || !empty($args['contact_model']['phone_other'])
        ) {
            $contact = $this->searchContact($args);
        } else {
            throw new SugarApiExceptionInvalidParameter(
                'Please either provide contact_id or one of the phone numbers'
            );
        }

        if (is_array($contact) && count($contact) > 0) {
            $GLOBALS['log']->fatal('contact id: '.$contact[0]['id']);
            $contact = $this->retrieveBean('Contacts', $contact[0]['id']);
            if (count($contact) > 1) {
                $GLOBALS['log']->fatal(
                    'duplicate contacts found based on postal code and phone number. contact ids: '.print_r($contact, 1)
                );
            }
        }
        
        if (empty($contact)) {
            if ($args['noagent'] == '1000' || $args['noagent'] == '2000') {
                // if reseller, then create account if firstname and lastname is provided
                if (empty($args['contact_model']['first_name']) && empty($args['contact_model']['last_name'])) {
                    throw new SugarApiExceptionMissingParameter(
                        'Please either provide Nom or Prenom to create Contact'
                    );
                } else {
                    $contact = BeanFactory::newBean('Contacts');
                }
            } else {
                throw new SugarApiExceptionInvalidParameter("Contact not found in CRM");
            }
        }
        //populate contact fields and update it
        $this->updateContact($args, $contact);
        $this->updateMeeting($args, $args['meeting_id'], $contact);
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
                if (($args['noagent'] == '1000' || $args['noagent'] == '2000')) {
                    // if reseller, then create account if firstname and lastname is provided
                    if (empty($args['contact_model']['first_name']) && empty($args['contact_model']['last_name'])) {
                        throw new SugarApiExceptionMissingParameter(
                            'Please either provide Nom or Prenom to create Contact'
                        );
                    } else {
                        $contact = BeanFactory::newBean('Contacts');
                    }
                } else {
                    throw new SugarApiExceptionInvalidParameter(
                        'Contact not found in CRM'
                    );
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
        // $GLOBALS['log']->fatal("CONTACT MODEL: ", $args['contact_model']);
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
        if (!empty($contact_args['preferred_language_1'])) {
            $contact->preferred_language = 'francais';
        } elseif (!empty($contact_args['preferred_language_2'])) {
            $contact->preferred_language = 'anglais';
        }
        $account_model = $args['account_model'];
        if (!empty($account_model['occupant_depuis'])) {
            $contact->occupant_depuis = $account_model['occupant_depuis'];
        }
        if (!empty($account_model['etat_de_proprietaire'])) {
            $contact->etat_de_proprietaire = $account_model['etat_de_proprietaire'];
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
        //if (!empty($args['consentement'])) {
        //    $contact->consentement = $args['consentement'];
        //}
        $contact->save();
    }

    /**
    * Book meeting
    */
    protected function updateMeeting($args, $meeting_id, SugarBean $contact)
    {
        $meeting = $this->retrieveBean('Meetings', $meeting_id);
        //$GLOBALS['log']->fatal('meeting bean: '.print_r($meeting,1));
        if (empty($meeting)) {
            throw new SugarApiExceptionInvalidParameter('Meeting not found in SugarCRM');
        }
        // check if the meeting is today. For today's meetings they should be assigned directly,
        // without waiting for scheduled job which will assign future (next days ) meetings at day end
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

        if ($meeting_date == $now_date ||
            ($meeting_date > $now_date && $date_diff->d == 1)) {
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
            $s_query->where()->starts($s_query->getFromAlias().'.name', $pcode);
            $pcode_id = $s_query->getOne();
        // End DEV-320 : QA Portail : Postal Code: Not found in CRM
            if (empty($pcode_id)) {
                throw new SugarApiExceptionNotFound("Postal Code: $pcode not found in Postal Codes module in CRM");
            }
            $query = "  SELECT u.id
                        FROM users u
                        INNER JOIN meetings m ON u.id = m.created_by
                        INNER JOIN rt_classification_users_c cu on u.id = cu.rt_classification_usersusers_idb AND cu.deleted = 0
                        INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted = 0
                        WHERE u.deleted = 0
                        AND m.deleted = 0
                        AND DATE(m.date_start) = '$meeting_date'
                        AND m.timeslot_name = '$meeting->timeslot_name'
                        AND u.codecie_rep_c = '$contact->codecie_c'
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
            // now get those users who have this postal code in their
            // related postal codes AND
            // exclude those sales reps who have meeting assiged to them already
            // on this specific date and timeslot (this avoids reassigning to same sales rep)
            $query .= " AND u.id IN (SELECT pcu.rt_postal_codes_usersusers_idb
                                     FROM rt_postal_codes_users_c pcu
                                     WHERE pcu.deleted = 0
                                     AND pcu.rt_postal_codes_usersrt_postal_codes_ida = '$pcode_id')
                        AND u.id NOT IN (SELECT mt.assigned_user_id
                                         FROM meetings mt
                                         WHERE DATE(mt.date_start) = '$meeting_date'
                                         AND mt.timeslot_name = '$meeting->timeslot_name'
                                         AND mt.assigned_user_id IS NOT NULL
                                         AND mt.deleted = 0)
                        ";
            $query .= " ORDER BY c.name ASC
                        LIMIT 1";

            //$GLOBALS['log']->fatal($query);
            $result = $db->query($query, true, "Error finding users for specified Meeting");
            $row = $db->fetchByAssoc($result);
            if ($row) {
                $meeting->status = 'assigne';
                $meeting->assigned_user_id = $row['id'];
            } else {
                throw new SugarApiExceptionNotFound('No Sales Rep available for this Meeting');
            }
        } else {
            $meeting->status = 'en_attente_dassignation';
        }
        $meeting->financement = $args['financement'];
        $meeting->description = $args['description'];
        if ($args['noagent'] == '1000' || $args['noagent'] == '2000') {
            $meeting->partenaire_info = isset($args['partenaire_info']) ? $args['partenaire_info'] : '';
        }
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
        $link = 'contacts';
        //$GLOBALS['log']->fatal('timeslot_datetime for meeting: '.$meeting->timeslot_datetime);
        //$GLOBALS['log']->fatal('now for saved timezone: '.$now_date);

        if ($meeting->load_relationship($link)) {
            //$GLOBALS['log']->fatal('relationship is loaded');
            $meeting->$link->add($contact->id);
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
            $account->save();
            //relate account to contact
            $link = 'contacts';
            if ($account->load_relationship($link)) {
                //$GLOBALS['log']->fatal('relationship is loaded');
                $account->$link->add($contact->id);
            }
            //relate account to meeting
            $link = 'meetings';
            if ($account->load_relationship($link) && $meeting) {
                //$GLOBALS['log']->fatal('relationship is loaded');
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
        //$GLOBALS['log']->fatal('completec contact search query: '.$s_query->compile());
        $result = $s_query->execute();
        //$GLOBALS['log']->fatal('result: '.print_r($result,1));
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
        } elseif (count($sql_parts) == 1) {
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
}
