<?php

class CustomImportViewUndo extends ImportViewUndo
{

    public function display()
    {
        parent::display();

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
                            AND status = 'queued'";
        $result   = $db->query($stop_queued_job, true, "Error stopping 'DNC Workflow: Update Contacts' in queue");
    }
}
