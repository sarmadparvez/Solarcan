<?php

$dictionary['Contact']['fields']['region'] = array(
	'name' => 'region',
	'vname' => 'LBL_REGION',
	'type' => 'varchar',
	'len' => '50',
	'unified_search' => true,
	'duplicate_on_record_copy' => 'always',
	'full_text_search' => 
	array (
	'enabled' => true,
	'boost' => '1.99',
	'searchable' => true,
	),
	'comment' => 'Region of the contact',
	'merge_filter' => 'disabled',
	'audited' => true,
	'massupdate' => false,
	'duplicate_merge' => 'enabled',
	'duplicate_merge_dom_value' => '1',
	'calculated' => false,
	'studio' => true,
);
