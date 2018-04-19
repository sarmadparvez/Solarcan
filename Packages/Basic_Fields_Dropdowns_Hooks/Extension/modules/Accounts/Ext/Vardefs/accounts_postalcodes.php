<?php
// created: 2018-04-03 11:58:04
$dictionary["Account"]["fields"]["contacts_postalcodes"] = array (
  'name' => 'contacts_postalcodes',
  'type' => 'link',
  'relationship' => 'contacts_postalcodes',
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
  'link' => 'contacts_postalcodes',
  'join_name' => 'contacts_postalcodes',
  'table' => 'rt_postal_codes',
  'module' => 'rt_postal_codes',
  'rname' => 'nostrate_legacy',
  'studio' => true,
);

$dictionary["Account"]["fields"]["postalcode_id"] = array (
  'name' => 'postalcode_id',
  'type' => 'id',
  'vname' => 'LBL_POSTALCODE_ID',
  'link' => 'contacts_postalcodes',
  'table' => 'rt_postal_codes',
  'module' => 'rt_postal_codes',
  'rname' => 'id',
  'reportable' => false,
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
);

$dictionary["Account"]["relationships"]["contacts_postalcodes"] = array(
  'lhs_module' => 'rt_postal_codes',
  'lhs_table' => 'rt_postal_codes',
  'lhs_key' => 'id',
  'rhs_module' => 'Accounts',
  'rhs_table' => 'accounts',
  'rhs_key' => 'postalcode_id',
  'relationship_type' => 'one-to-many',
);
