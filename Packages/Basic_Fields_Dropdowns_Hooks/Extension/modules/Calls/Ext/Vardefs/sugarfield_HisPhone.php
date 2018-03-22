<?php

$dictionary['Call']['fields']['HisPhone'] = array(
  'name' => 'HisPhone',
  'vname' => 'LBL_PHONE',
  'type' => 'varchar',
  'len' => '20',
  'duplicate_on_record_copy' => 'always',
  'comment' => 'Phone number called from voxco',
  'merge_filter' => 'disabled',
  'audited' => true,
  'massupdate' => false,
  'duplicate_merge' => 'enabled',
  'duplicate_merge_dom_value' => '1',
  'calculated' => false,
);
