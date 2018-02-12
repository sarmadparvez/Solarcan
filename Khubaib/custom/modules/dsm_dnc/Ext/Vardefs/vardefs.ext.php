<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_date_enregistrement.php

 // created: 2018-01-24 19:33:49
$dictionary['dsm_dnc']['fields']['date_enregistrement']['name']='date_enregistrement';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['vname']='LBL_DATE_ENREGISTREMENT';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['type']='datetime';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['massupdate']=false;
$dictionary['dsm_dnc']['fields']['date_enregistrement']['duplicate_merge']='enabled';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['merge_filter']='enabled';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['calculated']=false;
$dictionary['dsm_dnc']['fields']['date_enregistrement']['required']=true;
$dictionary['dsm_dnc']['fields']['date_enregistrement']['audited']=true;
$dictionary['dsm_dnc']['fields']['date_enregistrement']['importable']='true';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['duplicate_merge_dom_value']='2';
$dictionary['dsm_dnc']['fields']['date_enregistrement']['unified_search']=false;
$dictionary['dsm_dnc']['fields']['date_enregistrement']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_source_details.php

 // created: 2018-01-25 11:11:47
$dictionary['dsm_dnc']['fields']['source_details']['required']=false;
$dictionary['dsm_dnc']['fields']['source_details']['source']='non-db';
$dictionary['dsm_dnc']['fields']['source_details']['name']='source_details';
$dictionary['dsm_dnc']['fields']['source_details']['vname']='LBL_SOURCE_DETAILS';
$dictionary['dsm_dnc']['fields']['source_details']['type']='relate';
$dictionary['dsm_dnc']['fields']['source_details']['massupdate']=false;
$dictionary['dsm_dnc']['fields']['source_details']['default']=NULL;
$dictionary['dsm_dnc']['fields']['source_details']['no_default']=false;
$dictionary['dsm_dnc']['fields']['source_details']['comments']='';
$dictionary['dsm_dnc']['fields']['source_details']['help']='';
$dictionary['dsm_dnc']['fields']['source_details']['importable']='true';
$dictionary['dsm_dnc']['fields']['source_details']['duplicate_merge']='enabled';
$dictionary['dsm_dnc']['fields']['source_details']['duplicate_merge_dom_value']='1';
$dictionary['dsm_dnc']['fields']['source_details']['audited']=true;
$dictionary['dsm_dnc']['fields']['source_details']['reportable']=true;
$dictionary['dsm_dnc']['fields']['source_details']['unified_search']=false;
$dictionary['dsm_dnc']['fields']['source_details']['merge_filter']='disabled';
$dictionary['dsm_dnc']['fields']['source_details']['calculated']=false;
$dictionary['dsm_dnc']['fields']['source_details']['len']='255';
$dictionary['dsm_dnc']['fields']['source_details']['size']='20';
$dictionary['dsm_dnc']['fields']['source_details']['id_name']='user_id';
$dictionary['dsm_dnc']['fields']['source_details']['ext2']='Users';
$dictionary['dsm_dnc']['fields']['source_details']['module']='Users';
$dictionary['dsm_dnc']['fields']['source_details']['rname']='name';
$dictionary['dsm_dnc']['fields']['source_details']['quicksearch']='enabled';
$dictionary['dsm_dnc']['fields']['source_details']['studio']='visible';
$dictionary['dsm_dnc']['fields']['source_details']['id']='WOW_DNCsource_details';

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_source.php

 // created: 2018-01-24 19:33:37
$dictionary['dsm_dnc']['fields']['source']['name']='source';
$dictionary['dsm_dnc']['fields']['source']['vname']='LBL_SOURCE';
$dictionary['dsm_dnc']['fields']['source']['type']='enum';
$dictionary['dsm_dnc']['fields']['source']['options']='dnc_source_dom';
$dictionary['dsm_dnc']['fields']['source']['massupdate']=false;
$dictionary['dsm_dnc']['fields']['source']['duplicate_merge']='enabled';
$dictionary['dsm_dnc']['fields']['source']['merge_filter']='enabled';
$dictionary['dsm_dnc']['fields']['source']['calculated']=false;
$dictionary['dsm_dnc']['fields']['source']['required']=true;
$dictionary['dsm_dnc']['fields']['source']['audited']=true;
$dictionary['dsm_dnc']['fields']['source']['importable']='true';
$dictionary['dsm_dnc']['fields']['source']['duplicate_merge_dom_value']='2';
$dictionary['dsm_dnc']['fields']['source']['unified_search']=false;
$dictionary['dsm_dnc']['fields']['source']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_name.php

 // created: 2018-01-24 18:50:26
$dictionary['dsm_dnc']['fields']['name']['len']='255';
$dictionary['dsm_dnc']['fields']['name']['audited']=false;
$dictionary['dsm_dnc']['fields']['name']['massupdate']=false;
$dictionary['dsm_dnc']['fields']['name']['unified_search']=false;
$dictionary['dsm_dnc']['fields']['name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.55',
  'searchable' => true,
);
$dictionary['dsm_dnc']['fields']['name']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_telephone.php

 // created: 2018-01-24 19:33:25
$dictionary['dsm_dnc']['fields']['telephone']['name']='telephone';
$dictionary['dsm_dnc']['fields']['telephone']['vname']='LBL_TELEPHONE';
$dictionary['dsm_dnc']['fields']['telephone']['type']='varchar';
$dictionary['dsm_dnc']['fields']['telephone']['dbType']='varchar';
$dictionary['dsm_dnc']['fields']['telephone']['massupdate']=false;
$dictionary['dsm_dnc']['fields']['telephone']['duplicate_merge']='enabled';
$dictionary['dsm_dnc']['fields']['telephone']['merge_filter']='enabled';
$dictionary['dsm_dnc']['fields']['telephone']['calculated']=false;
$dictionary['dsm_dnc']['fields']['telephone']['required']=true;
$dictionary['dsm_dnc']['fields']['telephone']['audited']=true;
$dictionary['dsm_dnc']['fields']['telephone']['importable']='true';
$dictionary['dsm_dnc']['fields']['telephone']['duplicate_merge_dom_value']='2';
$dictionary['dsm_dnc']['fields']['telephone']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_dnc']['fields']['telephone']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/sugarfield_user_id.php


$dictionary["dsm_dnc"]["fields"]["user_id"] = array(
    'inline_edit' => 0,
      'required' => false,
      'name' => 'user_id',
      'vname' => 'LBL_WOW_DNC_USER_ID',
      'type' => 'id',
      'massupdate' => '0',
      'default' => NULL,
      'no_default' => false,
      'comments' => '',
      'help' => '',
      'importable' => 'true',
      'duplicate_merge' => 'disabled',
      'duplicate_merge_dom_value' => '0',
      'audited' => false,
      'reportable' => false,
      'unified_search' => false,
      'merge_filter' => 'disabled',
      'len' => '36',
      'size' => '20',
      'id' => 'WOW_DNCuser_id',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc/Ext/Vardefs/dsm_dnc_historic_relationship.php


$dictionary['dsm_dnc']['fields']['dsm_dnc_dsm_dnc_historic'] = array(
    'name' => 'dsm_dnc_dsm_dnc_historic',
    'type' => 'link',
    'relationship' => 'dsm_dnc_dsm_dnc_historic',
    'module' => 'dsm_dnc_historic',
    'bean_name' => 'dsm_dnc_historic',
    'source' => 'non-db',
    'vname' => 'LBL_DSM_DNC_HISTORIC',
);

?>
