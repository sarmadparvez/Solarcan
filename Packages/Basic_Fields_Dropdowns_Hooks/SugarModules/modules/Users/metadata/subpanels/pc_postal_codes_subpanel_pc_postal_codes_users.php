<?php
// created: 2018-01-30 19:16:37
$subpanel_layout['list_fields'] = array (
  'user_name' => 
  array (
    'vname' => 'LBL_LIST_USER_NAME',
    'width' => 10,
    'default' => true,
  ),
  'title' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_TITLE',
    'width' => 10,
    'default' => true,
  ),
  'department' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_DEPARTMENT',
    'width' => 10,
    'default' => true,
  ),
  'email' => 
  array (
    'vname' => 'LBL_LIST_EMAIL',
    'width' => 10,
    'sortable' => false,
    'default' => true,
  ),
  'phone_work' => 
  array (
    'vname' => 'LBL_LIST_PHONE',
    'width' => 10,
    'default' => true,
  ),
  'status' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_STATUS',
    'width' => 10,
    'default' => true,
  ),
  'is_admin' => 
  array (
    'type' => 'bool',
    'default' => true,
    'studio' => 
    array (
      'listview' => false,
      'searchview' => false,
      'related' => false,
    ),
    'vname' => 'LBL_IS_ADMIN',
    'width' => 10,
  ),
  'first_name' => 
  array (
    'usage' => 'query_only',
  ),
  'last_name' => 
  array (
    'usage' => 'query_only',
  ),
);