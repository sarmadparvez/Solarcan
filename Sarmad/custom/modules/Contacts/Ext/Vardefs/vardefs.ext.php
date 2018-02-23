<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_assistant.php

 // created: 2018-01-23 15:34:46
$dictionary['Contact']['fields']['assistant']['audited']=false;
$dictionary['Contact']['fields']['assistant']['massupdate']=false;
$dictionary['Contact']['fields']['assistant']['comments']='Name of the assistant of the contact';
$dictionary['Contact']['fields']['assistant']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['assistant']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['assistant']['merge_filter']='disabled';
$dictionary['Contact']['fields']['assistant']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['assistant']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_date_entered.php

 // created: 2018-01-23 15:27:27
$dictionary['Contact']['fields']['date_entered']['audited']=false;
$dictionary['Contact']['fields']['date_entered']['comments']='Date record created';
$dictionary['Contact']['fields']['date_entered']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['date_entered']['duplicate_merge_dom_value']=1;
$dictionary['Contact']['fields']['date_entered']['merge_filter']='disabled';
$dictionary['Contact']['fields']['date_entered']['calculated']=false;
$dictionary['Contact']['fields']['date_entered']['enable_range_search']='1';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_last_name.php

 // created: 2018-01-24 12:45:45
$dictionary['Contact']['fields']['last_name']['audited']=false;
$dictionary['Contact']['fields']['last_name']['massupdate']=false;
$dictionary['Contact']['fields']['last_name']['comments']='Last name of the contact';
$dictionary['Contact']['fields']['last_name']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['last_name']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['last_name']['merge_filter']='disabled';
$dictionary['Contact']['fields']['last_name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.97',
  'searchable' => true,
);
$dictionary['Contact']['fields']['last_name']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_salutation.php

 // created: 2018-01-24 12:45:31
$dictionary['Contact']['fields']['salutation']['len']=100;
$dictionary['Contact']['fields']['salutation']['audited']=false;
$dictionary['Contact']['fields']['salutation']['comments']='Contact salutation (e.g., Mr, Ms)';
$dictionary['Contact']['fields']['salutation']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['salutation']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['salutation']['merge_filter']='disabled';
$dictionary['Contact']['fields']['salutation']['calculated']=false;
$dictionary['Contact']['fields']['salutation']['dependency']=false;
$dictionary['Contact']['fields']['salutation']['required']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_source.php

 // created: 2018-01-23 18:05:45
$dictionary['Contact']['fields']['source']['name']='source';
$dictionary['Contact']['fields']['source']['vname']='LBL_SOURCE';
$dictionary['Contact']['fields']['source']['type']='enum';
$dictionary['Contact']['fields']['source']['massupdate']=true;
$dictionary['Contact']['fields']['source']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['source']['merge_filter']='enabled';
$dictionary['Contact']['fields']['source']['calculated']=false;
$dictionary['Contact']['fields']['source']['required']=true;
$dictionary['Contact']['fields']['source']['len']=100;
$dictionary['Contact']['fields']['source']['audited']=true;
$dictionary['Contact']['fields']['source']['importable']='true';
$dictionary['Contact']['fields']['source']['options']='source_dom';
$dictionary['Contact']['fields']['source']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['source']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_mkto_lead_score.php

 // created: 2018-01-23 15:36:02
$dictionary['Contact']['fields']['mkto_lead_score']['audited']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['massupdate']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['mkto_lead_score']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['mkto_lead_score']['merge_filter']='disabled';
$dictionary['Contact']['fields']['mkto_lead_score']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['mkto_lead_score']['calculated']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['enable_range_search']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['min']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['max']=false;
$dictionary['Contact']['fields']['mkto_lead_score']['disable_num_format']='';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_dnb_principal_id.php

 // created: 2018-01-23 15:35:19
$dictionary['Contact']['fields']['dnb_principal_id']['len']='30';
$dictionary['Contact']['fields']['dnb_principal_id']['audited']=false;
$dictionary['Contact']['fields']['dnb_principal_id']['massupdate']=false;
$dictionary['Contact']['fields']['dnb_principal_id']['comments']='Unique Id For D&B Contact';
$dictionary['Contact']['fields']['dnb_principal_id']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['dnb_principal_id']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['dnb_principal_id']['merge_filter']='disabled';
$dictionary['Contact']['fields']['dnb_principal_id']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['dnb_principal_id']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_phone_home.php

 // created: 2018-01-24 12:46:23
$dictionary['Contact']['fields']['phone_home']['len']='100';
$dictionary['Contact']['fields']['phone_home']['audited']=false;
$dictionary['Contact']['fields']['phone_home']['massupdate']=false;
$dictionary['Contact']['fields']['phone_home']['comments']='Home phone number of the contact';
$dictionary['Contact']['fields']['phone_home']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['phone_home']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['phone_home']['merge_filter']='disabled';
$dictionary['Contact']['fields']['phone_home']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.1',
  'searchable' => true,
);
$dictionary['Contact']['fields']['phone_home']['calculated']=false;
$dictionary['Contact']['fields']['phone_home']['required']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_phone_fax.php

 // created: 2018-01-23 15:30:52
$dictionary['Contact']['fields']['phone_fax']['len']='100';
$dictionary['Contact']['fields']['phone_fax']['audited']=false;
$dictionary['Contact']['fields']['phone_fax']['massupdate']=false;
$dictionary['Contact']['fields']['phone_fax']['comments']='Contact fax number';
$dictionary['Contact']['fields']['phone_fax']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['phone_fax']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['phone_fax']['merge_filter']='disabled';
$dictionary['Contact']['fields']['phone_fax']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.06',
  'searchable' => true,
);
$dictionary['Contact']['fields']['phone_fax']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_assistant_phone.php

 // created: 2018-01-23 15:34:52
$dictionary['Contact']['fields']['assistant_phone']['len']='100';
$dictionary['Contact']['fields']['assistant_phone']['audited']=false;
$dictionary['Contact']['fields']['assistant_phone']['massupdate']=false;
$dictionary['Contact']['fields']['assistant_phone']['comments']='Phone number of the assistant of the contact';
$dictionary['Contact']['fields']['assistant_phone']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['assistant_phone']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['assistant_phone']['merge_filter']='disabled';
$dictionary['Contact']['fields']['assistant_phone']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['assistant_phone']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_statut_dnc.php

 // created: 2018-01-29 15:19:58
$dictionary['Contact']['fields']['statut_dnc']['name']='statut_dnc';
$dictionary['Contact']['fields']['statut_dnc']['vname']='LBL_STATUT_DNC';
$dictionary['Contact']['fields']['statut_dnc']['type']='text';
$dictionary['Contact']['fields']['statut_dnc']['dbType']='varchar';
$dictionary['Contact']['fields']['statut_dnc']['massupdate']=false;
$dictionary['Contact']['fields']['statut_dnc']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['statut_dnc']['merge_filter']='enabled';
$dictionary['Contact']['fields']['statut_dnc']['calculated']=false;
$dictionary['Contact']['fields']['statut_dnc']['required']=false;
$dictionary['Contact']['fields']['statut_dnc']['default']='Active';
$dictionary['Contact']['fields']['statut_dnc']['audited']=true;
$dictionary['Contact']['fields']['statut_dnc']['importable']='true';
$dictionary['Contact']['fields']['statut_dnc']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['statut_dnc']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['statut_dnc']['rows']='4';
$dictionary['Contact']['fields']['statut_dnc']['cols']='20';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_alt_address_postalcode.php

 // created: 2018-01-23 15:34:34
$dictionary['Contact']['fields']['alt_address_postalcode']['audited']=false;
$dictionary['Contact']['fields']['alt_address_postalcode']['massupdate']=false;
$dictionary['Contact']['fields']['alt_address_postalcode']['comments']='Postal code for alternate address';
$dictionary['Contact']['fields']['alt_address_postalcode']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['alt_address_postalcode']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['alt_address_postalcode']['merge_filter']='disabled';
$dictionary['Contact']['fields']['alt_address_postalcode']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['alt_address_postalcode']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_phone_work.php

 // created: 2018-01-23 15:30:31
$dictionary['Contact']['fields']['phone_work']['len']='100';
$dictionary['Contact']['fields']['phone_work']['audited']=false;
$dictionary['Contact']['fields']['phone_work']['massupdate']=false;
$dictionary['Contact']['fields']['phone_work']['comments']='Work phone number of the contact';
$dictionary['Contact']['fields']['phone_work']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['phone_work']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['phone_work']['merge_filter']='disabled';
$dictionary['Contact']['fields']['phone_work']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.08',
  'searchable' => true,
);
$dictionary['Contact']['fields']['phone_work']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_picture.php

 // created: 2018-01-25 12:45:06
$dictionary['Contact']['fields']['picture']['len']=255;
$dictionary['Contact']['fields']['picture']['required']=false;
$dictionary['Contact']['fields']['picture']['audited']=false;
$dictionary['Contact']['fields']['picture']['comments']='Avatar';
$dictionary['Contact']['fields']['picture']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['picture']['duplicate_merge_dom_value']=1;
$dictionary['Contact']['fields']['picture']['merge_filter']='disabled';
$dictionary['Contact']['fields']['picture']['reportable']=true;
$dictionary['Contact']['fields']['picture']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_department.php

 // created: 2018-01-23 15:29:54
$dictionary['Contact']['fields']['department']['audited']=false;
$dictionary['Contact']['fields']['department']['massupdate']=false;
$dictionary['Contact']['fields']['department']['comments']='The department of the contact';
$dictionary['Contact']['fields']['department']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['department']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['department']['merge_filter']='disabled';
$dictionary['Contact']['fields']['department']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['department']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_codecie_c.php


$dictionary['Contact']['fields']['codecie_c'] = array (
	'name' => 'codecie_c',
	'vname' => 'LBL_CODECIE_C',
	'type' => 'enum',
	'massupdate' => true,
	'duplicate_merge' => 'enabled',
	'merge_filter' => 'enabled',
	'calculated' => false,
	'required' => true,
	'len' => 50,
	'size' => 50,
	'importable' => true,
	'options' => 'codecie_dom',
	'audited' => true,
	'reportable' => true,
	'default' => 'Solarcan'
);

?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_alt_address_country.php

 // created: 2018-01-23 15:34:40
$dictionary['Contact']['fields']['alt_address_country']['audited']=false;
$dictionary['Contact']['fields']['alt_address_country']['massupdate']=false;
$dictionary['Contact']['fields']['alt_address_country']['comments']='Country for alternate address';
$dictionary['Contact']['fields']['alt_address_country']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['alt_address_country']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['alt_address_country']['merge_filter']='disabled';
$dictionary['Contact']['fields']['alt_address_country']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['alt_address_country']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_alt_address_street.php

 // created: 2018-01-23 15:34:15
$dictionary['Contact']['fields']['alt_address_street']['audited']=false;
$dictionary['Contact']['fields']['alt_address_street']['massupdate']=false;
$dictionary['Contact']['fields']['alt_address_street']['comments']='Street address for alternate address';
$dictionary['Contact']['fields']['alt_address_street']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['alt_address_street']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['alt_address_street']['merge_filter']='disabled';
$dictionary['Contact']['fields']['alt_address_street']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.32',
  'searchable' => true,
);
$dictionary['Contact']['fields']['alt_address_street']['calculated']=false;
$dictionary['Contact']['fields']['alt_address_street']['rows']='4';
$dictionary['Contact']['fields']['alt_address_street']['cols']='20';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_primary_address_postalcode.php

 // created: 2018-01-23 15:34:01
$dictionary['Contact']['fields']['primary_address_postalcode']['audited']=false;
$dictionary['Contact']['fields']['primary_address_postalcode']['massupdate']=false;
$dictionary['Contact']['fields']['primary_address_postalcode']['comments']='Postal code for primary address';
$dictionary['Contact']['fields']['primary_address_postalcode']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['primary_address_postalcode']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['primary_address_postalcode']['merge_filter']='disabled';
$dictionary['Contact']['fields']['primary_address_postalcode']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['primary_address_postalcode']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/dsm_dnc_historic_relationship.php


$dictionary['Contact']['fields']['contacts_dsm_dnc_historic'] = array(
    'name' => 'contacts_dsm_dnc_historic',
    'type' => 'link',
    'relationship' => 'contacts_dsm_dnc_historic',
    'module' => 'dsm_dnc_historic',
    'bean_name' => 'dsm_dnc_historic',
    'source' => 'non-db',
    'vname' => 'LBL_DSM_DNC_HISTORIC',
);

?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_date_de_consentement_datestamp.php

 // created: 2018-01-25 16:57:23
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['name']='date_de_consentement_datestamp';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['vname']='LBL_DATE_DE_CONSENTEMENT_DATESTAMP';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['type']='datetime';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['massupdate']=true;
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['merge_filter']='enabled';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['calculated']=false;
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['required']=false;
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['audited']=true;
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['importable']='true';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['date_de_consentement_datestamp']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_birthdate.php

 // created: 2018-01-23 15:35:25
$dictionary['Contact']['fields']['birthdate']['audited']=false;
$dictionary['Contact']['fields']['birthdate']['comments']='The birthdate of the contact';
$dictionary['Contact']['fields']['birthdate']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['birthdate']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['birthdate']['merge_filter']='disabled';
$dictionary['Contact']['fields']['birthdate']['calculated']=false;
$dictionary['Contact']['fields']['birthdate']['enable_range_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_phone_mobile.php

 // created: 2018-01-23 15:30:23
$dictionary['Contact']['fields']['phone_mobile']['len']='100';
$dictionary['Contact']['fields']['phone_mobile']['audited']=false;
$dictionary['Contact']['fields']['phone_mobile']['massupdate']=false;
$dictionary['Contact']['fields']['phone_mobile']['comments']='Mobile phone number of the contact';
$dictionary['Contact']['fields']['phone_mobile']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['phone_mobile']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['phone_mobile']['merge_filter']='disabled';
$dictionary['Contact']['fields']['phone_mobile']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.09',
  'searchable' => true,
);
$dictionary['Contact']['fields']['phone_mobile']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_first_name.php

 // created: 2018-01-24 12:45:39
$dictionary['Contact']['fields']['first_name']['audited']=false;
$dictionary['Contact']['fields']['first_name']['massupdate']=false;
$dictionary['Contact']['fields']['first_name']['comments']='First name of the contact';
$dictionary['Contact']['fields']['first_name']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['first_name']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['first_name']['merge_filter']='disabled';
$dictionary['Contact']['fields']['first_name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.99',
  'searchable' => true,
);
$dictionary['Contact']['fields']['first_name']['calculated']=false;
$dictionary['Contact']['fields']['first_name']['required']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_alt_address_state.php

 // created: 2018-01-23 15:34:27
$dictionary['Contact']['fields']['alt_address_state']['audited']=false;
$dictionary['Contact']['fields']['alt_address_state']['massupdate']=false;
$dictionary['Contact']['fields']['alt_address_state']['comments']='State for alternate address';
$dictionary['Contact']['fields']['alt_address_state']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['alt_address_state']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['alt_address_state']['merge_filter']='disabled';
$dictionary['Contact']['fields']['alt_address_state']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['alt_address_state']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_googleplus.php

 // created: 2018-01-23 15:29:48
$dictionary['Contact']['fields']['googleplus']['audited']=false;
$dictionary['Contact']['fields']['googleplus']['massupdate']=false;
$dictionary['Contact']['fields']['googleplus']['comments']='The google plus id of the user';
$dictionary['Contact']['fields']['googleplus']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['googleplus']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['googleplus']['merge_filter']='disabled';
$dictionary['Contact']['fields']['googleplus']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['googleplus']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_primary_address_state.php

 // created: 2018-01-23 15:33:49
$dictionary['Contact']['fields']['primary_address_state']['audited']=false;
$dictionary['Contact']['fields']['primary_address_state']['massupdate']=false;
$dictionary['Contact']['fields']['primary_address_state']['comments']='State for primary address';
$dictionary['Contact']['fields']['primary_address_state']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['primary_address_state']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['primary_address_state']['merge_filter']='disabled';
$dictionary['Contact']['fields']['primary_address_state']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['primary_address_state']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_occupant_depuis.php

 // created: 2018-01-24 12:47:29
$dictionary['Contact']['fields']['occupant_depuis']['name']='occupant_depuis';
$dictionary['Contact']['fields']['occupant_depuis']['vname']='LBL_OCCUPANT_DEPUIS';
$dictionary['Contact']['fields']['occupant_depuis']['type']='varchar';
$dictionary['Contact']['fields']['occupant_depuis']['dbType']='varchar';
$dictionary['Contact']['fields']['occupant_depuis']['massupdate']=false;
$dictionary['Contact']['fields']['occupant_depuis']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['occupant_depuis']['merge_filter']='enabled';
$dictionary['Contact']['fields']['occupant_depuis']['calculated']=false;
$dictionary['Contact']['fields']['occupant_depuis']['required']=true;
$dictionary['Contact']['fields']['occupant_depuis']['audited']=true;
$dictionary['Contact']['fields']['occupant_depuis']['importable']='true';
$dictionary['Contact']['fields']['occupant_depuis']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['occupant_depuis']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_primary_address_street.php

 // created: 2018-01-23 15:31:09
$dictionary['Contact']['fields']['primary_address_street']['audited']=false;
$dictionary['Contact']['fields']['primary_address_street']['massupdate']=false;
$dictionary['Contact']['fields']['primary_address_street']['comments']='The street address used for primary address';
$dictionary['Contact']['fields']['primary_address_street']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['primary_address_street']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['primary_address_street']['merge_filter']='disabled';
$dictionary['Contact']['fields']['primary_address_street']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.33',
  'searchable' => true,
);
$dictionary['Contact']['fields']['primary_address_street']['calculated']=false;
$dictionary['Contact']['fields']['primary_address_street']['rows']='4';
$dictionary['Contact']['fields']['primary_address_street']['cols']='20';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_deleted.php

 // created: 2018-01-23 15:27:53
$dictionary['Contact']['fields']['deleted']['default']=false;
$dictionary['Contact']['fields']['deleted']['audited']=false;
$dictionary['Contact']['fields']['deleted']['massupdate']=false;
$dictionary['Contact']['fields']['deleted']['comments']='Record deletion indicator';
$dictionary['Contact']['fields']['deleted']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['deleted']['duplicate_merge_dom_value']=1;
$dictionary['Contact']['fields']['deleted']['merge_filter']='disabled';
$dictionary['Contact']['fields']['deleted']['reportable']=true;
$dictionary['Contact']['fields']['deleted']['unified_search']=false;
$dictionary['Contact']['fields']['deleted']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_dsm_dnc_name.php

 // created: 2018-01-26 17:10:12
$dictionary['Contact']['fields']['dsm_dnc_name']['required']=false;
$dictionary['Contact']['fields']['dsm_dnc_name']['source']='non-db';
$dictionary['Contact']['fields']['dsm_dnc_name']['name']='dsm_dnc_name';
$dictionary['Contact']['fields']['dsm_dnc_name']['vname']='LBL_DSM_DNC_NAME';
$dictionary['Contact']['fields']['dsm_dnc_name']['type']='relate';
$dictionary['Contact']['fields']['dsm_dnc_name']['rname']='name';
$dictionary['Contact']['fields']['dsm_dnc_name']['id_name']='dsm_dnc_id';
$dictionary['Contact']['fields']['dsm_dnc_name']['table']='dsm_dnc';
$dictionary['Contact']['fields']['dsm_dnc_name']['isnull']='true';
$dictionary['Contact']['fields']['dsm_dnc_name']['module']='dsm_dnc';
$dictionary['Contact']['fields']['dsm_dnc_name']['audited']=false;
$dictionary['Contact']['fields']['dsm_dnc_name']['massupdate']=false;
$dictionary['Contact']['fields']['dsm_dnc_name']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['dsm_dnc_name']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['dsm_dnc_name']['merge_filter']='disabled';
$dictionary['Contact']['fields']['dsm_dnc_name']['unified_search']=false;
$dictionary['Contact']['fields']['dsm_dnc_name']['calculated']=false;
$dictionary['Contact']['fields']['dsm_dnc_name']['studio']='visible';

?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_lead_source.php

 // created: 2018-01-24 12:46:39
$dictionary['Contact']['fields']['lead_source']['len']=100;
$dictionary['Contact']['fields']['lead_source']['audited']=false;
$dictionary['Contact']['fields']['lead_source']['massupdate']=true;
$dictionary['Contact']['fields']['lead_source']['comments']='How did the contact come about';
$dictionary['Contact']['fields']['lead_source']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['lead_source']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['lead_source']['merge_filter']='disabled';
$dictionary['Contact']['fields']['lead_source']['calculated']=false;
$dictionary['Contact']['fields']['lead_source']['dependency']=false;
$dictionary['Contact']['fields']['lead_source']['default']='site_web';
$dictionary['Contact']['fields']['lead_source']['required']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_phone_other.php

 // created: 2018-01-23 15:30:45
$dictionary['Contact']['fields']['phone_other']['len']='100';
$dictionary['Contact']['fields']['phone_other']['audited']=false;
$dictionary['Contact']['fields']['phone_other']['massupdate']=false;
$dictionary['Contact']['fields']['phone_other']['comments']='Other phone number for the contact';
$dictionary['Contact']['fields']['phone_other']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['phone_other']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['phone_other']['merge_filter']='disabled';
$dictionary['Contact']['fields']['phone_other']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.07',
  'searchable' => true,
);
$dictionary['Contact']['fields']['phone_other']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_facebook.php

 // created: 2018-01-23 15:28:41
$dictionary['Contact']['fields']['facebook']['audited']=false;
$dictionary['Contact']['fields']['facebook']['massupdate']=false;
$dictionary['Contact']['fields']['facebook']['comments']='The facebook name of the user';
$dictionary['Contact']['fields']['facebook']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['facebook']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['facebook']['merge_filter']='disabled';
$dictionary['Contact']['fields']['facebook']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['facebook']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_consentement.php

 // created: 2018-01-25 16:57:40
$dictionary['Contact']['fields']['consentement']['name']='consentement';
$dictionary['Contact']['fields']['consentement']['vname']='LBL_CONSENTEMENT';
$dictionary['Contact']['fields']['consentement']['type']='bool';
$dictionary['Contact']['fields']['consentement']['massupdate']=false;
$dictionary['Contact']['fields']['consentement']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['consentement']['merge_filter']='enabled';
$dictionary['Contact']['fields']['consentement']['calculated']=false;
$dictionary['Contact']['fields']['consentement']['required']=false;
$dictionary['Contact']['fields']['consentement']['audited']=true;
$dictionary['Contact']['fields']['consentement']['importable']='true';
$dictionary['Contact']['fields']['consentement']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['consentement']['default']=false;
$dictionary['Contact']['fields']['consentement']['reportable']=false;
$dictionary['Contact']['fields']['consentement']['unified_search']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_mkto_sync.php

 // created: 2018-01-23 15:35:37
$dictionary['Contact']['fields']['mkto_sync']['default']=false;
$dictionary['Contact']['fields']['mkto_sync']['audited']=false;
$dictionary['Contact']['fields']['mkto_sync']['massupdate']=false;
$dictionary['Contact']['fields']['mkto_sync']['comments']='Should the Lead be synced to Marketo';
$dictionary['Contact']['fields']['mkto_sync']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['mkto_sync']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['mkto_sync']['merge_filter']='disabled';
$dictionary['Contact']['fields']['mkto_sync']['unified_search']=false;
$dictionary['Contact']['fields']['mkto_sync']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_mkto_id.php

 // created: 2018-01-23 15:35:50
$dictionary['Contact']['fields']['mkto_id']['audited']=false;
$dictionary['Contact']['fields']['mkto_id']['massupdate']=false;
$dictionary['Contact']['fields']['mkto_id']['comments']='Associated Marketo Lead ID';
$dictionary['Contact']['fields']['mkto_id']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['mkto_id']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['mkto_id']['merge_filter']='disabled';
$dictionary['Contact']['fields']['mkto_id']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['mkto_id']['calculated']=false;
$dictionary['Contact']['fields']['mkto_id']['enable_range_search']=false;
$dictionary['Contact']['fields']['mkto_id']['min']=false;
$dictionary['Contact']['fields']['mkto_id']['max']=false;
$dictionary['Contact']['fields']['mkto_id']['disable_num_format']='';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_email.php

 // created: 2018-01-24 12:47:01
$dictionary['Contact']['fields']['email']['len']='100';
$dictionary['Contact']['fields']['email']['required']=true;
$dictionary['Contact']['fields']['email']['audited']=false;
$dictionary['Contact']['fields']['email']['massupdate']=true;
$dictionary['Contact']['fields']['email']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['email']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['email']['merge_filter']='disabled';
$dictionary['Contact']['fields']['email']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.95',
  'searchable' => true,
);
$dictionary['Contact']['fields']['email']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_description.php

 // created: 2018-01-23 15:27:40
$dictionary['Contact']['fields']['description']['audited']=false;
$dictionary['Contact']['fields']['description']['massupdate']=false;
$dictionary['Contact']['fields']['description']['comments']='Full text of the note';
$dictionary['Contact']['fields']['description']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['description']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['description']['merge_filter']='disabled';
$dictionary['Contact']['fields']['description']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.71',
  'searchable' => true,
);
$dictionary['Contact']['fields']['description']['calculated']=false;
$dictionary['Contact']['fields']['description']['rows']='6';
$dictionary['Contact']['fields']['description']['cols']='80';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_primary_address_country.php

 // created: 2018-01-23 15:34:06
$dictionary['Contact']['fields']['primary_address_country']['audited']=false;
$dictionary['Contact']['fields']['primary_address_country']['massupdate']=false;
$dictionary['Contact']['fields']['primary_address_country']['comments']='Country for primary address';
$dictionary['Contact']['fields']['primary_address_country']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['primary_address_country']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['primary_address_country']['merge_filter']='disabled';
$dictionary['Contact']['fields']['primary_address_country']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['primary_address_country']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_title.php

 // created: 2018-01-23 15:28:33
$dictionary['Contact']['fields']['title']['audited']=false;
$dictionary['Contact']['fields']['title']['massupdate']=false;
$dictionary['Contact']['fields']['title']['comments']='The title of the contact';
$dictionary['Contact']['fields']['title']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['title']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['title']['merge_filter']='disabled';
$dictionary['Contact']['fields']['title']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['title']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_primary_address_city.php

 // created: 2018-01-23 15:33:43
$dictionary['Contact']['fields']['primary_address_city']['audited']=false;
$dictionary['Contact']['fields']['primary_address_city']['massupdate']=false;
$dictionary['Contact']['fields']['primary_address_city']['comments']='City for primary address';
$dictionary['Contact']['fields']['primary_address_city']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['primary_address_city']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['primary_address_city']['merge_filter']='disabled';
$dictionary['Contact']['fields']['primary_address_city']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['primary_address_city']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_do_not_call.php

 // created: 2018-01-23 15:30:01
$dictionary['Contact']['fields']['do_not_call']['default']=false;
$dictionary['Contact']['fields']['do_not_call']['audited']=false;
$dictionary['Contact']['fields']['do_not_call']['massupdate']=false;
$dictionary['Contact']['fields']['do_not_call']['comments']='An indicator of whether contact can be called';
$dictionary['Contact']['fields']['do_not_call']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['do_not_call']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['do_not_call']['merge_filter']='disabled';
$dictionary['Contact']['fields']['do_not_call']['unified_search']=false;
$dictionary['Contact']['fields']['do_not_call']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_preferred_language.php

 // created: 2018-01-23 14:49:51
$dictionary['Contact']['fields']['preferred_language']['name']='preferred_language';
$dictionary['Contact']['fields']['preferred_language']['vname']='LBL_PREFERRED_LANGUAGE';
$dictionary['Contact']['fields']['preferred_language']['type']='enum';
$dictionary['Contact']['fields']['preferred_language']['options']='preferred_language_dom';
$dictionary['Contact']['fields']['preferred_language']['massupdate']=false;
$dictionary['Contact']['fields']['preferred_language']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['preferred_language']['merge_filter']='enabled';
$dictionary['Contact']['fields']['preferred_language']['calculated']=false;
$dictionary['Contact']['fields']['preferred_language']['required']=true;
$dictionary['Contact']['fields']['preferred_language']['audited']=true;
$dictionary['Contact']['fields']['preferred_language']['importable']='true';
$dictionary['Contact']['fields']['preferred_language']['default']='francais';
$dictionary['Contact']['fields']['preferred_language']['duplicate_merge_dom_value']='2';

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_dsm_dnc_id.php


$dictionary['Contact']['fields']['dsm_dnc_id'] = array(
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
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_alt_address_city.php

 // created: 2018-01-23 15:34:21
$dictionary['Contact']['fields']['alt_address_city']['audited']=false;
$dictionary['Contact']['fields']['alt_address_city']['massupdate']=false;
$dictionary['Contact']['fields']['alt_address_city']['comments']='City for alternate address';
$dictionary['Contact']['fields']['alt_address_city']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['alt_address_city']['duplicate_merge_dom_value']='1';
$dictionary['Contact']['fields']['alt_address_city']['merge_filter']='disabled';
$dictionary['Contact']['fields']['alt_address_city']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Contact']['fields']['alt_address_city']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_statut_contact.php

 // created: 2018-01-23 15:38:12
$dictionary['Contact']['fields']['statut_contact']['name']='statut_contact';
$dictionary['Contact']['fields']['statut_contact']['vname']='LBL_STATUT_CONTACT';
$dictionary['Contact']['fields']['statut_contact']['type']='enum';
$dictionary['Contact']['fields']['statut_contact']['options']='statut_contact_dom';
$dictionary['Contact']['fields']['statut_contact']['massupdate']=false;
$dictionary['Contact']['fields']['statut_contact']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['statut_contact']['merge_filter']='enabled';
$dictionary['Contact']['fields']['statut_contact']['calculated']=false;
$dictionary['Contact']['fields']['statut_contact']['required']=true;
$dictionary['Contact']['fields']['statut_contact']['audited']=true;
$dictionary['Contact']['fields']['statut_contact']['importable']='true';
$dictionary['Contact']['fields']['statut_contact']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['statut_contact']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_source_details.php

 // created: 2018-01-23 18:05:59
$dictionary['Contact']['fields']['source_details']['name']='source_details';
$dictionary['Contact']['fields']['source_details']['vname']='LBL_SOURCE_DETAILS';
$dictionary['Contact']['fields']['source_details']['type']='enum';
$dictionary['Contact']['fields']['source_details']['massupdate']=true;
$dictionary['Contact']['fields']['source_details']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['source_details']['merge_filter']='enabled';
$dictionary['Contact']['fields']['source_details']['calculated']=false;
$dictionary['Contact']['fields']['source_details']['required']=true;
$dictionary['Contact']['fields']['source_details']['len']=100;
$dictionary['Contact']['fields']['source_details']['audited']=true;
$dictionary['Contact']['fields']['source_details']['importable']='true';
$dictionary['Contact']['fields']['source_details']['options']='source_details_dom';
$dictionary['Contact']['fields']['source_details']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['source_details']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_etat_de_proprietaire.php

 // created: 2018-01-23 15:39:21
$dictionary['Contact']['fields']['etat_de_proprietaire']['name']='etat_de_proprietaire';
$dictionary['Contact']['fields']['etat_de_proprietaire']['vname']='LBL_ETAT_DE_PROPRIÉTAIRE';
$dictionary['Contact']['fields']['etat_de_proprietaire']['type']='enum';
$dictionary['Contact']['fields']['etat_de_proprietaire']['massupdate']=true;
$dictionary['Contact']['fields']['etat_de_proprietaire']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['etat_de_proprietaire']['merge_filter']='enabled';
$dictionary['Contact']['fields']['etat_de_proprietaire']['calculated']=false;
$dictionary['Contact']['fields']['etat_de_proprietaire']['required']=true;
$dictionary['Contact']['fields']['etat_de_proprietaire']['len']=100;
$dictionary['Contact']['fields']['etat_de_proprietaire']['audited']=true;
$dictionary['Contact']['fields']['etat_de_proprietaire']['importable']='true';
$dictionary['Contact']['fields']['etat_de_proprietaire']['options']='owner_state_dom';
$dictionary['Contact']['fields']['etat_de_proprietaire']['duplicate_merge_dom_value']='2';
$dictionary['Contact']['fields']['etat_de_proprietaire']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Contacts/Ext/Vardefs/sugarfield_date_modified.php

 // created: 2018-01-23 15:27:34
$dictionary['Contact']['fields']['date_modified']['audited']=false;
$dictionary['Contact']['fields']['date_modified']['comments']='Date record last modified';
$dictionary['Contact']['fields']['date_modified']['duplicate_merge']='enabled';
$dictionary['Contact']['fields']['date_modified']['duplicate_merge_dom_value']=1;
$dictionary['Contact']['fields']['date_modified']['merge_filter']='disabled';
$dictionary['Contact']['fields']['date_modified']['calculated']=false;
$dictionary['Contact']['fields']['date_modified']['enable_range_search']='1';

 
?>
