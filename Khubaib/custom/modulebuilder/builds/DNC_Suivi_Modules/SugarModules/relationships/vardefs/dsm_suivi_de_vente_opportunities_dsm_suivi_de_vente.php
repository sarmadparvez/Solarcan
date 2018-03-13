<?php
// created: 2018-03-13 11:00:06
$dictionary["dsm_suivi_de_vente"]["fields"]["dsm_suivi_de_vente_opportunities"] = array (
  'name' => 'dsm_suivi_de_vente_opportunities',
  'type' => 'link',
  'relationship' => 'dsm_suivi_de_vente_opportunities',
  'source' => 'non-db',
  'module' => 'Opportunities',
  'bean_name' => 'Opportunity',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'id_name' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
);
$dictionary["dsm_suivi_de_vente"]["fields"]["dsm_suivi_de_vente_opportunities_name"] = array (
  'name' => 'dsm_suivi_de_vente_opportunities_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE',
  'save' => true,
  'id_name' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
  'link' => 'dsm_suivi_de_vente_opportunities',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'name',
);
$dictionary["dsm_suivi_de_vente"]["fields"]["dsm_suivi_de_vente_opportunitiesopportunities_idb"] = array (
  'name' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_DSM_SUIVI_DE_VENTE_OPPORTUNITIES_FROM_OPPORTUNITIES_TITLE_ID',
  'id_name' => 'dsm_suivi_de_vente_opportunitiesopportunities_idb',
  'link' => 'dsm_suivi_de_vente_opportunities',
  'table' => 'opportunities',
  'module' => 'Opportunities',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'left',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);
