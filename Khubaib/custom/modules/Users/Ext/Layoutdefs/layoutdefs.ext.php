<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Layoutdefs/rt_postal_codes_users_Users.php

 // created: 2018-01-31 12:37:05
$layout_defs["Users"]["subpanel_setup"]['rt_postal_codes_users'] = array (
  'order' => 100,
  'module' => 'rt_postal_codes',
  'subpanel_name' => 'default',
  'sort_order' => 'asc',
  'sort_by' => 'id',
  'title_key' => 'LBL_RT_POSTAL_CODES_USERS_FROM_RT_POSTAL_CODES_TITLE',
  'get_subpanel_data' => 'rt_postal_codes_users',
  'top_buttons' => 
  array (
    0 => 
    array (
      'widget_class' => 'SubPanelTopButtonQuickCreate',
    ),
    1 => 
    array (
      'widget_class' => 'SubPanelTopSelectButton',
      'mode' => 'MultiSelect',
    ),
  ),
);

?>
