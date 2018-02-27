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
/* * *******************************************************************************

 * Description: view handler for last step of the import process
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * ****************************************************************************** */

class CustomImportViewLast extends ImportViewLast
{
    protected $pageTitleKey = 'LBL_STEP_5_TITLE';
    var $lvf;

    /**
     * @see SugarView::display()
     */
    public function display()
    {
        /**
         * Add Schedule job in Queue
         */
        global $current_user, $db;
        // query to check if previously created job is already in queue
        $previousJobQuery = "   SELECT status
                                FROM job_queue
                                WHERE name = 'DNC Workflow: Update Contacts'
                                ORDER BY date_modified desc
                                LIMIT 1";
        $result           = $db->query($previousJobQuery, true,
            "Error retrieving previous job status");
        $row              = $db->fetchByAssoc($result);
        $addNewJob        = TRUE;
        if ($row) {
            // if job is already in queue from previous import then do not add a new job
            if ($row['status'] == 'queued') {
                $addNewJob = FALSE;
            }
        }

        if ($addNewJob == TRUE) {
            $job                   = new SchedulersJob();
            $job->name             = "DNC Workflow: Update Contacts";
            $job->target           = "class::ContactsDNCUpdate";
            $job->assigned_user_id = $current_user->id;

            $queue = new SugarJobQueue();
            $queue->submitJob($job);
            $GLOBALS['log']->debug("DNC Workflow: Update Contacts job queued");
        } else {
            $GLOBALS['log']->debug("DNC Workflow: Update Contacts job already queued");
        }

        parent::display();
    }
}