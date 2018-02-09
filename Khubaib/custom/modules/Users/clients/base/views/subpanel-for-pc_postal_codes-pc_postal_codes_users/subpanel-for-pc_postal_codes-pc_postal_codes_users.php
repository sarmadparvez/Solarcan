<?php
// created: 2018-01-30 19:16:39
$viewdefs['Users']['base']['view']['subpanel-for-pc_postal_codes-pc_postal_codes_users'] = array (
  'panels' => 
  array (
    0 => 
    array (
      'name' => 'panel_header',
      'label' => 'LBL_PANEL_1',
      'fields' => 
      array (
        0 => 
        array (
          'name' => 'name',
          'label' => 'LBL_NAME',
          'enabled' => true,
          'default' => true,
          'sortable' => false,
          'link' => true,
        ),
        1 => 
        array (
          'name' => 'user_name',
          'label' => 'LBL_USER_NAME',
          'sortable' => true,
          'default' => true,
          'enabled' => true,
        ),
        2 => 
        array (
          'name' => 'title',
          'label' => 'LBL_TITLE',
          'enabled' => true,
          'default' => true,
        ),
        3 => 
        array (
          'name' => 'department',
          'label' => 'LBL_DEPARTMENT',
          'enabled' => true,
          'default' => true,
        ),
        4 => 
        array (
          'name' => 'email',
          'label' => 'LBL_EMAIL',
          'enabled' => true,
          'default' => true,
          'sortable' => false,
        ),
        5 => 
        array (
          'name' => 'phone_work',
          'label' => 'LBL_OFFICE_PHONE',
          'default' => true,
          'enabled' => true,
        ),
        6 => 
        array (
          'name' => 'status',
          'label' => 'LBL_STATUS',
          'enabled' => true,
          'default' => true,
        ),
        7 => 
        array (
          'name' => 'is_admin',
          'label' => 'LBL_IS_ADMIN',
          'enabled' => true,
          'default' => true,
        ),
      ),
    ),
  ),
  'rowactions' => 
  array (
    'actions' => 
    array (
      0 => 
      array (
        'type' => 'unlink-action',
        'icon' => 'fa-chain-broken',
        'label' => 'LBL_UNLINK_BUTTON',
      ),
    ),
  ),
  'type' => 'subpanel-list',
);