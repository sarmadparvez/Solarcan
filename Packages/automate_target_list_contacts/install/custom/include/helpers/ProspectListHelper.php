<?php

require_once('custom/include/helpers/UtHelper.php');

class ProspectListHelper
{
       use UtHelper;
       protected $processed_prospect_lists = array();
       protected $last_sync_date = '';
       protected $processed_rows = array(
           'inserted' => 0,
           'updated' => 0,
       );
       /**
       * @param string $report_id
       * @return array
       */
       public function getRecordIds($report_id) {
          if (empty($report_id)) {
              return array();
          }
          $savedReport = $this->retrieveBean('Reports', $report_id, array('disable_row_level_security' => true));
          $recordIds = array();
          if ($savedReport != null) {
            $reportDef = json_decode(html_entity_decode($savedReport->content), true);
            $recordIds = $this->getRecordIdsFromReport($reportDef);
          }
          return $recordIds;
       }
       /**
       * @param string $report_id
       * @return array
       */
       public function getReportQuery($report_id) {
          if (empty($report_id)) {
              return '';
          }
          $savedReport = $this->retrieveBean('Reports', $report_id, array('disable_row_level_security' => true));
          $query = '';
          if ($savedReport != null) {
            $reportDef = json_decode(html_entity_decode($savedReport->content), true);
            $report = new childReport($reportDef);
            $report->create_where();
            $report->build_from();
            $id = $report->full_bean_list['self']->table_name . '.id';
            $query = "SELECT DISTINCT $id {$report->from} WHERE {$report->where} AND {$report->focus->table_name}.deleted=0";
            $query .= " ORDER BY $id ASC";
          }
          return $query;
       }

       /**
       * Returns the record ids of a saved report
       * @param array $reportDef
       * @param integer $offset
       * @param integer $limit
       * @return array Array of record ids
       */
       protected function getRecordIdsFromReport($reportDef, $offset = 0, $limit = -1)
       {
           $report = new Report($reportDef);
           return $report->getRecordIds($offset, $limit);
       }
       /**
        * 
        * @global type $db
        */
       public function processTargetLists()
       {
           global $db;
           $job_name = 'function::automateTargetListForContacts';
           $last_sync_date = $this->getLastRun($job_name);
           $this->last_sync_date = $last_sync_date;

           /**If report is modified after the last execution of the scheduler
              Add/Remove Contacts
           **/
           $modified_report_query = 'Select sr.id as report_id, pl.id as prospect_list_id from saved_reports sr INNER join prospect_lists pl 
                   on pl.contact_report_id = sr.id AND pl.deleted = 0 where sr.deleted = 0 AND sr.date_modified > '.$db->quoted($last_sync_date);
           $this->processQueryForTargetList($modified_report_query, 'ADD_REMOVE');

           /**If any contact is modified
              Add/Remove Contacts
           **/
           $contact_ids = $this->getModifiedContacts($this->last_sync_date);
           if (!empty($contact_ids)) {
               $modified_report_query = 'Select sr.id as report_id, pl.id as prospect_list_id from saved_reports sr INNER join prospect_lists pl 
                   on pl.contact_report_id = sr.id AND pl.deleted = 0 where sr.deleted = 0';
                $this->processQueryForTargetList($modified_report_query, 'ADD_REMOVE');
           }

           /**If generation date is greater than the modified reports
              Remove Contacts
           **/
           $latest_report_query = 'Select sr.id as report_id, pl.id as prospect_list_id from saved_reports sr INNER join prospect_lists pl 
                   on pl.contact_report_id = sr.id AND pl.deleted = 0 where sr.deleted = 0 AND pl.contact_generation_date > sr.date_modified';
           $this->processQueryForTargetList($latest_report_query, 'REMOVE');

           $GLOBALS['log']->fatal('Total Rows Processed: [Inserted:- '.$this->processed_rows["inserted"].'] [Removed:- '.$this->processed_rows["updated"].']');
           
       }
       
       /**
       * Checks if the record date is greater from scheduler last run
       * @param datetime $record_date
       * @return boolean
       */
       protected function isUpdatedEntry($record_date, $function)
       {
           $query = new SugarQuery();
           $query->from(BeanFactory::getBean('Schedulers'), array('team_security' => false,));
           $query->select(array('last_run'));
           $query->where()->equals('job', "{$function}");
           $last_run = $query->getOne();
           if (strtotime($record_date) >= strtotime($last_run)) {
               return false;
           }
           return true;
       }

       /**
        * Get the last run of the scheduler
        * @param string $function
        * @return string
        */
       protected function getLastRun($function)
       {
           $query = new SugarQuery();
           $query->from(BeanFactory::getBean('Schedulers'), array('team_security' => false,));
           $query->select(array('last_run'));
           $query->where()->equals('job', "{$function}");
           return $query->getOne();
       }
       /**
       * Process the contacts
       * @param string $report_id
       * @return string
       */
       protected function processContactsInProspectList($report_id, $prospect_list_id, $action)
       {
          global $db;
          $report_query = $this->getReportQuery($report_id);
          if (empty($report_query)) {
              return;
          }
          // Query to remove the contacts
          $remove_query_select = $this->getProspectListQuery($prospect_list_id, $report_id, $report_query, 'LEFT JOIN');                    
          // Query to add the contacts
          $add_query_select = $this->getProspectListQuery($prospect_list_id,$report_id, $report_query, 'RIGHT JOIN');
          $date = TimeDate::getInstance()->asDbDate(TimeDate::getInstance()->getNow(true));
          if ($action == 'ADD_REMOVE') {
              $insert = 'Insert into prospect_lists_prospects (id,prospect_list_id,related_id,related_type,date_modified,deleted)'.$add_query_select;
              $update = 'Update prospect_lists_prospects set deleted = 1,date_modified ='.$db->quoted($date).' where id in (select id from ('.$remove_query_select.') tmp)';
              $update_result = $db->query($update);
              $u_rows = $db->getAffectedRowCount($update_result);
              $this->processed_rows['updated'] = $this->processed_rows['updated'] + $u_rows;
              $insert_result= $db->query($insert);
              $i_rows = $db->getAffectedRowCount($insert_result);
              $this->processed_rows['inserted'] = $this->processed_rows['inserted'] + $i_rows;
          } elseif ($action == 'REMOVE') {
              $update = 'Update prospect_lists_prospects set deleted = 1,date_modified ='.$db->quoted($date).' where id in (select id from ('.$remove_query_select.') tmp)';              
              $update_result = $db->query($update);
              $u_rows = $db->getAffectedRowCount($update_result);
              $this->processed_rows['updated'] = $this->processed_rows['updated'] + $u_rows;
          }
          array_push($this->processed_prospect_lists, $prospect_list_id);
       }
       /**
       * Process the contacts
       * @param string $report_query
       * @param $action
       *
       */
       protected function processQueryForTargetList($report_query, $action = '')
       {
            global $db;
            $reports_result = $db->query($report_query);
            if ($reports_result->num_rows > 0) {
                while ($row = $db->fetchByAssoc($reports_result)) {
                     $report_id = $row['report_id'];
                     $prospect_list_id = $row['prospect_list_id'];
                     if (!in_array($prospect_list_id, $this->processed_prospect_lists)) {
                        $this->processContactsInProspectList($report_id, $prospect_list_id, $action);
                     }
                 }
            }
       }
       /**
       * Get the prospect list related contacts
       * @param string $prospect_list_id
       * @return array
       */
       protected function getProspectListContacts($prospect_list_id)
       {
          global $db;
          $select = 'Select related_id from prospect_lists_prospects where related_type = "Contacts" AND deleted = 0 AND prospect_list_id='.$db->quoted($prospect_list_id);
          $query_result = $db->query($select);
          $contact_ids = array();
          while ($row = $db->fetchByAssoc($query_result)) {
              array_push($contact_ids, $row['related_id']);
          }
          return $contact_ids;
       }
       /**
       * Get the prospect list related contacts
       * @param string $prospect_list_id
       * @return query
       */
       protected function getProspectListQuery($prospect_list_id, $report_id, $contact_query, $join_type)
       {
          global $db;
          $column = 'plp.id, related_id';
          $condition = '1';
          $date = TimeDate::getInstance()->asDbDate(TimeDate::getInstance()->getNow(true));
          if ($join_type == 'RIGHT JOIN') {
              $column = 'uuid(),'.$db->quoted($prospect_list_id).',sq.id, "Contacts", '.$db->quoted($date).', 0';
              $condition = 'plp.id is null';
          } else {
              $condition = 'sq.id is null and plp.deleted = 0 AND plp.prospect_list_id = '.$db->quoted($prospect_list_id);
          }
          $select = 'Select '.$column.' from prospect_lists_prospects plp 
                    '.$join_type.' ('.$contact_query.')
                    sq on sq.id = plp.related_id AND plp.related_type = "Contacts" 
                    AND plp.prospect_list_id = '.$db->quoted($prospect_list_id).'
                    AND plp.deleted = 0
                    where ' .$condition;
          return $select;
       }
       /**
       * Get the modified contacts from the last sync date
       * @param string $last_sync_date
       * @return array
       */
       protected function getModifiedContacts($last_sync_date)
       {
          global $db;
          $select = 'Select id from
                   contacts c where c.deleted = 0 AND c.date_modified > '.$db->quoted($last_sync_date);
          $query_result = $db->query($select);
          $contact_ids = array();
          while ($row = $db->fetchByAssoc($query_result)) {
              array_push($contact_ids, $row['contact_id']);
          }
          return $contact_ids;
       }
}
class childReport extends Report {
    public function build_from() {
        $this->create_from();
    }
}