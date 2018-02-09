<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_garage_achanger.php

 // created: 2018-01-25 12:39:25
$dictionary['Meeting']['fields']['nombre_garage_achanger']['name']='nombre_garage_achanger';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['vname']='LBL_NOMBRE_GARAGE_ACHANGER';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_garage_achanger']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['required']=false;
$dictionary['Meeting']['fields']['nombre_garage_achanger']['audited']=true;
$dictionary['Meeting']['fields']['nombre_garage_achanger']['importable']='false';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_garage_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_garage_achanger']['formula']='related($accounts,"nombre_garage_achanger")';
$dictionary['Meeting']['fields']['nombre_garage_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/rli_link_workflow.php

$dictionary['Meeting']['fields']['revenuelineitems']['workflow'] = true;
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_duration_hours.php


$dictionary['Meeting']['fields']['duration_hours'] = array(
    'name' => 'duration_hours',
    'vname' => 'LBL_DURATION_HOURS',
    'type' => 'int',
    'dbType' => 'int',
    'default' => NULL,
    'audited' => true,
    'mass_update' => false,
    'duplicate_merge' => true,
    'reportable' => true,
    'importable' => 'false',
);

?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_etat_de_proprietaire.php

 // created: 2018-01-25 14:18:02
$dictionary['Meeting']['fields']['etat_de_proprietaire']['name']='etat_de_proprietaire';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['type']='varchar';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['vname']='LBL_ETAT_DE_PROPRIETAIRE';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['studio']='visible';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['audited']=false;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['massupdate']=false;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['calculated']='true';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['importable']='false';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['etat_de_proprietaire']['formula']='related($contacts,"etat_de_proprietaire")';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_garage_total.php

 // created: 2018-01-25 12:39:34
$dictionary['Meeting']['fields']['nombre_garage_total']['name']='nombre_garage_total';
$dictionary['Meeting']['fields']['nombre_garage_total']['vname']='LBL_NOMBRE_GARAGE_TOTAL';
$dictionary['Meeting']['fields']['nombre_garage_total']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_garage_total']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_garage_total']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_garage_total']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_garage_total']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_garage_total']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_garage_total']['required']=false;
$dictionary['Meeting']['fields']['nombre_garage_total']['audited']=true;
$dictionary['Meeting']['fields']['nombre_garage_total']['importable']='false';
$dictionary['Meeting']['fields']['nombre_garage_total']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_garage_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_garage_total']['formula']='related($accounts,"nombre_garage_total")';
$dictionary['Meeting']['fields']['nombre_garage_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_email.php

 // created: 2018-01-25 12:40:05
$dictionary['Meeting']['fields']['email']['name']='email';
$dictionary['Meeting']['fields']['email']['vname']='LBL_EMAIL';
$dictionary['Meeting']['fields']['email']['type']='varchar';
$dictionary['Meeting']['fields']['email']['dbType']='varchar';
$dictionary['Meeting']['fields']['email']['massupdate']=false;
$dictionary['Meeting']['fields']['email']['duplicate_merge']='enabled';
$dictionary['Meeting']['fields']['email']['merge_filter']='enabled';
$dictionary['Meeting']['fields']['email']['calculated']=false;
$dictionary['Meeting']['fields']['email']['required']=false;
$dictionary['Meeting']['fields']['email']['audited']=true;
$dictionary['Meeting']['fields']['email']['importable']='true';
$dictionary['Meeting']['fields']['email']['duplicate_merge_dom_value']='2';
$dictionary['Meeting']['fields']['email']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_source.php

 // created: 2018-01-25 12:40:23
$dictionary['Meeting']['fields']['source']['name']='source';
$dictionary['Meeting']['fields']['source']['vname']='LBL_SOURCE';
$dictionary['Meeting']['fields']['source']['type']='enum';
$dictionary['Meeting']['fields']['source']['massupdate']=true;
$dictionary['Meeting']['fields']['source']['duplicate_merge']='enabled';
$dictionary['Meeting']['fields']['source']['merge_filter']='enabled';
$dictionary['Meeting']['fields']['source']['calculated']=false;
$dictionary['Meeting']['fields']['source']['required']=false;
$dictionary['Meeting']['fields']['source']['len']=100;
$dictionary['Meeting']['fields']['source']['audited']=true;
$dictionary['Meeting']['fields']['source']['importable']='true';
$dictionary['Meeting']['fields']['source']['options']='source_dom';
$dictionary['Meeting']['fields']['source']['duplicate_merge_dom_value']='2';
$dictionary['Meeting']['fields']['source']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_phone_home.php

 // created: 2018-01-25 12:18:46
$dictionary['Meeting']['fields']['phone_home']['name']='phone_home';
$dictionary['Meeting']['fields']['phone_home']['vname']='LBL_PHONE_HOME';
$dictionary['Meeting']['fields']['phone_home']['type']='varchar';
$dictionary['Meeting']['fields']['phone_home']['dbType']='varchar';
$dictionary['Meeting']['fields']['phone_home']['massupdate']=false;
$dictionary['Meeting']['fields']['phone_home']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['phone_home']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['phone_home']['calculated']='true';
$dictionary['Meeting']['fields']['phone_home']['required']=false;
$dictionary['Meeting']['fields']['phone_home']['audited']=true;
$dictionary['Meeting']['fields']['phone_home']['importable']='false';
$dictionary['Meeting']['fields']['phone_home']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['phone_home']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['phone_home']['formula']='related($contacts,"phone_home")';
$dictionary['Meeting']['fields']['phone_home']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_portes_total.php

 // created: 2018-01-25 12:39:48
$dictionary['Meeting']['fields']['nombre_portes_total']['name']='nombre_portes_total';
$dictionary['Meeting']['fields']['nombre_portes_total']['vname']='LBL_NOMBRE_PORTES_TOTAL';
$dictionary['Meeting']['fields']['nombre_portes_total']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_portes_total']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_portes_total']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_portes_total']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_portes_total']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_portes_total']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_portes_total']['required']=false;
$dictionary['Meeting']['fields']['nombre_portes_total']['audited']=true;
$dictionary['Meeting']['fields']['nombre_portes_total']['importable']='false';
$dictionary['Meeting']['fields']['nombre_portes_total']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_portes_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_portes_total']['formula']='related($accounts,"nombre_portes_total")';
$dictionary['Meeting']['fields']['nombre_portes_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_annee_construction.php

 // created: 2018-01-25 12:39:00
$dictionary['Meeting']['fields']['annee_construction']['name']='annee_construction';
$dictionary['Meeting']['fields']['annee_construction']['vname']='LBL_ANNEE_CONSTRUCTION';
$dictionary['Meeting']['fields']['annee_construction']['type']='varchar';
$dictionary['Meeting']['fields']['annee_construction']['dbType']='varchar';
$dictionary['Meeting']['fields']['annee_construction']['massupdate']=false;
$dictionary['Meeting']['fields']['annee_construction']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['annee_construction']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['annee_construction']['calculated']='1';
$dictionary['Meeting']['fields']['annee_construction']['required']=false;
$dictionary['Meeting']['fields']['annee_construction']['audited']=true;
$dictionary['Meeting']['fields']['annee_construction']['importable']='false';
$dictionary['Meeting']['fields']['annee_construction']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['annee_construction']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['annee_construction']['formula']='related($accounts,"annee_construction")';
$dictionary['Meeting']['fields']['annee_construction']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_type.php

 // created: 2018-01-23 17:34:47
$dictionary['Meeting']['fields']['type']['len']=100;
$dictionary['Meeting']['fields']['type']['audited']=false;
$dictionary['Meeting']['fields']['type']['comments']='Meeting type (ex: WebEx, Other)';
$dictionary['Meeting']['fields']['type']['duplicate_merge']='enabled';
$dictionary['Meeting']['fields']['type']['duplicate_merge_dom_value']='1';
$dictionary['Meeting']['fields']['type']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['type']['calculated']=false;
$dictionary['Meeting']['fields']['type']['dependency']=false;
$dictionary['Meeting']['fields']['type']['options']='meeting_type';

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_status.php

 // created: 2018-01-23 17:11:38
$dictionary['Meeting']['fields']['status']['audited']=false;
$dictionary['Meeting']['fields']['status']['massupdate']=true;
$dictionary['Meeting']['fields']['status']['comments']='Meeting status (ex: Planned, Held, Not held)';
$dictionary['Meeting']['fields']['status']['duplicate_merge']='enabled';
$dictionary['Meeting']['fields']['status']['duplicate_merge_dom_value']='1';
$dictionary['Meeting']['fields']['status']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['status']['calculated']=false;
$dictionary['Meeting']['fields']['status']['dependency']=false;
$dictionary['Meeting']['fields']['status']['full_text_search']=array (
);

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_fenetres_total.php

 // created: 2018-01-25 12:39:15
$dictionary['Meeting']['fields']['nombre_fenetres_total']['name']='nombre_fenetres_total';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['vname']='LBL_NOMBRE_FENETRES_TOTAL';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_fenetres_total']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['required']=false;
$dictionary['Meeting']['fields']['nombre_fenetres_total']['audited']=true;
$dictionary['Meeting']['fields']['nombre_fenetres_total']['importable']='false';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_fenetres_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_fenetres_total']['formula']='related($accounts,"nombre_fenetres_total")';
$dictionary['Meeting']['fields']['nombre_fenetres_total']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_fenetres_achanger.php

 // created: 2018-01-25 12:39:10
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['name']='nombre_fenetres_achanger';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['vname']='LBL_NOMBRE_FENETRES_ACHANGER';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['required']=false;
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['audited']=true;
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['importable']='false';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['formula']='related($accounts,"nombre_fenetres_achanger")';
$dictionary['Meeting']['fields']['nombre_fenetres_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_financement.php

 // created: 2018-01-24 15:30:01
$dictionary['Meeting']['fields']['financement']['name']='financement';
$dictionary['Meeting']['fields']['financement']['vname']='LBL_FINANCEMENT';
$dictionary['Meeting']['fields']['financement']['type']='enum';
$dictionary['Meeting']['fields']['financement']['massupdate']=true;
$dictionary['Meeting']['fields']['financement']['duplicate_merge']='enabled';
$dictionary['Meeting']['fields']['financement']['merge_filter']='enabled';
$dictionary['Meeting']['fields']['financement']['calculated']=false;
$dictionary['Meeting']['fields']['financement']['required']=true;
$dictionary['Meeting']['fields']['financement']['len']=100;
$dictionary['Meeting']['fields']['financement']['audited']=true;
$dictionary['Meeting']['fields']['financement']['importable']='true';
$dictionary['Meeting']['fields']['financement']['options']='yes_no_dom';
$dictionary['Meeting']['fields']['financement']['duplicate_merge_dom_value']='2';
$dictionary['Meeting']['fields']['financement']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_phone_mobile.php

 // created: 2018-01-25 12:18:26
$dictionary['Meeting']['fields']['phone_mobile']['name']='phone_mobile';
$dictionary['Meeting']['fields']['phone_mobile']['vname']='LBL_PHONE_MOBILE';
$dictionary['Meeting']['fields']['phone_mobile']['type']='varchar';
$dictionary['Meeting']['fields']['phone_mobile']['dbType']='varchar';
$dictionary['Meeting']['fields']['phone_mobile']['massupdate']=false;
$dictionary['Meeting']['fields']['phone_mobile']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['phone_mobile']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['phone_mobile']['calculated']='true';
$dictionary['Meeting']['fields']['phone_mobile']['required']=false;
$dictionary['Meeting']['fields']['phone_mobile']['audited']=true;
$dictionary['Meeting']['fields']['phone_mobile']['importable']='false';
$dictionary['Meeting']['fields']['phone_mobile']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['phone_mobile']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['phone_mobile']['formula']='related($contacts,"phone_mobile")';
$dictionary['Meeting']['fields']['phone_mobile']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_occupant_depuis.php

 // created: 2018-01-25 12:39:53
$dictionary['Meeting']['fields']['occupant_depuis']['name']='occupant_depuis';
$dictionary['Meeting']['fields']['occupant_depuis']['vname']='LBL_OCCUPANT_DEPUIS';
$dictionary['Meeting']['fields']['occupant_depuis']['type']='varchar';
$dictionary['Meeting']['fields']['occupant_depuis']['dbType']='varchar';
$dictionary['Meeting']['fields']['occupant_depuis']['massupdate']=false;
$dictionary['Meeting']['fields']['occupant_depuis']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['occupant_depuis']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['occupant_depuis']['calculated']='1';
$dictionary['Meeting']['fields']['occupant_depuis']['required']=false;
$dictionary['Meeting']['fields']['occupant_depuis']['audited']=true;
$dictionary['Meeting']['fields']['occupant_depuis']['importable']='false';
$dictionary['Meeting']['fields']['occupant_depuis']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['occupant_depuis']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['occupant_depuis']['formula']='related($contacts,"occupant_depuis")';
$dictionary['Meeting']['fields']['occupant_depuis']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_nombre_portes_achanger.php

 // created: 2018-01-25 12:39:42
$dictionary['Meeting']['fields']['nombre_portes_achanger']['name']='nombre_portes_achanger';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['vname']='LBL_NOMBRE_PORTES_ACHANGER';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['type']='varchar';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['dbType']='varchar';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['massupdate']=false;
$dictionary['Meeting']['fields']['nombre_portes_achanger']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['calculated']='1';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['required']=false;
$dictionary['Meeting']['fields']['nombre_portes_achanger']['audited']=true;
$dictionary['Meeting']['fields']['nombre_portes_achanger']['importable']='false';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['nombre_portes_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['nombre_portes_achanger']['formula']='related($accounts,"nombre_portes_achanger")';
$dictionary['Meeting']['fields']['nombre_portes_achanger']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Meetings/Ext/Vardefs/sugarfield_duration_minutes.php


$dictionary['Meeting']['fields']['duration_minutes'] = array(
    'name' => 'duration_minutes',
    'vname' => 'LBL_DURATION_MINUTES',
    'type' => 'int',
    'dbType' => 'int',
    'default' => NULL,
    'audited' => true,
    'mass_update' => false,
    'duplicate_merge' => true,
    'reportable' => true,
    'importable' => 'false',
);

?>
