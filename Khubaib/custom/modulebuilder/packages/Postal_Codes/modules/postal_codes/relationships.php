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
$relationships = array (
  'rt_postal_codes_users' => 
  array (
    'rhs_label' => 'Users',
    'lhs_label' => 'Postal Codes',
    'lhs_subpanel' => 'default',
    'rhs_subpanel' => 'default',
    'lhs_module' => 'rt_postal_codes',
    'rhs_module' => 'Users',
    'relationship_type' => 'many-to-many',
    'readonly' => false,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
    'relationship_name' => 'rt_postal_codes_users',
  ),
);