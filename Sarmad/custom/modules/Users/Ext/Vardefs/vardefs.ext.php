<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/rt_classification_users_Users.php

// created: 2018-01-31 11:47:16
$dictionary["User"]["fields"]["rt_classification_users"] = array (
  'name' => 'rt_classification_users',
  'type' => 'link',
  'relationship' => 'rt_classification_users',
  'source' => 'non-db',
  'module' => 'rt_Classification',
  'bean_name' => 'rt_Classification',
  'side' => 'right',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_USERS_TITLE',
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link-type' => 'one',
);
$dictionary["User"]["fields"]["rt_classification_users_name"] = array (
  'name' => 'rt_classification_users_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_RT_CLASSIFICATION_TITLE',
  'save' => true,
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link' => 'rt_classification_users',
  'table' => 'rt_classification',
  'module' => 'rt_Classification',
  'rname' => 'name',
);
$dictionary["User"]["fields"]["rt_classification_usersrt_classification_ida"] = array (
  'name' => 'rt_classification_usersrt_classification_ida',
  'type' => 'id',
  'source' => 'non-db',
  'vname' => 'LBL_RT_CLASSIFICATION_USERS_FROM_USERS_TITLE_ID',
  'id_name' => 'rt_classification_usersrt_classification_ida',
  'link' => 'rt_classification_users',
  'table' => 'rt_classification',
  'module' => 'rt_Classification',
  'rname' => 'id',
  'reportable' => false,
  'side' => 'right',
  'massupdate' => false,
  'duplicate_merge' => 'disabled',
  'hideacl' => true,
);

?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_telres_rep.php

 // created: 2018-02-08 16:11:38
$dictionary['User']['fields']['telres_rep']['name']='telres_rep';
$dictionary['User']['fields']['telres_rep']['vname']='LBL_TELRES_REP';
$dictionary['User']['fields']['telres_rep']['type']='varchar';
$dictionary['User']['fields']['telres_rep']['massupdate']=false;
$dictionary['User']['fields']['telres_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['telres_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['telres_rep']['calculated']=false;
$dictionary['User']['fields']['telres_rep']['required']=false;
$dictionary['User']['fields']['telres_rep']['audited']=true;
$dictionary['User']['fields']['telres_rep']['importable']='true';
$dictionary['User']['fields']['telres_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['telres_rep']['unified_search']=false;
$dictionary['User']['fields']['telres_rep']['default']='';
$dictionary['User']['fields']['telres_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_cellulaire_rep.php

 // created: 2018-02-08 16:11:51
$dictionary['User']['fields']['cellulaire_rep']['name']='cellulaire_rep';
$dictionary['User']['fields']['cellulaire_rep']['vname']='LBL_CELLULAIRE_REP';
$dictionary['User']['fields']['cellulaire_rep']['type']='varchar';
$dictionary['User']['fields']['cellulaire_rep']['massupdate']=false;
$dictionary['User']['fields']['cellulaire_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['cellulaire_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['cellulaire_rep']['calculated']=false;
$dictionary['User']['fields']['cellulaire_rep']['required']=false;
$dictionary['User']['fields']['cellulaire_rep']['audited']=true;
$dictionary['User']['fields']['cellulaire_rep']['importable']='true';
$dictionary['User']['fields']['cellulaire_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['cellulaire_rep']['unified_search']=false;
$dictionary['User']['fields']['cellulaire_rep']['default']='';
$dictionary['User']['fields']['cellulaire_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_can_sell.php

 // created: 2018-01-30 17:58:15
$dictionary['User']['fields']['can_sell']['name']='can_sell';
$dictionary['User']['fields']['can_sell']['vname']='LBL_CAN_SELL';
$dictionary['User']['fields']['can_sell']['type']='multienum';
$dictionary['User']['fields']['can_sell']['isMultiSelect']=true;
$dictionary['User']['fields']['can_sell']['options']='user_can_sell_dom';
$dictionary['User']['fields']['can_sell']['massupdate']=false;
$dictionary['User']['fields']['can_sell']['duplicate_merge']='enabled';
$dictionary['User']['fields']['can_sell']['merge_filter']='enabled';
$dictionary['User']['fields']['can_sell']['calculated']=false;
$dictionary['User']['fields']['can_sell']['required']=false;
$dictionary['User']['fields']['can_sell']['audited']=true;
$dictionary['User']['fields']['can_sell']['importable']='true';
$dictionary['User']['fields']['can_sell']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['can_sell']['unified_search']=false;
$dictionary['User']['fields']['can_sell']['dependency']='';
$dictionary['User']['fields']['can_sell']['default']='^^';

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_ville_rep.php

 // created: 2018-02-08 16:11:25
$dictionary['User']['fields']['ville_rep']['name']='ville_rep';
$dictionary['User']['fields']['ville_rep']['vname']='LBL_VILLE_REP';
$dictionary['User']['fields']['ville_rep']['type']='varchar';
$dictionary['User']['fields']['ville_rep']['massupdate']=false;
$dictionary['User']['fields']['ville_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['ville_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['ville_rep']['calculated']=false;
$dictionary['User']['fields']['ville_rep']['required']=false;
$dictionary['User']['fields']['ville_rep']['audited']=true;
$dictionary['User']['fields']['ville_rep']['importable']='true';
$dictionary['User']['fields']['ville_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['ville_rep']['unified_search']=false;
$dictionary['User']['fields']['ville_rep']['default']='';
$dictionary['User']['fields']['ville_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_nosolarcan_rep.php

 // created: 2018-02-02 14:49:58
$dictionary['User']['fields']['nosolarcan_rep']['name']='nosolarcan_rep';
$dictionary['User']['fields']['nosolarcan_rep']['vname']='LBL_NOSOLARCAN_REP';
$dictionary['User']['fields']['nosolarcan_rep']['type']='varchar';
$dictionary['User']['fields']['nosolarcan_rep']['massupdate']=false;
$dictionary['User']['fields']['nosolarcan_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['nosolarcan_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['nosolarcan_rep']['calculated']=false;
$dictionary['User']['fields']['nosolarcan_rep']['required']=false;
$dictionary['User']['fields']['nosolarcan_rep']['audited']=true;
$dictionary['User']['fields']['nosolarcan_rep']['importable']='true';
$dictionary['User']['fields']['nosolarcan_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['nosolarcan_rep']['unified_search']=false;
$dictionary['User']['fields']['nosolarcan_rep']['default']='';
$dictionary['User']['fields']['nosolarcan_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_codelangue_rep.php

 // created: 2018-02-02 14:50:16
$dictionary['User']['fields']['codelangue_rep']['name']='codelangue_rep';
$dictionary['User']['fields']['codelangue_rep']['vname']='LBL_CODELANGUE_REP';
$dictionary['User']['fields']['codelangue_rep']['type']='enum';
$dictionary['User']['fields']['codelangue_rep']['options']='user_codelangue_dom';
$dictionary['User']['fields']['codelangue_rep']['massupdate']=false;
$dictionary['User']['fields']['codelangue_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['codelangue_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['codelangue_rep']['calculated']=false;
$dictionary['User']['fields']['codelangue_rep']['required']=false;
$dictionary['User']['fields']['codelangue_rep']['audited']=true;
$dictionary['User']['fields']['codelangue_rep']['importable']='true';
$dictionary['User']['fields']['codelangue_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['codelangue_rep']['unified_search']=false;
$dictionary['User']['fields']['codelangue_rep']['dependency']=false;
$dictionary['User']['fields']['codelangue_rep']['default']='';

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_prenom_rep.php

 // created: 2018-02-08 16:10:58
$dictionary['User']['fields']['prenom_rep']['name']='prenom_rep';
$dictionary['User']['fields']['prenom_rep']['vname']='LBL_PRENOM_REP';
$dictionary['User']['fields']['prenom_rep']['type']='varchar';
$dictionary['User']['fields']['prenom_rep']['massupdate']=false;
$dictionary['User']['fields']['prenom_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['prenom_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['prenom_rep']['calculated']=false;
$dictionary['User']['fields']['prenom_rep']['required']=false;
$dictionary['User']['fields']['prenom_rep']['audited']=true;
$dictionary['User']['fields']['prenom_rep']['importable']='true';
$dictionary['User']['fields']['prenom_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['prenom_rep']['unified_search']=false;
$dictionary['User']['fields']['prenom_rep']['default']='';
$dictionary['User']['fields']['prenom_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_pager_rep.php

 // created: 2018-02-08 16:12:19
$dictionary['User']['fields']['pager_rep']['name']='pager_rep';
$dictionary['User']['fields']['pager_rep']['vname']='LBL_PAGER_REP';
$dictionary['User']['fields']['pager_rep']['type']='varchar';
$dictionary['User']['fields']['pager_rep']['massupdate']=false;
$dictionary['User']['fields']['pager_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['pager_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['pager_rep']['calculated']=false;
$dictionary['User']['fields']['pager_rep']['required']=false;
$dictionary['User']['fields']['pager_rep']['audited']=true;
$dictionary['User']['fields']['pager_rep']['importable']='true';
$dictionary['User']['fields']['pager_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['pager_rep']['unified_search']=false;
$dictionary['User']['fields']['pager_rep']['default']='';
$dictionary['User']['fields']['pager_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_fax_rep.php

 // created: 2018-02-08 16:12:06
$dictionary['User']['fields']['fax_rep']['name']='fax_rep';
$dictionary['User']['fields']['fax_rep']['vname']='LBL_FAX_REP';
$dictionary['User']['fields']['fax_rep']['type']='varchar';
$dictionary['User']['fields']['fax_rep']['massupdate']=false;
$dictionary['User']['fields']['fax_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['fax_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['fax_rep']['calculated']=false;
$dictionary['User']['fields']['fax_rep']['required']=false;
$dictionary['User']['fields']['fax_rep']['audited']=true;
$dictionary['User']['fields']['fax_rep']['importable']='true';
$dictionary['User']['fields']['fax_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['fax_rep']['unified_search']=false;
$dictionary['User']['fields']['fax_rep']['default']='';
$dictionary['User']['fields']['fax_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_courriel_rep.php

 // created: 2018-02-08 16:12:44
$dictionary['User']['fields']['courriel_rep']['name']='courriel_rep';
$dictionary['User']['fields']['courriel_rep']['vname']='LBL_COURRIEL_REP';
$dictionary['User']['fields']['courriel_rep']['type']='varchar';
$dictionary['User']['fields']['courriel_rep']['massupdate']=false;
$dictionary['User']['fields']['courriel_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['courriel_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['courriel_rep']['calculated']=false;
$dictionary['User']['fields']['courriel_rep']['required']=false;
$dictionary['User']['fields']['courriel_rep']['audited']=true;
$dictionary['User']['fields']['courriel_rep']['importable']='true';
$dictionary['User']['fields']['courriel_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['courriel_rep']['unified_search']=false;
$dictionary['User']['fields']['courriel_rep']['default']='';
$dictionary['User']['fields']['courriel_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_nom_rep.php

 // created: 2018-02-08 16:10:50
$dictionary['User']['fields']['nom_rep']['name']='nom_rep';
$dictionary['User']['fields']['nom_rep']['vname']='LBL_NOM_REP';
$dictionary['User']['fields']['nom_rep']['type']='varchar';
$dictionary['User']['fields']['nom_rep']['massupdate']=false;
$dictionary['User']['fields']['nom_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['nom_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['nom_rep']['calculated']=false;
$dictionary['User']['fields']['nom_rep']['required']=false;
$dictionary['User']['fields']['nom_rep']['audited']=true;
$dictionary['User']['fields']['nom_rep']['importable']='true';
$dictionary['User']['fields']['nom_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['nom_rep']['unified_search']=false;
$dictionary['User']['fields']['nom_rep']['default']='';
$dictionary['User']['fields']['nom_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_novendeur_rep.php

 // created: 2018-02-02 14:49:40
$dictionary['User']['fields']['novendeur_rep']['name']='novendeur_rep';
$dictionary['User']['fields']['novendeur_rep']['vname']='LBL_NOVENDEUR_REP';
$dictionary['User']['fields']['novendeur_rep']['type']='varchar';
$dictionary['User']['fields']['novendeur_rep']['massupdate']=false;
$dictionary['User']['fields']['novendeur_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['novendeur_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['novendeur_rep']['calculated']=false;
$dictionary['User']['fields']['novendeur_rep']['required']=false;
$dictionary['User']['fields']['novendeur_rep']['audited']=true;
$dictionary['User']['fields']['novendeur_rep']['importable']='true';
$dictionary['User']['fields']['novendeur_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['novendeur_rep']['unified_search']=false;
$dictionary['User']['fields']['novendeur_rep']['default']='';
$dictionary['User']['fields']['novendeur_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_preferred_language.php

 // created: 2018-01-30 17:39:59
$dictionary['User']['fields']['preferred_language']['default']='en_us';
$dictionary['User']['fields']['preferred_language']['required']=false;
$dictionary['User']['fields']['preferred_language']['audited']=false;
$dictionary['User']['fields']['preferred_language']['massupdate']=true;
$dictionary['User']['fields']['preferred_language']['duplicate_merge']='enabled';
$dictionary['User']['fields']['preferred_language']['duplicate_merge_dom_value']='1';
$dictionary['User']['fields']['preferred_language']['merge_filter']='disabled';
$dictionary['User']['fields']['preferred_language']['unified_search']=false;
$dictionary['User']['fields']['preferred_language']['calculated']=false;
$dictionary['User']['fields']['preferred_language']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_secteur_rep.php

 // created: 2018-02-08 16:13:44
$dictionary['User']['fields']['secteur_rep']['name']='secteur_rep';
$dictionary['User']['fields']['secteur_rep']['vname']='LBL_SECTEUR_REP';
$dictionary['User']['fields']['secteur_rep']['type']='enum';
$dictionary['User']['fields']['secteur_rep']['options']='user_secteur_rep_dom';
$dictionary['User']['fields']['secteur_rep']['massupdate']=false;
$dictionary['User']['fields']['secteur_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['secteur_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['secteur_rep']['calculated']=false;
$dictionary['User']['fields']['secteur_rep']['required']=false;
$dictionary['User']['fields']['secteur_rep']['audited']=true;
$dictionary['User']['fields']['secteur_rep']['importable']='true';
$dictionary['User']['fields']['secteur_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['secteur_rep']['unified_search']=false;
$dictionary['User']['fields']['secteur_rep']['default']='';
$dictionary['User']['fields']['secteur_rep']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/sugarfield_adresse_rep.php

 // created: 2018-02-08 16:11:13
$dictionary['User']['fields']['adresse_rep']['name']='adresse_rep';
$dictionary['User']['fields']['adresse_rep']['vname']='LBL_ADRESSE_REP';
$dictionary['User']['fields']['adresse_rep']['type']='varchar';
$dictionary['User']['fields']['adresse_rep']['massupdate']=false;
$dictionary['User']['fields']['adresse_rep']['duplicate_merge']='enabled';
$dictionary['User']['fields']['adresse_rep']['merge_filter']='enabled';
$dictionary['User']['fields']['adresse_rep']['calculated']=false;
$dictionary['User']['fields']['adresse_rep']['required']=false;
$dictionary['User']['fields']['adresse_rep']['audited']=true;
$dictionary['User']['fields']['adresse_rep']['importable']='true';
$dictionary['User']['fields']['adresse_rep']['duplicate_merge_dom_value']='2';
$dictionary['User']['fields']['adresse_rep']['unified_search']=false;
$dictionary['User']['fields']['adresse_rep']['default']='';
$dictionary['User']['fields']['adresse_rep']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Users/Ext/Vardefs/rt_postal_codes_users_Users.php

// created: 2018-01-31 12:37:05
$dictionary["User"]["fields"]["rt_postal_codes_users"] = array (
  'name' => 'rt_postal_codes_users',
  'type' => 'link',
  'relationship' => 'rt_postal_codes_users',
  'source' => 'non-db',
  'module' => 'rt_postal_codes',
  'bean_name' => false,
  'vname' => 'LBL_RT_POSTAL_CODES_USERS_FROM_RT_POSTAL_CODES_TITLE',
  'id_name' => 'rt_postal_codes_usersrt_postal_codes_ida',
);

?>
