<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_statut_precedent.php

 // created: 2018-01-24 19:47:42
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['name']='statut_precedent';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['vname']='LBL_STATUT_PRECEDENT';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['type']='varchar';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['dbType']='varchar';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['duplicate_merge']='enabled';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['merge_filter']='enabled';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['calculated']=false;
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['required']=true;
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['audited']=true;
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['importable']='true';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['duplicate_merge_dom_value']='2';
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['dsm_dnc_historic']['fields']['statut_precedent']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_contact_id.php


$dictionary['dsm_dnc_historic']['fields']['contact_id'] = array(
    'name'              => 'contact_id',
    'rname'             => 'id',
    'vname'             => 'LBL_CONTACT_ID',
    'type'              => 'id',
    'table'             => 'contacts',
    'isnull'            => 'true',
    'module'            => 'Contact',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_user_id.php


$dictionary["dsm_dnc_historic"]["fields"]["user_id"] = array(
    'inline_edit' => 0,
      'required' => false,
      'name' => 'user_id',
      'vname' => 'LBL_WOW_DNC_HISTORIC_USER_ID',
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
      'id' => 'dsm_dnc_historicuser_id',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_contact_name.php

 // created: 2018-01-26 17:10:12
$dictionary['dsm_dnc_historic']['fields']['contact_name']['required']=false;
$dictionary['dsm_dnc_historic']['fields']['contact_name']['source']='non-db';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['name']='contact_name';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['vname']='LBL_CONTACT_NAME';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['type']='relate';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['rname']='name';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['id_name']='contact_id';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['join_name']='contacts';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['link']='contacts';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['table']='contacts';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['isnull']='true';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['module']='Contacts';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['audited']=false;
$dictionary['dsm_dnc_historic']['fields']['contact_name']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['contact_name']['duplicate_merge']='enabled';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['duplicate_merge_dom_value']='1';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['merge_filter']='disabled';
$dictionary['dsm_dnc_historic']['fields']['contact_name']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['contact_name']['calculated']=false;

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_dsm_dnc_name.php

 // created: 2018-01-26 17:10:12
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['required']=false;
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['source']='non-db';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['name']='dsm_dnc_name';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['vname']='LBL_DSM_DNC_NAME';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['type']='relate';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['rname']='name';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['id_name']='dsm_dnc_id';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['join_name']='dsm_dnc';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['link']='dsm_dnc';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['table']='dsm_dnc';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['isnull']='true';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['module']='dsm_dnc';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['audited']=false;
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['duplicate_merge']='enabled';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['duplicate_merge_dom_value']='1';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['merge_filter']='disabled';
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_name']['calculated']=false;

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_modified_by.php

 // created: 2018-01-29 16:20:27
$dictionary['dsm_dnc_historic']['fields']['modified_by']['name']='modified_by';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['vname']='LBL_MODIFIED_BY';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['type']='enum';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['options']='dnc_source_dom';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['modified_by']['duplicate_merge']='enabled';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['merge_filter']='enabled';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['calculated']=false;
$dictionary['dsm_dnc_historic']['fields']['modified_by']['required']=false;
$dictionary['dsm_dnc_historic']['fields']['modified_by']['audited']=false;
$dictionary['dsm_dnc_historic']['fields']['modified_by']['studio']='visible';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['importable']='true';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['duplicate_merge_dom_value']='2';
$dictionary['dsm_dnc_historic']['fields']['modified_by']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['modified_by']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/contacts_relationship.php


$dictionary['dsm_dnc_historic']['fields']['contacts'] = array(
  	'name'          => 'contacts',
    'type'          => 'link',
    'relationship'  => 'contacts_dsm_dnc_historic',
    'module'        => 'Contact',
    'bean_name'     => 'Contacts',
    'source'        => 'non-db',
    'vname'         => 'LBL_CONTACTS',
);

$dictionary['dsm_dnc_historic']['relationships']['contacts_dsm_dnc_historic'] = array(
    'lhs_module'		=> 'Contacts',
    'lhs_table'			=> 'contacts',
    'lhs_key'			=> 'id',
    'rhs_module'		=> 'dsm_dnc_historic',
    'rhs_table'			=> 'dsm_dnc_historic',
    'rhs_key'			=> 'contact_id',
    'relationship_type'	=> 'one-to-many',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/dsm_dnc_relationship.php


$dictionary['dsm_dnc_historic']['fields']['dsm_dnc'] = array(
  	'name'          => 'dsm_dnc',
    'type'          => 'link',
    'relationship'  => 'dsm_dnc_dsm_dnc_historic',
    'module'        => 'dsm_dnc',
    'bean_name'     => 'dsm_dnc',
    'source'        => 'non-db',
    'vname'         => 'LBL_DSM_DNC',
);

$dictionary['dsm_dnc_historic']['relationships']['dsm_dnc_dsm_dnc_historic'] = array(
    'lhs_module'		=> 'dsm_dnc',
    'lhs_table'			=> 'dsm_dnc',
    'lhs_key'			=> 'id',
    'rhs_module'		=> 'dsm_dnc_historic',
    'rhs_table'			=> 'dsm_dnc_historic',
    'rhs_key'			=> 'dsm_dnc_id',
    'relationship_type'	=> 'one-to-many',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_dsm_dnc_id.php


$dictionary['dsm_dnc_historic']['fields']['dsm_dnc_id'] = array(
    'name'              => 'dsm_dnc_id',
    'rname'             => 'id',
    'vname'             => 'LBL_DSM_DNC_ID',
    'type'              => 'id',
    'table'             => 'dsm_dnc',
    'isnull'            => 'true',
    'module'            => 'dsm_dnc',
    'dbType'            => 'id',
    'reportable'        => false,
    'massupdate'        => false,
    'duplicate_merge'   => 'disabled',
);

?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_source_details.php

 // created: 2018-01-24 19:48:06
$dictionary['dsm_dnc_historic']['fields']['source_details']['required']=false;
$dictionary['dsm_dnc_historic']['fields']['source_details']['source']='non-db';
$dictionary['dsm_dnc_historic']['fields']['source_details']['name']='source_details';
$dictionary['dsm_dnc_historic']['fields']['source_details']['vname']='LBL_SOURCE_DETAILS';
$dictionary['dsm_dnc_historic']['fields']['source_details']['type']='relate';
$dictionary['dsm_dnc_historic']['fields']['source_details']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['source_details']['default']=NULL;
$dictionary['dsm_dnc_historic']['fields']['source_details']['no_default']=false;
$dictionary['dsm_dnc_historic']['fields']['source_details']['comments']='';
$dictionary['dsm_dnc_historic']['fields']['source_details']['help']='';
$dictionary['dsm_dnc_historic']['fields']['source_details']['importable']='true';
$dictionary['dsm_dnc_historic']['fields']['source_details']['duplicate_merge']='enabled';
$dictionary['dsm_dnc_historic']['fields']['source_details']['duplicate_merge_dom_value']='1';
$dictionary['dsm_dnc_historic']['fields']['source_details']['audited']=true;
$dictionary['dsm_dnc_historic']['fields']['source_details']['reportable']=true;
$dictionary['dsm_dnc_historic']['fields']['source_details']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['source_details']['merge_filter']='disabled';
$dictionary['dsm_dnc_historic']['fields']['source_details']['calculated']=false;
$dictionary['dsm_dnc_historic']['fields']['source_details']['len']='255';
$dictionary['dsm_dnc_historic']['fields']['source_details']['size']='20';
$dictionary['dsm_dnc_historic']['fields']['source_details']['id_name']='user_id';
$dictionary['dsm_dnc_historic']['fields']['source_details']['ext2']='Users';
$dictionary['dsm_dnc_historic']['fields']['source_details']['module']='Users';
$dictionary['dsm_dnc_historic']['fields']['source_details']['rname']='name';
$dictionary['dsm_dnc_historic']['fields']['source_details']['quicksearch']='enabled';
$dictionary['dsm_dnc_historic']['fields']['source_details']['studio']='visible';
$dictionary['dsm_dnc_historic']['fields']['source_details']['id']='dsm_dnc_historicsource_details';

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_date_enregistrement.php

 // created: 2018-03-01 18:31:02
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['name']='date_enregistrement';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['vname']='LBL_DATE_ENREGISTREMENT';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['type']='datetime';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['duplicate_merge']='disabled';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['merge_filter']='disabled';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['calculated']=false;
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['required']=false;
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['audited']=true;
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['importable']='false';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['duplicate_merge_dom_value']='0';
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['date_enregistrement']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/dsm_dnc_historic/Ext/Vardefs/sugarfield_name.php

 // created: 2018-01-25 15:24:10
$dictionary['dsm_dnc_historic']['fields']['name']['len']='255';
$dictionary['dsm_dnc_historic']['fields']['name']['audited']=false;
$dictionary['dsm_dnc_historic']['fields']['name']['massupdate']=false;
$dictionary['dsm_dnc_historic']['fields']['name']['unified_search']=false;
$dictionary['dsm_dnc_historic']['fields']['name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.55',
  'searchable' => true,
);
$dictionary['dsm_dnc_historic']['fields']['name']['calculated']=false;

 
?>
