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
            $GLOBALS['log']->fatal("DNC Post Import Job");
            global $db;
            $contacts_dnc_query = " SELECT  contacts.id as contact, dsm_dnc.id as dsm_dnc
                                    FROM    dsm_dnc join contacts on digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_other)
                                    WHERE   contacts.deleted = 0
                                    AND     dsm_dnc.deleted = 0";
            $result             = $db->query($contacts_dnc_query, true,
                "Error retrieving matching contacts");

            $contact_dnc = array();
            $i = 0;
            while (($row      = $db->fetchByAssoc($result))) {
                $contact_dnc[$i]['contact'] = empty($row['contact']) ? "" : $row['contact'];
                $contact_dnc[$i]['dsm_dnc'] = empty($row['dsm_dnc']) ? "" : $row['dsm_dnc'];
                ++$i;
            }

            if (!empty($contact_dnc)) {
                foreach ($contact_dnc as $arr) {
                    $GLOBALS['log']->fatal($arr);
                    $contactBean = BeanFactory::newBean('Contacts')->retrieve($arr['contact']);
//                    if ($contactBean) {
//
//                        $contactBean->statut_dnc = "inactive";
//                        $contactBean->dsm_dnc_id = $arr['dsm_dnc'];
//                        $dnc_historic = BeanFactory::newBean('dsm_dnc_historic');
//                        $dnc_historic->name = $contactBean->name;
//                        $dnc_historic->statut_precedent = $contactBean->statut_dnc;
//                    }
                }
            }
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }

        return true;
    }
}