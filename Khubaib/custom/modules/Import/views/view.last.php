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
        $GLOBALS['log']->fatal("Custom ImportViewLast Display");
        global $current_user;
        $job                   = new SchedulersJob();
        $job->name             = "DNC Workflow: Update Contacts";
        $job->target           = "class::ContactsDNCUpdate";
        $job->assigned_user_id = $current_user->id;
        $queue                 = new SugarJobQueue();
        $queue->submitJob($job);

        parent::display();
    }
}
