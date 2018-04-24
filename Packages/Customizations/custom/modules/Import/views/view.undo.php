<?php
require_once('custom/include/helpers/CampaignListHelper.php');

class CustomImportViewUndo extends ImportViewUndo
{

    public function display()
    {
        if (isset($_REQUEST['import_module']) && $_REQUEST['import_module'] == 'dsm_dnc') {
            $helper = new CampaignListHelper();
            $regional_code = $helper->getRegionalCodeFromLastImport($_REQUEST['import_module']);
            if (!empty($regional_code)) {
                // import data from saved view earlier
                global $db;
                $dnc_restore = "INSERT INTO dsm_dnc SELECT * FROM dsm_dnc_old";
                $result   = $db->query($dnc_restore, true, "Error restoring dsm_dnc table");
                $dnc_restore = "DROP TABLE IF EXISTS dsm_dnc_old";
                $result   = $db->query($dnc_restore, true, "Error dropping dsm_dnc_old table");

                $stop_queued_job = "UPDATE job_queue
                                    SET status = 'done',
                                    resolution = 'undo_import',
                                    date_modified = UTC_TIMESTAMP()
                                    WHERE name = 'DNC Workflow: Update Contacts'
                                    AND data = ".$db->quoted($regional_code)."
                                    AND status = 'queued'";
                $db->query($stop_queued_job, true, "Error stopping 'DNC Workflow: Update Contacts' in queue");
            }
        }
        parent::display();
    }
}
