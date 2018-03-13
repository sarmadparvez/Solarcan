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
  'accounts_opportunities' => 
  array (
    'name' => 'accounts_opportunities',
    'table' => 'accounts_opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'account_id' => 
      array (
        'name' => 'account_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'accounts_opportunitiespk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_account_opportunity',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'account_id',
          1 => 'opportunity_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_oppid_del_accid',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'opportunity_id',
          1 => 'deleted',
          2 => 'account_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'accounts_opportunities' => 
      array (
        'lhs_module' => 'Accounts',
        'lhs_table' => 'accounts',
        'lhs_key' => 'id',
        'rhs_module' => 'Opportunities',
        'rhs_table' => 'opportunities',
        'rhs_key' => 'id',
        'relationship_type' => 'one-to-many',
        'join_table' => 'accounts_opportunities',
        'join_key_lhs' => 'account_id',
        'join_key_rhs' => 'opportunity_id',
        'true_relationship_type' => 'one-to-many',
      ),
    ),
    'lhs_module' => 'Accounts',
    'lhs_table' => 'accounts',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'accounts_opportunities',
    'join_key_lhs' => 'account_id',
    'join_key_rhs' => 'opportunity_id',
    'true_relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'accounts_opportunities',
    'rhs_subpanel' => 'ForAccountsOpportunities',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_contacts' => 
  array (
    'name' => 'opportunities_contacts',
    'table' => 'opportunities_contacts',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'contact_id' => 
      array (
        'name' => 'contact_id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'contact_role' => 
      array (
        'name' => 'contact_role',
        'type' => 'varchar',
        'len' => '50',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'opportunities_contactspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_con_opp_con',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'contact_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_con_opp_opp',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'opportunity_id',
        ),
      ),
      3 => 
      array (
        'name' => 'idx_opportunities_contacts',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'opportunity_id',
          1 => 'contact_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'opportunities_contacts' => 
      array (
        'lhs_module' => 'Opportunities',
        'lhs_table' => 'opportunities',
        'lhs_key' => 'id',
        'rhs_module' => 'Contacts',
        'rhs_table' => 'contacts',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'opportunities_contacts',
        'join_key_lhs' => 'opportunity_id',
        'join_key_rhs' => 'contact_id',
      ),
    ),
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Contacts',
    'rhs_table' => 'contacts',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'opportunities_contacts',
    'join_key_lhs' => 'opportunity_id',
    'join_key_rhs' => 'contact_id',
    'readonly' => true,
    'relationship_name' => 'opportunities_contacts',
    'rhs_subpanel' => 'ForOpportunities',
    'lhs_subpanel' => 'ForContacts',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'projects_opportunities' => 
  array (
    'name' => 'projects_opportunities',
    'table' => 'projects_opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'project_id' => 
      array (
        'name' => 'project_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'projects_opportunities_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_proj_opp_proj',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'project_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_proj_opp_opp',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'opportunity_id',
        ),
      ),
      3 => 
      array (
        'name' => 'projects_opportunities_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'project_id',
          1 => 'opportunity_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'projects_opportunities' => 
      array (
        'lhs_module' => 'Project',
        'lhs_table' => 'project',
        'lhs_key' => 'id',
        'rhs_module' => 'Opportunities',
        'rhs_table' => 'opportunities',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'projects_opportunities',
        'join_key_lhs' => 'project_id',
        'join_key_rhs' => 'opportunity_id',
      ),
    ),
    'lhs_module' => 'Project',
    'lhs_table' => 'project',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'projects_opportunities',
    'join_key_lhs' => 'project_id',
    'join_key_rhs' => 'opportunity_id',
    'readonly' => true,
    'relationship_name' => 'projects_opportunities',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'quotes_opportunities' => 
  array (
    'name' => 'quotes_opportunities',
    'table' => 'quotes_opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'quote_id' => 
      array (
        'name' => 'quote_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'quotes_opportunitiespk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_opp_qte_opp',
        'type' => 'index',
        'fields' => 
        array (
          0 => 'opportunity_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_quote_oportunities',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'quote_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'quotes_opportunities' => 
      array (
        'lhs_module' => 'Opportunities',
        'lhs_table' => 'opportunities',
        'lhs_key' => 'id',
        'rhs_module' => 'Quotes',
        'rhs_table' => 'quotes',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'true_relationship_type' => 'one-to-many',
        'join_table' => 'quotes_opportunities',
        'join_key_lhs' => 'opportunity_id',
        'join_key_rhs' => 'quote_id',
      ),
    ),
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Quotes',
    'rhs_table' => 'quotes',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'true_relationship_type' => 'one-to-many',
    'join_table' => 'quotes_opportunities',
    'join_key_lhs' => 'opportunity_id',
    'join_key_rhs' => 'quote_id',
    'readonly' => true,
    'relationship_name' => 'quotes_opportunities',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'contracts_opportunities' => 
  array (
    'name' => 'contracts_opportunities',
    'table' => 'contracts_opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
      ),
      'contract_id' => 
      array (
        'name' => 'contract_id',
        'type' => 'id',
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => false,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'contracts_opp_pk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'contracts_opp_alt',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'contract_id',
        ),
      ),
    ),
    'relationships' => 
    array (
      'contracts_opportunities' => 
      array (
        'lhs_module' => 'Opportunities',
        'lhs_table' => 'opportunities',
        'lhs_key' => 'id',
        'rhs_module' => 'Contracts',
        'rhs_table' => 'contracts',
        'rhs_key' => 'id',
        'relationship_type' => 'one-to-many',
        'join_table' => 'contracts_opportunities',
        'join_key_lhs' => 'opportunity_id',
        'join_key_rhs' => 'contract_id',
        'true_relationship_type' => 'one-to-many',
      ),
    ),
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Contracts',
    'rhs_table' => 'contracts',
    'rhs_key' => 'id',
    'relationship_type' => 'one-to-many',
    'join_table' => 'contracts_opportunities',
    'join_key_lhs' => 'opportunity_id',
    'join_key_rhs' => 'contract_id',
    'true_relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'contracts_opportunities',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'documents_opportunities' => 
  array (
    'name' => 'documents_opportunities',
    'true_relationship_type' => 'many-to-many',
    'relationships' => 
    array (
      'documents_opportunities' => 
      array (
        'lhs_module' => 'Documents',
        'lhs_table' => 'documents',
        'lhs_key' => 'id',
        'rhs_module' => 'Opportunities',
        'rhs_table' => 'opportunities',
        'rhs_key' => 'id',
        'relationship_type' => 'many-to-many',
        'join_table' => 'documents_opportunities',
        'join_key_lhs' => 'document_id',
        'join_key_rhs' => 'opportunity_id',
      ),
    ),
    'table' => 'documents_opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => 36,
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'type' => 'bool',
        'len' => '1',
        'default' => '0',
        'required' => true,
      ),
      'document_id' => 
      array (
        'name' => 'document_id',
        'type' => 'id',
        'len' => 36,
      ),
      'opportunity_id' => 
      array (
        'name' => 'opportunity_id',
        'type' => 'id',
        'len' => 36,
      ),
    ),
    'indices' => 
    array (
      0 => 
      array (
        'name' => 'documents_opportunitiesspk',
        'type' => 'primary',
        'fields' => 
        array (
          0 => 'id',
        ),
      ),
      1 => 
      array (
        'name' => 'idx_docu_opps_oppo_id',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'opportunity_id',
          1 => 'document_id',
        ),
      ),
      2 => 
      array (
        'name' => 'idx_docu_oppo_docu_id',
        'type' => 'alternate_key',
        'fields' => 
        array (
          0 => 'document_id',
          1 => 'opportunity_id',
        ),
      ),
    ),
    'lhs_module' => 'Documents',
    'lhs_table' => 'documents',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'documents_opportunities',
    'join_key_lhs' => 'document_id',
    'join_key_rhs' => 'opportunity_id',
    'readonly' => true,
    'relationship_name' => 'documents_opportunities',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => 'default',
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_modified_user' => 
  array (
    'name' => 'opportunities_modified_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'modified_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunities_modified_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_created_by' => 
  array (
    'name' => 'opportunities_created_by',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'created_by',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunities_created_by',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_activities' => 
  array (
    'name' => 'opportunity_activities',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Activities',
    'rhs_table' => 'activities',
    'rhs_key' => 'id',
    'rhs_vname' => 'LBL_ACTIVITY_STREAM',
    'relationship_type' => 'many-to-many',
    'join_table' => 'activities_users',
    'join_key_lhs' => 'parent_id',
    'join_key_rhs' => 'activity_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'fields' => 
    array (
      'id' => 
      array (
        'name' => 'id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'activity_id' => 
      array (
        'name' => 'activity_id',
        'type' => 'id',
        'len' => 36,
        'required' => true,
      ),
      'parent_type' => 
      array (
        'name' => 'parent_type',
        'type' => 'varchar',
        'len' => 100,
      ),
      'parent_id' => 
      array (
        'name' => 'parent_id',
        'type' => 'id',
        'len' => 36,
      ),
      'fields' => 
      array (
        'name' => 'fields',
        'type' => 'json',
        'dbType' => 'longtext',
        'required' => true,
      ),
      'date_modified' => 
      array (
        'name' => 'date_modified',
        'type' => 'datetime',
      ),
      'deleted' => 
      array (
        'name' => 'deleted',
        'vname' => 'LBL_DELETED',
        'type' => 'bool',
        'default' => '0',
      ),
    ),
    'readonly' => true,
    'relationship_name' => 'opportunity_activities',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_calls' => 
  array (
    'name' => 'opportunity_calls',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Calls',
    'rhs_table' => 'calls',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'readonly' => true,
    'relationship_name' => 'opportunity_calls',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_meetings' => 
  array (
    'name' => 'opportunity_meetings',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Meetings',
    'rhs_table' => 'meetings',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'readonly' => true,
    'relationship_name' => 'opportunity_meetings',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_tasks' => 
  array (
    'name' => 'opportunity_tasks',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Tasks',
    'rhs_table' => 'tasks',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'readonly' => true,
    'relationship_name' => 'opportunity_tasks',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_notes' => 
  array (
    'name' => 'opportunity_notes',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Notes',
    'rhs_table' => 'notes',
    'rhs_key' => 'parent_id',
    'relationship_type' => 'one-to-many',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'readonly' => true,
    'relationship_name' => 'opportunity_notes',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunity_leads' => 
  array (
    'name' => 'opportunity_leads',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Leads',
    'rhs_table' => 'leads',
    'rhs_key' => 'opportunity_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunity_leads',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_assigned_user' => 
  array (
    'name' => 'opportunities_assigned_user',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'assigned_user_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunities_assigned_user',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_revenuelineitems' => 
  array (
    'name' => 'opportunities_revenuelineitems',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'RevenueLineItems',
    'rhs_table' => 'revenue_line_items',
    'rhs_key' => 'opportunity_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunities_revenuelineitems',
    'rhs_subpanel' => 'ForOpportunities',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_following' => 
  array (
    'name' => 'opportunities_following',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'subscriptions',
    'join_key_lhs' => 'created_by',
    'join_key_rhs' => 'parent_id',
    'relationship_role_column' => 'parent_type',
    'relationship_role_column_value' => 'Opportunities',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'opportunities_following',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_favorite' => 
  array (
    'name' => 'opportunities_favorite',
    'lhs_module' => 'Users',
    'lhs_table' => 'users',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'id',
    'relationship_type' => 'many-to-many',
    'join_table' => 'sugarfavorites',
    'join_key_lhs' => 'modified_user_id',
    'join_key_rhs' => 'record_id',
    'relationship_role_column' => 'module',
    'relationship_role_column_value' => 'Opportunities',
    'user_field' => 'created_by',
    'readonly' => true,
    'relationship_name' => 'opportunities_favorite',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_dsm_suivi_de_vente' => 
  array (
    'name' => 'opportunities_dsm_suivi_de_vente',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'dsm_suivi_de_vente',
    'rhs_table' => 'dsm_suivi_de_vente',
    'rhs_key' => 'opportunity_id',
    'relationship_type' => 'one-to-one',
    'readonly' => true,
    'relationship_name' => 'opportunities_dsm_suivi_de_vente',
    'rhs_subpanel' => NULL,
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'campaign_opportunities' => 
  array (
    'name' => 'campaign_opportunities',
    'lhs_module' => 'Campaigns',
    'lhs_table' => 'campaigns',
    'lhs_key' => 'id',
    'rhs_module' => 'Opportunities',
    'rhs_table' => 'opportunities',
    'rhs_key' => 'campaign_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'campaign_opportunities',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_products' => 
  array (
    'name' => 'opportunities_products',
    'lhs_module' => 'Opportunities',
    'lhs_table' => 'opportunities',
    'lhs_key' => 'id',
    'rhs_module' => 'Products',
    'rhs_table' => 'products',
    'rhs_key' => 'opportunity_id',
    'relationship_type' => 'one-to-many',
    'readonly' => true,
    'relationship_name' => 'opportunities_products',
    'rhs_subpanel' => 'default',
    'lhs_subpanel' => NULL,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => false,
  ),
  'opportunities_dsm_suivi_de_vente_1' => 
  array (
    'lhs_module' => 'Opportunities',
    'rhs_module' => 'dsm_suivi_de_vente',
    'relationship_type' => 'one-to-one',
    'readonly' => true,
    'deleted' => false,
    'relationship_only' => false,
    'for_activities' => false,
    'is_custom' => false,
    'from_studio' => true,
    'relationship_name' => 'opportunities_dsm_suivi_de_vente_1',
  ),
);