<?php
// created: 2018-01-31 11:47:16
$dictionary["rt_classification_users"] = array (
  'true_relationship_type' => 'one-to-many',
  'relationships' => 
  array (
    'rt_classification_users' => 
    array (
      'lhs_module' => 'rt_Classification',
      'lhs_table' => 'rt_classification',
      'lhs_key' => 'id',
      'rhs_module' => 'Users',
      'rhs_table' => 'users',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'rt_classification_users_c',
      'join_key_lhs' => 'rt_classification_usersrt_classification_ida',
      'join_key_rhs' => 'rt_classification_usersusers_idb',
    ),
  ),
  'table' => 'rt_classification_users_c',
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
    'rt_classification_usersrt_classification_ida' => 
    array (
      'name' => 'rt_classification_usersrt_classification_ida',
      'type' => 'id',
    ),
    'rt_classification_usersusers_idb' => 
    array (
      'name' => 'rt_classification_usersusers_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_rt_classification_users_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_rt_classification_users_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'rt_classification_usersrt_classification_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_rt_classification_users_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'rt_classification_usersusers_idb',
        1 => 'deleted',
      ),
    ),
    3 => 
    array (
      'name' => 'rt_classification_users_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'rt_classification_usersusers_idb',
      ),
    ),
  ),
);