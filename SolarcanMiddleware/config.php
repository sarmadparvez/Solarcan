<?php

/**
* Store all configurations in this file
*/

$app_config = array(

	'entity_to_table' => array(
		'push_to_sugarcrm' => 'pushToSugarCRM',
		'pull_from_sugarcrm' => 'pushToVoxco',
	),
	'entity_to_sugarmodule' => array(
		'push_to_sugarcrm' => 'Calls'
	),
	'logs_time_zone' => 'Asia/Karachi',
	'db_config' => array(
		'hostname' => 'WIN-L1IV7FJOBA1\\SQL2K14',
		'db_name' => 'SugarCRMBridge',
		'username' => 'sa',
		'password' => 'abc@123',
		'port' =>'49528',
	),
	'log_dir' => ROOT . 'logs/',
	'push_to_sugarcrm_chunk_size' => 10,
	'pull_from_sugarcrm_chunk_size' => 10,
	//'sugar_api_url' => 'http://192.168.3.74/Solarcan/Sugar/rest/v11',
	'sugar_api_url' => 'https://staging3.rolustech.com:4439/rest/v11',
	'bulkimport_endpoint' => '/BulkImport/records/:module',
	'pull_from_sugarcrm_endpoint' => '/CampaignList',
	//'bulkimport_rels_endpoint' => '/BulkImport/relationships/:module/:link_name',
	'sugar_username' => 'admin',
	'sugar_password' => 'asdf',
	'entities_to_sync' => array(
		// Note: Only change this for testing or debugging purpose. keep default to all
		// possible values, 'all', 'files', 'local', 'sugar'
		'all'
		//'push_to_sugarcrm',
		//'pull_from_sugarcrm',
	),
	'enable_curl_logs' => true,
	'force_pull_from_sugarcrm_all' => false, //by default keep to false, used to force sync all data from default date
	'pull_from_sugarcrm_default' => '', // for the first sync, this date time will be used to synced the records after
	'log_table_max_rows' => 200,
	'sync_interval' => array(
		'minutes' => 0,
		'hours' => 0,
	),
);
