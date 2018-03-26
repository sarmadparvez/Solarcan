<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

$manifest = array (
  'built_in_version' => '7.10.2.0',
  'acceptable_sugar_versions' => 
  array (
    0 => '7.10.*',
  ),
  'acceptable_sugar_flavors' => 
  array (
    0 => 'ENT',
    1 => 'ULT',
  ),
  'readme' => '',
  'key' => 'rt',
  'author' => 'rolustech',
  'description' => 'Execute sql scripts to create users, tele marketers, teams, postal codes and roles etc',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Solarcan Sql Scripts Execution 1.0.0',
  'published_date' => '2018-03-26 17:55:00',
  'type' => 'module',
  'version' => '1.0.0',
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'solarcan_sql_scripts_1.0.0',
  'copy' => 
    array (
        array (
          'from' => '<basepath>/sql/non_visible_fields_role.txt',
          'to' => 'custom/install/scripts/sql/non_visible_fields_role.txt',
        ),
        array (
          'from' => '<basepath>/sql/rt_postal_codes.txt',
          'to' => 'custom/install/scripts/sql/rt_postal_codes.txt',
        ),
        array (
          'from' => '<basepath>/sql/rt_postal_codes_users_c.txt',
          'to' => 'custom/install/scripts/sql/rt_postal_codes_users_c.txt',
        ),
        array (
          'from' => '<basepath>/sql/teams.txt',
          'to' => 'custom/install/scripts/sql/teams.txt',
        ),
        array (
          'from' => '<basepath>/sql/team_memberships.txt',
          'to' => 'custom/install/scripts/sql/team_memberships.txt',
        ),
        array (
          'from' => '<basepath>/sql/tm_telemarketers.txt',
          'to' => 'custom/install/scripts/sql/tm_telemarketers.txt',
        ),
        array (
          'from' => '<basepath>/sql/non_visible_fields_role.txt',
          'to' => 'custom/install/scripts/sql/non_visible_fields_role.txt',
        ),
        array (
          'from' => '<basepath>/sql/rt_classification.txt',
          'to' => 'custom/install/scripts/sql/rt_classification.txt',
        ),
    ),
    'post_install' => array(
        '<basepath>/scripts/post_install.php',
    )
);
