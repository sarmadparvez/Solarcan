<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/dsm_suivi_de_vente_opportunities_Opportunities.php

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

?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_garage_achanger.php

 // created: 2018-01-25 12:04:17
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['name']='nombre_garage_achanger';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['vname']='LBL_NOMBRE_GARAGE_ACHANGER';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['required']=false;
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['formula']='related($accounts,"nombre_garage_achanger")';
$dictionary['Opportunity']['fields']['nombre_garage_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/rli_link_workflow.php

$dictionary['Opportunity']['fields']['revenuelineitems']['workflow'] = true;
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_sales_stage.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['sales_stage']['required']=false;
$dictionary['Opportunity']['fields']['sales_stage']['audited']=false;
$dictionary['Opportunity']['fields']['sales_stage']['massupdate']=false;
$dictionary['Opportunity']['fields']['sales_stage']['comments']='Indication of progression towards closure';
$dictionary['Opportunity']['fields']['sales_stage']['importable']=false;
$dictionary['Opportunity']['fields']['sales_stage']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['sales_stage']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['sales_stage']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['sales_stage']['reportable']=false;
$dictionary['Opportunity']['fields']['sales_stage']['calculated']=false;
$dictionary['Opportunity']['fields']['sales_stage']['dependency']=false;
$dictionary['Opportunity']['fields']['sales_stage']['studio']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/dupe_check.ext.php

$dictionary['Opportunity']['fields']['revenuelineitems']['workflow'] = true;
$dictionary['Opportunity']['duplicate_check']['FilterDuplicateCheck']['filter_template'][0]['$and'][1] = array('sales_status' => array('$not_equals' => 'Closed Lost'));
$dictionary['Opportunity']['duplicate_check']['FilterDuplicateCheck']['filter_template'][0]['$and'][2] = array('sales_status' => array('$not_equals' => 'Closed Won'));
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_garage_total.php

 // created: 2018-01-25 12:04:39
$dictionary['Opportunity']['fields']['nombre_garage_total']['name']='nombre_garage_total';
$dictionary['Opportunity']['fields']['nombre_garage_total']['vname']='LBL_NOMBRE_GARAGE_TOTAL';
$dictionary['Opportunity']['fields']['nombre_garage_total']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_garage_total']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_garage_total']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_garage_total']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_garage_total']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_garage_total']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_garage_total']['required']=true;
$dictionary['Opportunity']['fields']['nombre_garage_total']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_garage_total']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_garage_total']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_garage_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_garage_total']['formula']='related($accounts,"nombre_garage_total")';
$dictionary['Opportunity']['fields']['nombre_garage_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_date_closed_timestamp.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['date_closed_timestamp']['audited']=false;
$dictionary['Opportunity']['fields']['date_closed_timestamp']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['date_closed_timestamp']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['date_closed_timestamp']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['date_closed_timestamp']['formula']='rollupMax($revenuelineitems, "date_closed_timestamp")';

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_total_revenue_line_items.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['total_revenue_line_items']['audited']=false;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['massupdate']=false;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['total_revenue_line_items']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['total_revenue_line_items']['reportable']=true;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['enable_range_search']=false;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['min']=false;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['max']=false;
$dictionary['Opportunity']['fields']['total_revenue_line_items']['disable_num_format']='';

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_sales_status.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['sales_status']['audited']=true;
$dictionary['Opportunity']['fields']['sales_status']['massupdate']=true;
$dictionary['Opportunity']['fields']['sales_status']['importable']=true;
$dictionary['Opportunity']['fields']['sales_status']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['sales_status']['reportable']=true;
$dictionary['Opportunity']['fields']['sales_status']['calculated']=false;
$dictionary['Opportunity']['fields']['sales_status']['dependency']=false;
$dictionary['Opportunity']['fields']['sales_status']['studio']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_portes_total.php

 // created: 2018-01-25 12:05:38
$dictionary['Opportunity']['fields']['nombre_portes_total']['name']='nombre_portes_total';
$dictionary['Opportunity']['fields']['nombre_portes_total']['vname']='LBL_NOMBRE_PORTES_TOTAL';
$dictionary['Opportunity']['fields']['nombre_portes_total']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_total']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_total']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_portes_total']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_total']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_total']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_portes_total']['required']=true;
$dictionary['Opportunity']['fields']['nombre_portes_total']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_portes_total']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_portes_total']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_portes_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_portes_total']['formula']='related($accounts,"nombre_portes_total")';
$dictionary['Opportunity']['fields']['nombre_portes_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_annee_construction.php

 // created: 2018-01-25 12:02:04
$dictionary['Opportunity']['fields']['annee_construction']['name']='annee_construction';
$dictionary['Opportunity']['fields']['annee_construction']['vname']='LBL_ANNEE_CONSTRUCTION';
$dictionary['Opportunity']['fields']['annee_construction']['type']='varchar';
$dictionary['Opportunity']['fields']['annee_construction']['dbType']='varchar';
$dictionary['Opportunity']['fields']['annee_construction']['massupdate']=false;
$dictionary['Opportunity']['fields']['annee_construction']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['annee_construction']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['annee_construction']['calculated']='true';
$dictionary['Opportunity']['fields']['annee_construction']['required']=true;
$dictionary['Opportunity']['fields']['annee_construction']['audited']=true;
$dictionary['Opportunity']['fields']['annee_construction']['importable']='false';
$dictionary['Opportunity']['fields']['annee_construction']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['annee_construction']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['annee_construction']['rows']='4';
$dictionary['Opportunity']['fields']['annee_construction']['cols']='20';
$dictionary['Opportunity']['fields']['annee_construction']['formula']='related($accounts,"annee_construction")';
$dictionary['Opportunity']['fields']['annee_construction']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_amount.php

 // created: 2018-01-17 19:42:00
$dictionary['Opportunity']['fields']['amount']['required']=false;
$dictionary['Opportunity']['fields']['amount']['audited']=false;
$dictionary['Opportunity']['fields']['amount']['massupdate']=false;
$dictionary['Opportunity']['fields']['amount']['comments']='Unconverted amount of the opportunity';
$dictionary['Opportunity']['fields']['amount']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['amount']['duplicate_merge_dom_value']='1';
$dictionary['Opportunity']['fields']['amount']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['amount']['calculated']=true;
$dictionary['Opportunity']['fields']['amount']['formula']='rollupConditionalSum($revenuelineitems, "likely_case", "sales_stage", forecastSalesStages(true, false))';
$dictionary['Opportunity']['fields']['amount']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_best_case.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['best_case']['audited']=false;
$dictionary['Opportunity']['fields']['best_case']['massupdate']=false;
$dictionary['Opportunity']['fields']['best_case']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['best_case']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['best_case']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['best_case']['calculated']=true;
$dictionary['Opportunity']['fields']['best_case']['formula']='rollupConditionalSum($revenuelineitems, "best_case", "sales_stage", forecastSalesStages(true, false))';
$dictionary['Opportunity']['fields']['best_case']['enforced']=true;
$dictionary['Opportunity']['fields']['best_case']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_commit_stage.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['commit_stage']['audited']=false;
$dictionary['Opportunity']['fields']['commit_stage']['massupdate']=false;
$dictionary['Opportunity']['fields']['commit_stage']['options']='';
$dictionary['Opportunity']['fields']['commit_stage']['comments']='Forecast commit ranges: Include, Likely, Omit etc.';
$dictionary['Opportunity']['fields']['commit_stage']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['commit_stage']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['commit_stage']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['commit_stage']['reportable']=false;
$dictionary['Opportunity']['fields']['commit_stage']['enforced']=false;
$dictionary['Opportunity']['fields']['commit_stage']['dependency']=false;
$dictionary['Opportunity']['fields']['commit_stage']['related_fields']=array (
);
$dictionary['Opportunity']['fields']['commit_stage']['studio']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_montant.php

 // created: 2018-01-23 16:18:00
$dictionary['Opportunity']['fields']['montant']['name']='montant';
$dictionary['Opportunity']['fields']['montant']['vname']='LBL_MONTANT';
$dictionary['Opportunity']['fields']['montant']['type']='varchar';
$dictionary['Opportunity']['fields']['montant']['dbType']='varchar';
$dictionary['Opportunity']['fields']['montant']['massupdate']=false;
$dictionary['Opportunity']['fields']['montant']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['montant']['merge_filter']='enabled';
$dictionary['Opportunity']['fields']['montant']['calculated']=false;
$dictionary['Opportunity']['fields']['montant']['required']=false;
$dictionary['Opportunity']['fields']['montant']['audited']=true;
$dictionary['Opportunity']['fields']['montant']['importable']='true';
$dictionary['Opportunity']['fields']['montant']['duplicate_merge_dom_value']='2';
$dictionary['Opportunity']['fields']['montant']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_status.php

 // created: 2018-01-23 16:01:24
$dictionary['Opportunity']['fields']['status']['name']='status';
$dictionary['Opportunity']['fields']['status']['vname']='LBL_STATUS';
$dictionary['Opportunity']['fields']['status']['type']='enum';
$dictionary['Opportunity']['fields']['status']['options']='statut_apres_rencontre_dom';
$dictionary['Opportunity']['fields']['status']['massupdate']=false;
$dictionary['Opportunity']['fields']['status']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['status']['merge_filter']='enabled';
$dictionary['Opportunity']['fields']['status']['calculated']=false;
$dictionary['Opportunity']['fields']['status']['required']=true;
$dictionary['Opportunity']['fields']['status']['audited']=true;
$dictionary['Opportunity']['fields']['status']['importable']='true';
$dictionary['Opportunity']['fields']['status']['duplicate_merge_dom_value']='2';
$dictionary['Opportunity']['fields']['status']['default']='non_rencontre';
$dictionary['Opportunity']['fields']['status']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_closed_revenue_line_items.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['audited']=false;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['massupdate']=false;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['reportable']=true;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['enable_range_search']=false;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['min']=false;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['max']=false;
$dictionary['Opportunity']['fields']['closed_revenue_line_items']['disable_num_format']='';

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_opportunity_type.php

 // created: 2018-01-24 12:51:18
$dictionary['Opportunity']['fields']['opportunity_type']['len']=100;
$dictionary['Opportunity']['fields']['opportunity_type']['required']=true;
$dictionary['Opportunity']['fields']['opportunity_type']['massupdate']=true;
$dictionary['Opportunity']['fields']['opportunity_type']['comments']='Type of opportunity (ex: Existing, New)';
$dictionary['Opportunity']['fields']['opportunity_type']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['opportunity_type']['duplicate_merge_dom_value']='1';
$dictionary['Opportunity']['fields']['opportunity_type']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['opportunity_type']['calculated']=false;
$dictionary['Opportunity']['fields']['opportunity_type']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_fenetres_total.php

 // created: 2018-01-25 12:03:18
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['name']='nombre_fenetres_total';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['vname']='LBL_NOMBRE_FENETRES_TOTAL';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['required']=true;
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['formula']='related($accounts,"nombre_fenetres_total")';
$dictionary['Opportunity']['fields']['nombre_fenetres_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_fenetres_achanger.php

 // created: 2018-01-25 12:02:38
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['name']='nombre_fenetres_achanger';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['vname']='LBL_NOMBRE_FENETRES_ACHANGER';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['required']=false;
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['formula']='related($accounts,"nombre_fenetres_achanger")';
$dictionary['Opportunity']['fields']['nombre_fenetres_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_mkto_id.php

 // created: 2018-01-23 15:54:35
$dictionary['Opportunity']['fields']['mkto_id']['audited']=false;
$dictionary['Opportunity']['fields']['mkto_id']['massupdate']=false;
$dictionary['Opportunity']['fields']['mkto_id']['comments']='Associated Marketo Lead ID';
$dictionary['Opportunity']['fields']['mkto_id']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['mkto_id']['duplicate_merge_dom_value']='1';
$dictionary['Opportunity']['fields']['mkto_id']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['mkto_id']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['mkto_id']['calculated']=false;
$dictionary['Opportunity']['fields']['mkto_id']['enable_range_search']=false;
$dictionary['Opportunity']['fields']['mkto_id']['min']=false;
$dictionary['Opportunity']['fields']['mkto_id']['max']=false;
$dictionary['Opportunity']['fields']['mkto_id']['disable_num_format']='';

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_closed_lost_reason.php

 // created: 2018-01-24 13:02:16
$dictionary['Opportunity']['fields']['closed_lost_reason']['name']='closed_lost_reason';
$dictionary['Opportunity']['fields']['closed_lost_reason']['vname']='LBL_CLOSED_LOST_REASON';
$dictionary['Opportunity']['fields']['closed_lost_reason']['type']='enum';
$dictionary['Opportunity']['fields']['closed_lost_reason']['options']='closed_lost_reason_dom';
$dictionary['Opportunity']['fields']['closed_lost_reason']['massupdate']=false;
$dictionary['Opportunity']['fields']['closed_lost_reason']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['closed_lost_reason']['merge_filter']='enabled';
$dictionary['Opportunity']['fields']['closed_lost_reason']['calculated']=false;
$dictionary['Opportunity']['fields']['closed_lost_reason']['required']=true;
$dictionary['Opportunity']['fields']['closed_lost_reason']['audited']=true;
$dictionary['Opportunity']['fields']['closed_lost_reason']['importable']='true';
$dictionary['Opportunity']['fields']['closed_lost_reason']['duplicate_merge_dom_value']='2';
$dictionary['Opportunity']['fields']['closed_lost_reason']['default']='autres';
$dictionary['Opportunity']['fields']['closed_lost_reason']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_numero_contrat.php

 // created: 2018-01-23 16:18:00
$dictionary['Opportunity']['fields']['numero_contrat']['name']='numero_contrat';
$dictionary['Opportunity']['fields']['numero_contrat']['vname']='LBL_NUMERO_CONTRAT';
$dictionary['Opportunity']['fields']['numero_contrat']['type']='varchar';
$dictionary['Opportunity']['fields']['numero_contrat']['dbType']='varchar';
$dictionary['Opportunity']['fields']['numero_contrat']['massupdate']=false;
$dictionary['Opportunity']['fields']['numero_contrat']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['numero_contrat']['merge_filter']='enabled';
$dictionary['Opportunity']['fields']['numero_contrat']['calculated']=false;
$dictionary['Opportunity']['fields']['numero_contrat']['required']=false;
$dictionary['Opportunity']['fields']['numero_contrat']['audited']=true;
$dictionary['Opportunity']['fields']['numero_contrat']['importable']='true';
$dictionary['Opportunity']['fields']['numero_contrat']['duplicate_merge_dom_value']='2';
$dictionary['Opportunity']['fields']['numero_contrat']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_mkto_sync.php

 // created: 2018-01-23 15:54:41
$dictionary['Opportunity']['fields']['mkto_sync']['default']=false;
$dictionary['Opportunity']['fields']['mkto_sync']['audited']=false;
$dictionary['Opportunity']['fields']['mkto_sync']['massupdate']=false;
$dictionary['Opportunity']['fields']['mkto_sync']['comments']='Should the Lead be synced to Marketo';
$dictionary['Opportunity']['fields']['mkto_sync']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['mkto_sync']['duplicate_merge_dom_value']='1';
$dictionary['Opportunity']['fields']['mkto_sync']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['mkto_sync']['unified_search']=false;
$dictionary['Opportunity']['fields']['mkto_sync']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_statut_apres_vente.php

 // created: 2018-01-23 17:03:56
$dictionary['Opportunity']['fields']['statut_apres_vente']['name']='statut_apres_vente';
$dictionary['Opportunity']['fields']['statut_apres_vente']['vname']='LBL_STATUT_APRES_VENTE';
$dictionary['Opportunity']['fields']['statut_apres_vente']['type']='enum';
$dictionary['Opportunity']['fields']['statut_apres_vente']['options']='statut_apres_vente_dom';
$dictionary['Opportunity']['fields']['statut_apres_vente']['massupdate']=false;
$dictionary['Opportunity']['fields']['statut_apres_vente']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['statut_apres_vente']['merge_filter']='enabled';
$dictionary['Opportunity']['fields']['statut_apres_vente']['calculated']=false;
$dictionary['Opportunity']['fields']['statut_apres_vente']['required']=false;
$dictionary['Opportunity']['fields']['statut_apres_vente']['audited']=true;
$dictionary['Opportunity']['fields']['statut_apres_vente']['importable']='true';
$dictionary['Opportunity']['fields']['statut_apres_vente']['duplicate_merge_dom_value']='2';
$dictionary['Opportunity']['fields']['statut_apres_vente']['default']='';
$dictionary['Opportunity']['fields']['statut_apres_vente']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_nombre_portes_achanger.php

 // created: 2018-01-25 12:05:05
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['name']='nombre_portes_achanger';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['vname']='LBL_NOMBRE_PORTES_ACHANGER';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['required']=false;
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['formula']='related($accounts,"nombre_portes_achanger")';
$dictionary['Opportunity']['fields']['nombre_portes_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_lead_source.php

 // created: 2018-01-25 14:14:37
$dictionary['Opportunity']['fields']['lead_source']['type']='varchar';
$dictionary['Opportunity']['fields']['lead_source']['len']='100';
$dictionary['Opportunity']['fields']['lead_source']['required']=false;
$dictionary['Opportunity']['fields']['lead_source']['audited']=false;
$dictionary['Opportunity']['fields']['lead_source']['massupdate']=false;
$dictionary['Opportunity']['fields']['lead_source']['comments']='Source of the opportunity';
$dictionary['Opportunity']['fields']['lead_source']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['lead_source']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['lead_source']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['lead_source']['calculated']='true';
$dictionary['Opportunity']['fields']['lead_source']['options']='';
$dictionary['Opportunity']['fields']['lead_source']['importable']='false';
$dictionary['Opportunity']['fields']['lead_source']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['lead_source']['formula']='related($contacts,"source")';
$dictionary['Opportunity']['fields']['lead_source']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_worst_case.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['worst_case']['audited']=false;
$dictionary['Opportunity']['fields']['worst_case']['massupdate']=false;
$dictionary['Opportunity']['fields']['worst_case']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['worst_case']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['worst_case']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['worst_case']['calculated']=true;
$dictionary['Opportunity']['fields']['worst_case']['formula']='rollupConditionalSum($revenuelineitems, "worst_case", "sales_stage", forecastSalesStages(true, false))';
$dictionary['Opportunity']['fields']['worst_case']['enforced']=true;
$dictionary['Opportunity']['fields']['worst_case']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_date_closed.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['date_closed']['required']=false;
$dictionary['Opportunity']['fields']['date_closed']['audited']=false;
$dictionary['Opportunity']['fields']['date_closed']['massupdate']=false;
$dictionary['Opportunity']['fields']['date_closed']['comments']='Expected or actual date the oppportunity will close';
$dictionary['Opportunity']['fields']['date_closed']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['date_closed']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['date_closed']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['date_closed']['calculated']=true;
$dictionary['Opportunity']['fields']['date_closed']['formula']='maxRelatedDate($revenuelineitems, "date_closed")';
$dictionary['Opportunity']['fields']['date_closed']['enforced']=true;
$dictionary['Opportunity']['fields']['date_closed']['related_fields']=array (
);

 
?>
<?php
// Merged from custom/Extension/modules/Opportunities/Ext/Vardefs/sugarfield_probability.php

 // created: 2018-01-17 19:42:01
$dictionary['Opportunity']['fields']['probability']['audited']=false;
$dictionary['Opportunity']['fields']['probability']['massupdate']=false;
$dictionary['Opportunity']['fields']['probability']['comments']='The probability of closure';
$dictionary['Opportunity']['fields']['probability']['duplicate_merge']='enabled';
$dictionary['Opportunity']['fields']['probability']['duplicate_merge_dom_value']=1;
$dictionary['Opportunity']['fields']['probability']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['probability']['reportable']=false;
$dictionary['Opportunity']['fields']['probability']['enable_range_search']=false;
$dictionary['Opportunity']['fields']['probability']['min']=false;
$dictionary['Opportunity']['fields']['probability']['max']=false;
$dictionary['Opportunity']['fields']['probability']['disable_num_format']='';
$dictionary['Opportunity']['fields']['probability']['studio']=false;

 
?>
