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
            $this->activateContacts($data);
            $this->deactivateContacts($data);
            $GLOBALS['log']->fatal("------------------------ DNC Workflow :: END ------------------------");
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }

        return true;
    }

    /**
    * Contacts which are on dnc list and currently activated in CRM should be deactivated.
    */
    protected function deactivateContacts($regional_code)
    {
        $db = DBManagerFactory::getInstance();
        // get those contacts which are on DNC list and currently having active status
        // they need to be changed to inactive
        $sql = "SELECT c.id as contact_id, dsm_dnc.id as dnc_id, dsm_dnc.date_enregistrement,
                c.first_name as first_name, c.last_name as last_name,
                c.statut_dnc as statut_dnc
                FROM dsm_dnc
                INNER JOIN contacts c
                ON (
                CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_home)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_mobile)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_work)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_other)
                )
                AND dsm_dnc.regional_code = ".$db->quoted($regional_code)."
                AND c.statut_dnc = 'active' 
                AND c.consentement = 0 
                AND c.deleted = 0";

        $result = $db->query($sql, true,"Error retrieving matching contacts");
        while ($row = $db->fetchByAssoc($result)) {
            $sql_update = "update contacts set statut_dnc = 'inactive', dsm_dnc_id = ";
            $sql_update .= $db->quoted($row['dnc_id']) . ", date_modified_pronto = ";
            $sql_update .= $db->quoted(TimeDate::getInstance()->nowDb());
            $sql_update .= ", date_modified = ". $db->quoted(TimeDate::getInstance()->nowDb());
            $sql_update .= " where id = ".$db->quoted($row['contact_id']);
            $db->query($sql_update);
            $this->updateDNCHistory($row, 'inactive');
        }
    }

    /**
    * Contacts which are no more on dnc list and currently deactivated in CRM should be activated.
    */
    protected function activateContacts($regional_code)
    {
        $db = DBManagerFactory::getInstance();
        // get thos contacts which are on DNC list and currently having inactive status
        // they need to be changed to active
        $sql = "SELECT c.id as contact_id, dsm_dnc.id as dnc_id, dsm_dnc.date_enregistrement,
                c.first_name as first_name, c.last_name as last_name,
                c.statut_dnc as statut_dnc
                FROM contacts c
                LEFT JOIN dsm_dnc
                ON (
                CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_home)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_mobile)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_work)
                OR CONCAT(dsm_dnc.regional_code, dsm_dnc.name) = digits(c.phone_other)
                )
                AND dsm_dnc.regional_code = ".$db->quoted($regional_code)."
                WHERE dsm_dnc.id IS NULL AND c.statut_dnc = 'inactive'
                AND (numberOfDigits(c.phone_home, 3) = ".$db->quoted($regional_code). "
                    OR numberOfDigits(c.phone_mobile, 3) = ".$db->quoted($regional_code). "
                    OR numberOfDigits(c.phone_work, 3) = ".$db->quoted($regional_code). "
                    OR numberOfDigits(c.phone_other, 3) = ".$db->quoted($regional_code). ");";

        $result = $db->query($sql, true,"Error retrieving matching contacts");
        while ($row = $db->fetchByAssoc($result)) {
            $sql_update = "update contacts set statut_dnc = 'active', dsm_dnc_id = ''";
            $sql_update .= ", date_modified_pronto = ";
            $sql_update .= $db->quoted(TimeDate::getInstance()->nowDb());
            $sql_update .= ", date_modified = ". $db->quoted(TimeDate::getInstance()->nowDb());
            $sql_update .= " where id = ".$db->quoted($row['contact_id']);
            $db->query($sql_update);
            $this->updateDNCHistory($row, 'active');
        }
    }
    /**
    * Generate DNC History record for contact
    * @param array $db_data row fetched from database
    * @param String $statut_dnc new status of the contact
    */
    protected function updateDNCHistory($db_data = array(), $statut_dnc = '')
    {
        $td = TimeDate::getInstance();
        $db = DBManagerFactory::getInstance();
        $timestamp = $td->nowDb();
        $id = create_guid();
        $sql = "INSERT INTO dsm_dnc_historic (id, name, date_entered, date_modified, modified_user_id, created_by, description, deleted,team_id,assigned_user_id, statut_precedent, contact_id, user_id ";
        $sql_values = "( ".$db->quoted($id).",";
        $sql_values.= $db->quoted($db_data['first_name']. " " . $db_data['last_name']);
        $sql_values.= ", ".$db->quoted($timestamp).", ". $db->quoted($timestamp) ;
        $sql_values.= ", ".$db->quoted($this->job->assigned_user_id).", ";
        $sql_values.= $db->quoted($this->job->assigned_user_id). " , NULL, 0, 1, ";
        $sql_values.= $db->quoted($this->job->assigned_user_id). ", ".$db->quoted($statut_dnc).", ";
        $sql_values.= $db->quoted($db_data['contact_id']). " , ".$db->quoted($this->job->assigned_user_id);
        $sql_conditional = ''; // will be inserted only if dnc_id is not empty
        $values_conditional = ''; // will be inserted only if dnc_id is not empty
        // if its deactivation of contact due to being on dnc list
        if (!empty($db_data['dnc_id'])) {
            $sql_conditional = ", dsm_dnc_id, date_enregistrement ";
            $values_conditional = ", ". $db->quoted($db_data['dnc_id']) . " , " ;
            $values_conditional.=$db->quoted($db_data['date_enregistrement']);
        }
        $dnc_historic_insert = $sql.$sql_conditional. " ) VALUES " .$sql_values.$values_conditional . " ) ";
        $db->query(
            $dnc_historic_insert, true , 
            "Query to insert dsm_dnc_historic failed"
        );
    }
}