<?php
// created: 2018-03-13 11:00:06
$dictionary["dsm_suivi_de_vente_opportunities"] = array (
  'true_relationship_type' => 'one-to-one',
  'relationships' => 
  array (
    'dsm_suivi_de_vente_opportunities' => 
    array (
      'lhs_module' => 'dsm_suivi_de_vente',
      'lhs_table' => 'dsm_suivi_de_vente',
      'lhs_key' => 'id',
      'rhs_module' => 'Opportunities',
      'rhs_table' => 'opportunities',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'dsm_suivi_de_vente_opportunities_c',
      'join_key_lhs' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
      'join_key_rhs' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
    ),
  ),
  'table' => 'dsm_suivi_de_vente_opportunities_c',
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
    'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida' => 
    array (
      'name' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
      'type' => 'id',
    ),
    'dsm_suivi_de_vente_opportunitiesopportunities_idb' => 
    array (
      'name' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
      'type' => 'id',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'idx_dsm_suivi_de_vente_opportunities_pk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'idx_dsm_suivi_de_vente_opportunities_ida1_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
        1 => 'deleted',
      ),
    ),
    2 => 
    array (
      'name' => 'idx_dsm_suivi_de_vente_opportunities_idb2_deleted',
      'type' => 'index',
      'fields' => 
      array (
        0 => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
        1 => 'deleted',
      ),
    ),
  ),
);