<?php

$dictionary['Campaign']['fields']['voxco_db'] = array(
	'name' => 'voxco_db',
	'vname' => 'LBL_VOXCO_DB',
	'type' => 'varchar',
	'len' => '25',
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
