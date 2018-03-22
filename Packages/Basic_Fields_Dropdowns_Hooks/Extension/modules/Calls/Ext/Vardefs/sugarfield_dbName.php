<?php

$dictionary['Call']['fields']['dbName'] = array(
	'name' => 'dbName',
	'vname' => 'LBL_VOXCO_DB',
	'type' => 'varchar',
	'len' => '255',
	'duplicate_on_record_copy' => 'always',
	'comment' => 'Db name in Voxco',
	'merge_filter' => 'disabled',
	'audited' => true,
	'massupdate' => false,
	'comments' => 'Db name in Voxco',
	'duplicate_merge' => 'enabled',
	'duplicate_merge_dom_value' => '1',
	'calculated' => false,
);
