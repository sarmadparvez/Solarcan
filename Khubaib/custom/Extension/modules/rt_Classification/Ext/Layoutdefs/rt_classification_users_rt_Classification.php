<?php
 // created: 2018-01-31 11:47:16
$layout_defs["rt_Classification"]["subpanel_setup"]['rt_classification_users'] = array (
  'order' => 100,
  'module' => 'Users',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_RT_CLASSIFICATION_USERS_FROM_USERS_TITLE',
  'get_subpanel_data' => 'rt_classification_users',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);
