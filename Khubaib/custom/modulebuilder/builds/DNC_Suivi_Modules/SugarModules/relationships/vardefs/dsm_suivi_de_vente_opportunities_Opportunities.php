<?php
// created: 2018-03-13 11:00:06
$dictionary["Opportunity"]["fields"]["dsm_suivi_de_vente_opportunities"] = array (
  'name' => 'dsm_suivi_de_vente_opportunities',
  'type' => 'link',
  'relationship' => 'dsm_suivi_de_vente_opportunities',
  'source' => 'non-db',
  'module' => 'dsm_suivi_de_vente',
  'bean_name' => 'dsm_suivi_de_vente',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_DSM_SUIVI_DE_VENTE_TITLE',
  'id_name' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
);
$dictionary["Opportunity"]["fields"]["dsm_suivi_de_vente_opportunities_name"] = array (
  'name' => 'dsm_suivi_de_vente_opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_DSM_SUIVI_DE_VENTE_TITLE',
  'save' => true,
  'id_name' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
  'link' => 'dsm_suivi_de_vente_opportunities',
  'table' => 'dsm_suivi_de_vente',
  'module' => 'dsm_suivi_de_vente',
  'rname' => 'name',
);
$dictionary["Opportunity"]["fields"]["dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida"] = array (
  'name' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_DSM_SUIVI_DE_VENTE_TITLE_ID',
  'id_name' => 'dsm_suivi_de_vente_opportunitiesdsm_suivi_de_vente_ida',
  'link' => 'dsm_suivi_de_vente_opportunities',
  'table' => 'dsm_suivi_de_vente',
  'module' => 'dsm_suivi_de_vente',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'left',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
