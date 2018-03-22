<?php

$dictionary['Campaign']['fields']['date_modified_pronto'] = array(
	'name' => 'date_modified_pronto',
	'vname' => 'LBL_DATE_MODIFIED_VOXCO',
	'type' => 'datetime',
	'comment' => 'Date record last modified for pronto fields',
	'enable_range_search' => '1',
	'studio' => true,
	'options' => 'date_range_search_dom',
	'duplicate_on_record_copy' => 'no',
	'readonly' => true,
	'massupdate' => false,
	'audited' => false,
	'comments' => 'Date record last modified for pronto fields',
	'duplicate_merge' => 'enabled',
	'duplicate_merge_dom_value' => 1,
	'merge_filter' => 'disabled',
	'calculated' => false,
);
