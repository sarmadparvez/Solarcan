<?php

/**
 * This job runs when importing DNC List and updates contacts according to DNC Workflow
 */
class ContactsDNCUpdate implements RunnableSchedulerJob
{

    /**
     * This method implements setJob from RunnableSchedulerJob. It sets the
     * SchedulersJob instance for the class.
     *
     * @param SchedulersJob $job the SchedulersJob instance set by the job queue
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * Executes a job to clean sync.
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        try {
            $GLOBALS['log']->fatal("------------------------ DNC Workflow :: START ------------------------");
            global $db;
            $contacts_dnc_query = " SELECT dsm_dnc.id as dsm_dnc, contacts.id as contact
                        FROM dsm_dnc
			RIGHT OUTER JOIN contacts
			ON digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_home)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_mobile)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_work)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_other)
			WHERE contacts.deleted = 0
                        AND contacts.consentement = 0";
            $result             = $db->query($contacts_dnc_query, true,
                "Error retrieving matching contacts");

            $contact_dnc_list = array();
            $i                = 0;
            while (($row              = $db->fetchByAssoc($result))) {
                $contact_dnc_list[$i]['contact'] = empty($row['contact']) ? "" : $row['contact'];
                $contact_dnc_list[$i]['dsm_dnc'] = empty($row['dsm_dnc']) ? "" : $row['dsm_dnc'];
                ++$i;
            }

            if (!empty($contact_dnc_list)) {
                foreach ($contact_dnc_list as $arr) {
                    $contactBean = BeanFactory::newBean('Contacts')->retrieve($arr['contact']);
                    if ($contactBean) {

                        if ($arr['dsm_dnc'] == "") {    // if not on dnc list
                            $GLOBALS['log']->fatal("NOT ON DNC ---> $contactBean->id");
                            if ($contactBean->statut_dnc != 'active') {     // if this contact is not active
                                $contactBean->statut_dnc = "active";        // make it active
                                $contactBean->dsm_dnc_id = '';
                                $contactBean->save();

                                $this->updateDNCHistory($contactBean);
                            }
                        } else {    // if on dnc list
                            if ($contactBean->statut_dnc != "inactive") {   // if not already inactive
                                $GLOBALS['log']->fatal("INACTIVATED ---> $contactBean->id");
                                $contactBean->statut_dnc = "inactive";
                                $contactBean->dsm_dnc_id = $arr['dsm_dnc'];
                                $contactBean->save();

                                $this->updateDNCHistory($contactBean);
                            } else {
                                $GLOBALS['log']->fatal("ALREADY INACTIVE ---> $contactBean->id");
                            }
                        }
                    }
                }
            }
            $GLOBALS['log']->fatal("------------------------ DNC Workflow :: END ------------------------");
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }

        return true;
    }

    function updateDNCHistory(&$contactBean)
    {
        global $current_user;

        $dnc_historic                   = BeanFactory::newBean('dsm_dnc_historic');
        $dnc_historic->name             = $contactBean->first_name." ".$contactBean->last_name;
        $dnc_historic->statut_precedent = $contactBean->statut_dnc;
        $dnc                            = null;
        if (!empty($contactBean->dsm_dnc_id)) {
            $dnc = BeanFactory::newBean('dsm_dnc')->retrieve($contactBean->dsm_dnc_id);
        }
        if ($dnc) {
            // $dnc->date_enregistrement holds datetime of Do Not Call registeration time
            $date_reg                          = (new TimeDate())->to_db($dnc->date_enregistrement);
            $dnc_historic->date_enregistrement = $date_reg;
            $GLOBALS['log']->fatal($date_reg);
        }
        $dnc_historic->save();

        if ($dnc) {
            if ($dnc->load_relationship('dsm_dnc_dsm_dnc_historic')) {
                $dnc->dsm_dnc_dsm_dnc_historic->add($dnc_historic->id);
            }
        }
        if ($contactBean->load_relationship('contacts_dsm_dnc_historic')) {
            $contactBean->contacts_dsm_dnc_historic->add($dnc_historic->id);
        }
    }
}