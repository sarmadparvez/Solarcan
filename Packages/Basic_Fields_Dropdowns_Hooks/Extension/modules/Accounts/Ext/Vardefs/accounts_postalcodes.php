<?php
// created: 2018-04-03 11:58:04
$dictionary["Account"]["fields"]["accounts_postalcodes"] = array (
  'name' => 'accounts_postalcodes',
  'type' => 'link',
  'relationship' => 'accounts_postalcodes',
  'source' => 'non-db',
  'module' => 'rt_postal_codes',
  'bean_name' => 'rt_postal_codes',
  'vname' => 'LBL_CONTACTS_POSTALCODES',
  'id_name' => 'postalcode_id',
);

$dictionary["Account"]["fields"]["region_strate_c"] = array (
  'name' => 'region_strate_c',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_REGION_STRATE',
  'id_name' => 'postalcode_id',
  'link' => 'accounts_postalcodes',
  'join_name' => 'accounts_postalcodes',
  'table' => 'rt_postal_codes',
  'module' => 'rt_postal_codes',
  'rname' => 'nostrate_legacy',
  'studio' => true,
);

$dictionary["Account"]["fields"]["postalcode_id"] = array (
  'name' => 'postalcode_id',
  'type' => 'id',
  'vname' => 'LBL_POSTALCODE_ID',
  'link' => 'accounts_postalcodes',
  'table' => 'rt_postal_codes',
  'module' => 'rt_postal_codes',
  'rname' => 'id',
  'reportable' => false,
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
);

/**
 * JIRA DEV-595
 * relation name changed
 * By: SMQB 
 * Date: 05/06/2018
 */
$dictionary["Account"]["relationships"]["accounts_postalcodes"] = array(
  'lhs_module' => 'rt_postal_codes',
  'lhs_table' => 'rt_postal_codes',
  'lhs_key' => 'id',
  'rhs_module' => 'Accounts',
  'rhs_table' => 'accounts',
  'rhs_key' => 'postalcode_id',
  'relationship_type' => 'one-to-many',
);
