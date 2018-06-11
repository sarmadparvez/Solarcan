<?php

/**
 * JIRA DEV-654
 * new relation add for meeting-telemarketer
 * By: SMQB 
 * Date: 07/06/2018
 */

$dictionary["Meeting"]["fields"]["meeting_telemarketer"] = array (
  'name' => 'meeting_telemarketer',
  'type' => 'link',
  'relationship' => 'meeting_telemarketer',
  'source' => 'non-db',
  'module' => 'tm_telemarketers',
  'bean_name' => 'tm_telemarketers',
  'vname' => 'LBL_TELEMARKETER',
  'id_name' => 'telemarketer_id',
);

$dictionary['Meeting']['fields']['telemarketer_name'] = array(
    'required' => false,
    'source' => 'non-db',
    'name' => 'telemarketer_name',
    'vname' => 'LBL_TELEMARKETER',
    'type' => 'relate',
    'rname' => 'name',
    'id_name' => 'telemarketer_id',
    'join_name' => 'meeting_telemarketer',
    'link' => 'meeting_telemarketer',
    'table' => 'tm_telemarketers',
    'isnull' => 'true',
    'module' => 'tm_telemarketers',
);

$dictionary["Meeting"]["fields"]["telemarketer_id"] = array (
  'name' => 'telemarketer_id',
  'type' => 'id',
  'vname' => 'LBL_TELEMARKETER_ID',
  'link' => 'meeting_telemarketer',
  'table' => 'tm_telemarketers',
  'module' => 'tm_telemarketers',
  'rname' => 'id',
  'reportable' => false,
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
);


$dictionary["Meeting"]["relationships"]["meeting_telemarketer"] = array(
  'lhs_module' => 'tm_telemarketers',
  'lhs_table' => 'tm_telemarketers',
  'lhs_key' => 'id',
  'rhs_module' => 'Meetings',
  'rhs_table' => 'meetings',
  'rhs_key' => 'telemarketer_id',
  'relationship_type' => 'one-to-many',
);
