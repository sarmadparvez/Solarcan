<?php
// created: 2018-01-31 12:37:05
$dictionary["rt_postal_codes_users"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'rt_postal_codes_users' => 
    array (
      'lhs_module' => 'rt_postal_codes',
      'lhs_table' => 'rt_postal_codes',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'rt_postal_codes_users_c',
      'join_key_lhs' => 'rt_postal_codes_usersrt_postal_codes_ida',
      'join_key_rhs' => 'rt_postal_codes_usersusers_idb',
    ),
  ),
  'table' => 'rt_postal_codes_users_c',
  'fields' => 
  array (
    'id' => 
    array (
      'name' => 'id',
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
      'default' => 0,
    ),
    'rt_postal_codes_usersrt_postal_codes_ida' => 
    array (
      'name' => 'rt_postal_codes_usersrt_postal_codes_ida',
      'type' => 'id',
    ),
    'rt_postal_codes_usersusers_idb' => 
    array (
      'name' => 'rt_postal_codes_usersusers_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_rt_postal_codes_users_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_rt_postal_codes_users_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'rt_postal_codes_usersrt_postal_codes_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_rt_postal_codes_users_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'rt_postal_codes_usersusers_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'rt_postal_codes_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'rt_postal_codes_usersrt_postal_codes_ida',
        1 => 'rt_postal_codes_usersusers_idb',
      ),
    ),
  ),
);