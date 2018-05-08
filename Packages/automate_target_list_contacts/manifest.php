<?php
$manifest =array (
  'acceptable_sugar_versions' => 
   array (
    0 => '7.*.*.*',
  ),
  'author' => 'RT',
  'description' => 'This package will use the scheduler which will add/delete the contacts in target list based on report critearea',
  'icon' => '',
  'is_uninstallable' => 'false',
  'name' => 'automate_target_list_contacts',
  'published_date' => '2018-05-08 20:37:34',
  'type' => 'module',
  'version' => '1525793854',
);
$installdefs =array (
  'id' => 'automate_target_list_contacts',
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/install/custom/clients/base/fields/linkfromreportbutton/linkfromreportbutton.js',
      'to' => 'custom/clients/base/fields/linkfromreportbutton/linkfromreportbutton.js',
    ),
    1 => 
    array (
      'from' => '<basepath>/install/custom/include/helpers/ProspectListHelper.php',
      'to' => 'custom/include/helpers/ProspectListHelper.php',
    ),
    2 => 
    array (
      'from' => '<basepath>/install/custom/modules/ProspectLists/clients/base/api/ProspectListsRelateRecordApi.php',
      'to' => 'custom/modules/ProspectLists/clients/base/api/ProspectListsRelateRecordApi.php',
    ),
    3 => 
    array (
      'from' => '<basepath>/install/custom/Extension/modules/Schedulers/Ext/Language/en_us.automateTargetListForContacts.php',
      'to' => 'custom/Extension/modules/Schedulers/Ext/Language/en_us.automateTargetListForContacts.php',
    ),
    4 => 
    array (
      'from' => '<basepath>/install/custom/Extension/modules/Schedulers/Ext/ScheduledTasks/automateTargetListForContacts.php',
      'to' => 'custom/Extension/modules/Schedulers/Ext/ScheduledTasks/automateTargetListForContacts.php',
    ),
    5 => 
    array (
      'from' => '<basepath>/install/custom/Extension/modules/ProspectLists/Ext/Language/en_us.lang.php',
      'to' => 'custom/Extension/modules/ProspectLists/Ext/Language/en_us.lang.php',
    ),
    6 => 
    array (
      'from' => '<basepath>/install/custom/Extension/modules/ProspectLists/Ext/Vardefs/sugarfield_report_id.php',
      'to' => 'custom/Extension/modules/ProspectLists/Ext/Vardefs/sugarfield_report_id.php',
    ),
    7 => 
    array (
      'from' => '<basepath>/install/custom/Extension/modules/ProspectLists/Ext/Vardefs/sugarfield_generation_date.php',
      'to' => 'custom/Extension/modules/ProspectLists/Ext/Vardefs/sugarfield_generation_date.php',
    ),
  ),
  'beans' => 
  array (
  ),
  'logic_hooks' => 
  array (
  ),
);
