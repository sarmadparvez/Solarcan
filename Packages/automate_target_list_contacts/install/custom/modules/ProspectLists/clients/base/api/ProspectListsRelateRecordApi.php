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

class ProspectListsRelateRecordApi extends RelateRecordApi
{
    public function registerApiRest() {
        return array(
            'createRelatedLinksFromRecordList' => array(
                'reqType' => 'POST',
                'path' => array('ProspectLists', '?', 'link', 'contacts', 'add_record_list', '?'),
                'pathVars' => array('module', 'record', '', 'link_name', '', 'remote_id'),
                'method' => 'createRelatedLinksFromRecordList',
                'shortHelp' => 'Relates existing records from a record list to this record.',
                'longHelp' => 'include/api/help/module_record_links_from_recordlist_post_help.html',
            ),
        );
    }

    public function createRelatedLinksFromRecordList(ServiceBase $api, array $args)
    {
        $result = parent::createRelatedLinksFromRecordList($api, $args);
        global $db, $timedate;
        $record_id = $args['record'];
        $report_id = $args['report_id'];
        $generation_date = $timedate->nowDb();
        $query = 'Update prospect_lists set contact_report_id = '.$db->quoted($report_id).' ,
                 contact_generation_date = '.$db->quoted($generation_date).' where deleted = 0 AND id = '.$db->quoted($record_id);
        $db->query($query);
        return $result;
    }
}
