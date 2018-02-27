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
            $GLOBALS['log']->debug("------------------------ DNC Workflow :: START ------------------------");
            global $db;
            $contacts_dnc_query = " SELECT dsm_dnc.id as dsm_dnc, contacts.id as contact
                        FROM dsm_dnc
			RIGHT OUTER JOIN contacts
			ON digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_home)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_mobile)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_work)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_other)
			WHERE contacts.deleted = 0
                        AND contacts.consentement = 0
                        AND contacts.statut_dnc = 'active'";
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
                            $GLOBALS['log']->debug("NOT ON DNC ---> $contactBean->id");
                            if ($contactBean->statut_dnc != 'active') {     // if this contact is not active
                                $contactBean->statut_dnc = "active";        // make it active
                            }
                        } else {    // if on dnc list
                            if ($contactBean->statut_dnc != "inactive") {   // if not already inactive
                                $GLOBALS['log']->debug("INACTIVATED ---> $contactBean->id");
                                $contactBean->statut_dnc = "inactive";
                                $contactBean->dsm_dnc_id = $arr['dsm_dnc'];
                                $dnc                     = BeanFactory::newBean('dsm_dnc')->retrieve($arr['dsm_dnc']);
                                if ($dnc->load_relationship('dsm_dnc_dsm_dnc_historic')) {
                                    $dnc->dsm_dnc_dsm_dnc_historic->add($contactBean->id);
                                }
                            } else {
                                $GLOBALS['log']->debug("ALREADY INACTIVE ---> $contactBean->id");
                            }
                        }
                        $dnc_historic                   = BeanFactory::newBean('dsm_dnc_historic');
                        $dnc_historic->name             = $contactBean->name;
                        $dnc_historic->statut_precedent = $contactBean->statut_dnc;

                        $contactBean->save();
                        $dnc_historic->save();

                        if ($contactBean->load_relationship('contacts_dsm_dnc_historic')) {
                            $contactBean->contacts_dsm_dnc_historic->add($dnc_historic->id);
                        }
                    }
                }
            }
            $GLOBALS['log']->debug("------------------------ DNC Workflow :: END ------------------------");
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }

        return true;
    }
}