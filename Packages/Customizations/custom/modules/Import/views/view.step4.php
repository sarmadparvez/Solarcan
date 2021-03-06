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

 * Description: view handler for step 4 of the import process
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * ****************************************************************************** */

class CustomImportViewStep4 extends ImportViewStep4
{
//    protected $currentStep;

    public function __construct($bean = null, $view_object_map = array())
    {
        parent::__construct($bean, $view_object_map);
        $this->currentStep = isset($_REQUEST['current_step']) ? ($_REQUEST['current_step']
            + 1) : 1;
    }

    /**
     * @see SugarView::display()
     */
    public function display()
    {
        global $mod_strings, $sugar_config, $app_strings;

        // Check to be sure we are getting an import file that is in the right place
        $uploadFile = "upload://".basename($_REQUEST['tmp_file']);
        if(!SugarAutoLoader::fileExists($uploadFile)) {
            trigger_error($mod_strings['LBL_CANNOT_OPEN'],E_USER_ERROR);
        }

        $uploadFiles = explode("-", $uploadFile);
        $currentPart = end($uploadFiles);

        $delimiter = $this->getDelimiterValue();
        // Open the import file
        $importSource = new ImportFile(
            $uploadFile,
            $delimiter,
            html_entity_decode($_REQUEST['custom_enclosure'], ENT_QUOTES),
            true,
            true,
            $sugar_config['import_max_records_per_file'] * $currentPart
        );

        //Ensure we have a valid file.
        if ( !$importSource->fileExists() )
            trigger_error($mod_strings['LBL_CANNOT_OPEN'],E_USER_ERROR);

        if (!ImportCacheFiles::ensureWritable())
        {
            trigger_error($mod_strings['LBL_ERROR_IMPORT_CACHE_NOT_WRITABLE'], E_USER_ERROR);
        }

        /**
         * Truncate DNC table if importing DNC list
         */
        if (isset($_REQUEST['import_module']) && $_REQUEST['import_module'] == 'dsm_dnc') {
            $GLOBALS['log']->debug("CURRENT PART: $currentPart");
            if ($currentPart == 0) {
                global $db;
                // get regional code from CSV which is in first column.
                $regional_code = $this->getValueForColumnNumber($importSource, 0);
                if (empty($regional_code)) {
                    $GLOBALS['log']->fatal("Regional code missing in uploaded DNC file");
                    trigger_error($app_strings['ERR_INVALID_DNC_FILE'], E_USER_ERROR);
                }
                // first save current dsm_dnc
                $dnc_backup = "DROP TABLE IF EXISTS dsm_dnc_old";
                $db->query($dnc_backup, true, 'Failed to drop table dsm_dnc_old');
                $dnc_backup = "CREATE TABLE dsm_dnc_old AS SELECT * FROM dsm_dnc where regional_code = ".
                    $db->quoted($regional_code);
                $db->query($dnc_backup, true, 'Failed to Backup dsm_dnc table');

                // truncate dsm_dnc table
                $dnc_delete = "DELETE FROM dsm_dnc WHERE regional_code = ".$db->quoted($regional_code);
                $db->query($dnc_delete, true,
                    'Failed to remove records from dsm_dnc table having regional_code: '.$regional_code);
            }
        }

        $importer = new Importer($importSource, $this->bean);
        $importer->import();
    }

    /**
    * Get first value of specific column number
    * @return String
    */
    protected function getValueForColumnNumber($importSource = NULL, $columnNumber)
    {
        if (empty($importSource)) {
            return false;
        }
        foreach ($importSource as $row) {
            return $row[$columnNumber];
        }
        return false;
    }
}