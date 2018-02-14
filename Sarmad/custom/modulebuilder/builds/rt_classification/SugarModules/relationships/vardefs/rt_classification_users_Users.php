<?php
// created: 2018-01-31 11:47:16
$dictionary["User"]["fields"]["rt_classification_users"] = array (
  'name' => 'rt_classification_users',
  'type' => 'link',
  'relationship' => 'rt_classification_users',
  'source' => 'non-db',
  'module' => 'rt_Classification',
  'bean_name' => 'rt_Classification',
  'side' => 'right',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_USERS_TITLE',
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link-type' => 'one',
);
$dictionary["User"]["fields"]["rt_classification_users_name"] = array (
  'name' => 'rt_classification_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_RT_CLASSIFICATION_TITLE',
  'save' => true,
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link' => 'rt_classification_users',
  'table' => 'rt_classification',
  'module' => 'rt_Classification',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["rt_classification_usersrt_classification_ida"] = array (
  'name' => 'rt_classification_usersrt_classification_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_USERS_TITLE_ID',
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link' => 'rt_classification_users',
  'table' => 'rt_classification',
  'module' => 'rt_Classification',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
