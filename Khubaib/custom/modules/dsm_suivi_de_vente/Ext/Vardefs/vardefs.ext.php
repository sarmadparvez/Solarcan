<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/dsm_suivi_de_vente_opportunities_dsm_suivi_de_vente.php

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

?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_note.php

 // created: 2018-02-08 14:59:52
$dictionary['dsm_suivi_de_vente']['fields']['note']['name']='note';
$dictionary['dsm_suivi_de_vente']['fields']['note']['vname']='LBL_NOTE';
$dictionary['dsm_suivi_de_vente']['fields']['note']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['note']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['note']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['note']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['note']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['note']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['note']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['note']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['note']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['note']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['note']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['note']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_info_manquante_suivi.php

 // created: 2018-02-08 14:58:58
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['name']='info_manquante_suivi';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['vname']='LBL_INFO_MANQUANTE_SUIVI';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['type']='enum';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['options']='info_manquante_suivi_dom';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['info_manquante_suivi']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_date_statut.php

 // created: 2018-02-08 14:59:42
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['name']='date_statut';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['vname']='LBL_DATE_STATUT';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['type']='datetime';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_statut']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_account_id.php


$dictionary['dsm_suivi_de_vente']['fields']['account_id'] = array(
    'name'              => 'account_id',
    'rname'             => 'id',
    'vname'             => 'LBL_ACCOUNT_ID',
    'type'              => 'id',
    'table'             => 'dsm_suivi_de_vente',
    'isnull'            => 'true',
    'module'            => 'dsm_suivi_de_vente',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_name.php

 // created: 2018-01-25 15:34:42
$dictionary['dsm_suivi_de_vente']['fields']['name']['len']='255';
$dictionary['dsm_suivi_de_vente']['fields']['name']['audited']=false;
$dictionary['dsm_suivi_de_vente']['fields']['name']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['name']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.55',
  'searchable' => true,
);
$dictionary['dsm_suivi_de_vente']['fields']['name']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_date_contrat_initial_recu.php

 // created: 2018-02-08 14:58:09
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['name']='date_contrat_initial_recu';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['vname']='LBL_DATE_CONTRAT_INITIAL_RECU';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['type']='datetime';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial_recu']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_account_name.php

 // created: 2018-02-08 14:57:04
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['source']='non-db';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['name']='account_name';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['vname']='LBL_ACCOUNT_NAME';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['type']='relate';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['rname']='name';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['id_name']='account_id';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['table']='accounts';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['isnull']='true';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['module']='Accounts';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['audited']=false;
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['duplicate_merge_dom_value']='1';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['merge_filter']='disabled';
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['account_name']['studio']='visible';

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_meeting_id.php


$dictionary['dsm_suivi_de_vente']['fields']['meeting_id'] = array(
    'name'              => 'meeting_id',
    'rname'             => 'id',
    'vname'             => 'LBL_MEETING_ID',
    'type'              => 'id',
    'table'             => 'dsm_suivi_de_vente',
    'isnull'            => 'true',
    'module'            => 'dsm_suivi_de_vente',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_coupon.php

 // created: 2018-02-08 14:59:11
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['name']='coupon';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['vname']='LBL_COUPON';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['type']='enum';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['options']='suivi_coupon_dom';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['coupon']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_contact_name.php

 // created: 2018-02-08 14:56:53
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['required']=false;
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['source']='non-db';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['name']='contact_name';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['vname']='LBL_CONTACT_NAME';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['type']='relate';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['rname']='name';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['id_name']='contact_id';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['table']='contacts';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['isnull']='true';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['module']='Contacts';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['audited']=false;
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['duplicate_merge_dom_value']='1';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['merge_filter']='disabled';
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['contact_name']['studio']='visible';

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_contact_id.php


$dictionary['dsm_suivi_de_vente']['fields']['contact_id'] = array(
    'name'              => 'contact_id',
    'rname'             => 'id',
    'vname'             => 'LBL_CONTACT_ID',
    'type'              => 'id',
    'table'             => 'dsm_suivi_de_vente',
    'isnull'            => 'true',
    'module'            => 'dsm_suivi_de_vente',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_date_contrat_initial.php

 // created: 2018-02-08 14:57:50
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['name']='date_contrat_initial';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['vname']='LBL_DATE_CONTRAT_INITIAL';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['type']='datetime';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_initial']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_montant.php

 // created: 2018-01-25 15:41:59
$dictionary['dsm_suivi_de_vente']['fields']['montant']['name']='montant';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['vname']='LBL_MONTANT';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['montant']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['montant']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['montant']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['montant']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['montant']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['montant']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_date_contrat_revise_recu.php

 // created: 2018-02-08 14:58:41
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['name']='date_contrat_revise_recu';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['vname']='LBL_DATE_CONTRAT_REVISE_RECU';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['type']='datetime';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['date_contrat_revise_recu']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_status.php

 // created: 2018-01-24 19:47:42
$dictionary['dsm_suivi_de_vente']['fields']['status']['name']='status';
$dictionary['dsm_suivi_de_vente']['fields']['status']['vname']='LBL_STATUS';
$dictionary['dsm_suivi_de_vente']['fields']['status']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['status']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['status']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['status']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['status']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['status']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['status']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['status']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['status']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['status']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['status']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['status']['unified_search']=false;

?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_numero_de_contrat.php

 // created: 2018-01-25 15:41:47
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['name']='numero_de_contrat';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['vname']='LBL_NUMERO_DE_CONTRAT';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_contrat']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_annulation_refus_banc_condit.php

 // created: 2018-02-08 14:57:34
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['name']='annulation_refus_banc_condit';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['vname']='LBL_ANNULATION_REFUS_BANC_CONDIT';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['type']='enum';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['options']='yes_no_dom';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['annulation_refus_banc_condit']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_numero_de_cheque.php

 // created: 2018-01-25 15:42:20
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['name']='numero_de_cheque';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['vname']='LBL_NUMERO_DE_CHEQUE';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['numero_de_cheque']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_meeting_name.php

 // created: 2018-02-08 14:57:13
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['required']=false;
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['source']='non-db';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['name']='meeting_name';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['vname']='LBL_MEETING_NAME';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['type']='relate';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['rname']='name';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['id_name']='meeting_id';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['table']='meetings';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['isnull']='true';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['module']='Meetings';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['audited']=false;
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['duplicate_merge_dom_value']='1';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['merge_filter']='disabled';
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['meeting_name']['studio']='visible';

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_depot.php

 // created: 2018-01-25 15:42:08
$dictionary['dsm_suivi_de_vente']['fields']['depot']['name']='depot';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['vname']='LBL_DEPOT';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['type']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['dbType']='varchar';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['depot']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['depot']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['depot']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['depot']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['depot']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_suivi_de_vente']['fields']['depot']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_statut_suivi.php

 // created: 2018-02-08 14:59:29
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['name']='statut_suivi';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['vname']='LBL_STATUT_SUIVI';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['type']='enum';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['options']='statut_suivi_dom';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['statut_suivi']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_suivi_de_vente/Ext/Vardefs/sugarfield_mode_paiement.php

 // created: 2018-02-08 14:58:27
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['name']='mode_paiement';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['vname']='LBL_MODE_PAIEMENT';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['type']='enum';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['options']='suivi_mode_paiement_dom';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['massupdate']=false;
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['duplicate_merge']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['merge_filter']='enabled';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['calculated']=false;
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['required']=true;
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['audited']=true;
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['importable']='true';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['duplicate_merge_dom_value']='2';
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['unified_search']=false;
$dictionary['dsm_suivi_de_vente']['fields']['mode_paiement']['dependency']=false;

 
?>
