<?php

$dictionary['Call']['fields']['HisRespondent'] = array(
	'name' => 'HisRespondent',
	'vname' => 'LBL_HisRespondent',
	'type' => 'varchar',
	'len' => '50',
	'duplicate_on_record_copy' => 'always',
	'comment' => 'Link to the contact ID in Sugar',
	'merge_filter' => 'disabled',
	'audited' => false,
	'massupdate' => false,
	'comments' => 'Link to the contact ID in Sugar',
	'duplicate_merge' => 'enabled',
	'duplicate_merge_dom_value' => '1',
	'calculated' => false,
);
