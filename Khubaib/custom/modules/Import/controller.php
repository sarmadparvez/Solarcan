<?php
if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

class CustomImportController extends ImportController
{

    function action_DropDNCBackup()
    {
        global $db;
        $dnc_backup = "DROP TABLE IF EXISTS dsm_dnc_old";
        $db->query($dnc_backup, true, 'Failed to drop table dsm_dnc_old');
        $GLOBALS['log']->fatal("dsm_dnc_old dropped");
        return;
    }
}
