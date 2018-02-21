<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_garage_achanger.php

 // created: 2018-01-24 12:44:48
$dictionary['Account']['fields']['nombre_garage_achanger']['name']='nombre_garage_achanger';
$dictionary['Account']['fields']['nombre_garage_achanger']['vname']='LBL_NOMBRE_GARAGE_ACHANGER';
$dictionary['Account']['fields']['nombre_garage_achanger']['type']='varchar';
$dictionary['Account']['fields']['nombre_garage_achanger']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_garage_achanger']['massupdate']=false;
$dictionary['Account']['fields']['nombre_garage_achanger']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_garage_achanger']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_garage_achanger']['calculated']=false;
$dictionary['Account']['fields']['nombre_garage_achanger']['required']=false;
$dictionary['Account']['fields']['nombre_garage_achanger']['audited']=true;
$dictionary['Account']['fields']['nombre_garage_achanger']['importable']='true';
$dictionary['Account']['fields']['nombre_garage_achanger']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_garage_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/rli_link_workflow.php

$dictionary['Account']['fields']['revenuelineitems']['workflow'] = true;
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_ticker_symbol.php

 // created: 2018-01-23 15:43:26
$dictionary['Account']['fields']['ticker_symbol']['len']='10';
$dictionary['Account']['fields']['ticker_symbol']['audited']=false;
$dictionary['Account']['fields']['ticker_symbol']['massupdate']=false;
$dictionary['Account']['fields']['ticker_symbol']['comments']='The stock trading (ticker) symbol for the company';
$dictionary['Account']['fields']['ticker_symbol']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['ticker_symbol']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['ticker_symbol']['merge_filter']='disabled';
$dictionary['Account']['fields']['ticker_symbol']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['ticker_symbol']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_account_type.php

 // created: 2018-01-23 15:41:48
$dictionary['Account']['fields']['account_type']['len']=100;
$dictionary['Account']['fields']['account_type']['audited']=false;
$dictionary['Account']['fields']['account_type']['massupdate']=true;
$dictionary['Account']['fields']['account_type']['comments']='The Company is of this type';
$dictionary['Account']['fields']['account_type']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['account_type']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['account_type']['merge_filter']='disabled';
$dictionary['Account']['fields']['account_type']['calculated']=false;
$dictionary['Account']['fields']['account_type']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_employees.php

 // created: 2018-01-23 15:43:21
$dictionary['Account']['fields']['employees']['len']='10';
$dictionary['Account']['fields']['employees']['audited']=false;
$dictionary['Account']['fields']['employees']['massupdate']=false;
$dictionary['Account']['fields']['employees']['comments']='Number of employees, varchar to accomodate for both number (100) or range (50-100)';
$dictionary['Account']['fields']['employees']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['employees']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['employees']['merge_filter']='disabled';
$dictionary['Account']['fields']['employees']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['employees']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_garage_total.php

 // created: 2018-01-24 11:12:48
$dictionary['Account']['fields']['nombre_garage_total']['name']='nombre_garage_total';
$dictionary['Account']['fields']['nombre_garage_total']['vname']='LBL_NOMBRE_GARAGE_TOTAL';
$dictionary['Account']['fields']['nombre_garage_total']['type']='varchar';
$dictionary['Account']['fields']['nombre_garage_total']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_garage_total']['massupdate']=false;
$dictionary['Account']['fields']['nombre_garage_total']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_garage_total']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_garage_total']['calculated']=false;
$dictionary['Account']['fields']['nombre_garage_total']['required']=true;
$dictionary['Account']['fields']['nombre_garage_total']['audited']=true;
$dictionary['Account']['fields']['nombre_garage_total']['importable']='true';
$dictionary['Account']['fields']['nombre_garage_total']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_garage_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_sic_code.php

 // created: 2018-01-23 15:44:07
$dictionary['Account']['fields']['sic_code']['len']='10';
$dictionary['Account']['fields']['sic_code']['audited']=false;
$dictionary['Account']['fields']['sic_code']['massupdate']=false;
$dictionary['Account']['fields']['sic_code']['comments']='SIC code of the account';
$dictionary['Account']['fields']['sic_code']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['sic_code']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['sic_code']['merge_filter']='disabled';
$dictionary['Account']['fields']['sic_code']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.21',
  'searchable' => true,
);
$dictionary['Account']['fields']['sic_code']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_deleted.php

 // created: 2018-01-23 15:41:25
$dictionary['Account']['fields']['deleted']['default']=false;
$dictionary['Account']['fields']['deleted']['audited']=false;
$dictionary['Account']['fields']['deleted']['massupdate']=false;
$dictionary['Account']['fields']['deleted']['comments']='Record deletion indicator';
$dictionary['Account']['fields']['deleted']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['deleted']['duplicate_merge_dom_value']=1;
$dictionary['Account']['fields']['deleted']['merge_filter']='disabled';
$dictionary['Account']['fields']['deleted']['reportable']=true;
$dictionary['Account']['fields']['deleted']['unified_search']=false;
$dictionary['Account']['fields']['deleted']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_shipping_address_state.php

 // created: 2018-01-23 15:43:46
$dictionary['Account']['fields']['shipping_address_state']['len']='100';
$dictionary['Account']['fields']['shipping_address_state']['audited']=false;
$dictionary['Account']['fields']['shipping_address_state']['massupdate']=false;
$dictionary['Account']['fields']['shipping_address_state']['comments']='The state used for the shipping address';
$dictionary['Account']['fields']['shipping_address_state']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['shipping_address_state']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['shipping_address_state']['merge_filter']='disabled';
$dictionary['Account']['fields']['shipping_address_state']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['shipping_address_state']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_name.php

 // created: 2018-02-02 16:32:51
$dictionary['Account']['fields']['name']['len']='150';
$dictionary['Account']['fields']['name']['audited']=false;
$dictionary['Account']['fields']['name']['massupdate']=false;
$dictionary['Account']['fields']['name']['comments']='Name of the Company';
$dictionary['Account']['fields']['name']['duplicate_merge']='disabled';
$dictionary['Account']['fields']['name']['duplicate_merge_dom_value']=0;
$dictionary['Account']['fields']['name']['merge_filter']='disabled';
$dictionary['Account']['fields']['name']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.91',
  'searchable' => true,
);
$dictionary['Account']['fields']['name']['calculated']='true';
$dictionary['Account']['fields']['name']['importable']='false';
$dictionary['Account']['fields']['name']['formula']='concat($billing_address_street," ",$billing_address_city," ",$billing_address_postalcode)';
$dictionary['Account']['fields']['name']['enforced']=true;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_ownership.php

 // created: 2018-01-23 15:43:14
$dictionary['Account']['fields']['ownership']['len']='100';
$dictionary['Account']['fields']['ownership']['audited']=false;
$dictionary['Account']['fields']['ownership']['massupdate']=false;
$dictionary['Account']['fields']['ownership']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['ownership']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['ownership']['merge_filter']='disabled';
$dictionary['Account']['fields']['ownership']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['ownership']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_portes_total.php

 // created: 2018-01-24 11:13:14
$dictionary['Account']['fields']['nombre_portes_total']['name']='nombre_portes_total';
$dictionary['Account']['fields']['nombre_portes_total']['vname']='LBL_NOMBRE_PORTES_TOTAL';
$dictionary['Account']['fields']['nombre_portes_total']['type']='varchar';
$dictionary['Account']['fields']['nombre_portes_total']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_portes_total']['massupdate']=false;
$dictionary['Account']['fields']['nombre_portes_total']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_portes_total']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_portes_total']['calculated']=false;
$dictionary['Account']['fields']['nombre_portes_total']['required']=true;
$dictionary['Account']['fields']['nombre_portes_total']['audited']=true;
$dictionary['Account']['fields']['nombre_portes_total']['importable']='true';
$dictionary['Account']['fields']['nombre_portes_total']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_portes_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_annee_construction.php

 // created: 2018-01-24 11:09:54
$dictionary['Account']['fields']['annee_construction']['name']='annee_construction';
$dictionary['Account']['fields']['annee_construction']['vname']='LBL_ANNEE_CONSTRUCTION';
$dictionary['Account']['fields']['annee_construction']['type']='varchar';
$dictionary['Account']['fields']['annee_construction']['dbType']='varchar';
$dictionary['Account']['fields']['annee_construction']['massupdate']=false;
$dictionary['Account']['fields']['annee_construction']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['annee_construction']['merge_filter']='enabled';
$dictionary['Account']['fields']['annee_construction']['calculated']=false;
$dictionary['Account']['fields']['annee_construction']['required']=true;
$dictionary['Account']['fields']['annee_construction']['audited']=true;
$dictionary['Account']['fields']['annee_construction']['importable']='true';
$dictionary['Account']['fields']['annee_construction']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['annee_construction']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_phone_alternate.php

 // created: 2018-01-23 15:43:07
$dictionary['Account']['fields']['phone_alternate']['len']='100';
$dictionary['Account']['fields']['phone_alternate']['audited']=false;
$dictionary['Account']['fields']['phone_alternate']['massupdate']=false;
$dictionary['Account']['fields']['phone_alternate']['comments']='An alternate phone number';
$dictionary['Account']['fields']['phone_alternate']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['phone_alternate']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['phone_alternate']['merge_filter']='disabled';
$dictionary['Account']['fields']['phone_alternate']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.03',
  'searchable' => true,
);
$dictionary['Account']['fields']['phone_alternate']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_duns_num.php

 // created: 2018-01-23 15:44:12
$dictionary['Account']['fields']['duns_num']['len']='15';
$dictionary['Account']['fields']['duns_num']['audited']=false;
$dictionary['Account']['fields']['duns_num']['massupdate']=false;
$dictionary['Account']['fields']['duns_num']['comments']='DUNS number of the account';
$dictionary['Account']['fields']['duns_num']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['duns_num']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['duns_num']['merge_filter']='disabled';
$dictionary['Account']['fields']['duns_num']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.23',
  'searchable' => true,
);
$dictionary['Account']['fields']['duns_num']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_annual_revenue.php

 // created: 2018-01-23 15:42:02
$dictionary['Account']['fields']['annual_revenue']['len']='100';
$dictionary['Account']['fields']['annual_revenue']['audited']=false;
$dictionary['Account']['fields']['annual_revenue']['massupdate']=false;
$dictionary['Account']['fields']['annual_revenue']['comments']='Annual revenue for this company';
$dictionary['Account']['fields']['annual_revenue']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['annual_revenue']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['annual_revenue']['merge_filter']='disabled';
$dictionary['Account']['fields']['annual_revenue']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['annual_revenue']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_phone_fax.php

 // created: 2018-01-23 15:33:09
$dictionary['Account']['fields']['phone_fax']['len']='100';
$dictionary['Account']['fields']['phone_fax']['audited']=false;
$dictionary['Account']['fields']['phone_fax']['massupdate']=false;
$dictionary['Account']['fields']['phone_fax']['comments']='The fax phone number of this company';
$dictionary['Account']['fields']['phone_fax']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['phone_fax']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['phone_fax']['merge_filter']='disabled';
$dictionary['Account']['fields']['phone_fax']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.04',
  'searchable' => true,
);
$dictionary['Account']['fields']['phone_fax']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_shipping_address_country.php

 // created: 2018-01-23 15:44:02
$dictionary['Account']['fields']['shipping_address_country']['audited']=false;
$dictionary['Account']['fields']['shipping_address_country']['massupdate']=false;
$dictionary['Account']['fields']['shipping_address_country']['comments']='The country used for the shipping address';
$dictionary['Account']['fields']['shipping_address_country']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['shipping_address_country']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['shipping_address_country']['merge_filter']='disabled';
$dictionary['Account']['fields']['shipping_address_country']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['shipping_address_country']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_date_entered.php

 // created: 2018-01-23 15:41:11
$dictionary['Account']['fields']['date_entered']['audited']=false;
$dictionary['Account']['fields']['date_entered']['comments']='Date record created';
$dictionary['Account']['fields']['date_entered']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['date_entered']['duplicate_merge_dom_value']=1;
$dictionary['Account']['fields']['date_entered']['merge_filter']='disabled';
$dictionary['Account']['fields']['date_entered']['calculated']=false;
$dictionary['Account']['fields']['date_entered']['enable_range_search']='1';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_shipping_address_street.php

 // created: 2018-01-23 15:43:33
$dictionary['Account']['fields']['shipping_address_street']['audited']=false;
$dictionary['Account']['fields']['shipping_address_street']['massupdate']=false;
$dictionary['Account']['fields']['shipping_address_street']['comments']='The street address used for for shipping purposes';
$dictionary['Account']['fields']['shipping_address_street']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['shipping_address_street']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['shipping_address_street']['merge_filter']='disabled';
$dictionary['Account']['fields']['shipping_address_street']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.34',
  'searchable' => true,
);
$dictionary['Account']['fields']['shipping_address_street']['calculated']=false;
$dictionary['Account']['fields']['shipping_address_street']['rows']='4';
$dictionary['Account']['fields']['shipping_address_street']['cols']='20';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_date_modified.php

 // created: 2018-01-23 15:41:15
$dictionary['Account']['fields']['date_modified']['audited']=false;
$dictionary['Account']['fields']['date_modified']['comments']='Date record last modified';
$dictionary['Account']['fields']['date_modified']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['date_modified']['duplicate_merge_dom_value']=1;
$dictionary['Account']['fields']['date_modified']['merge_filter']='disabled';
$dictionary['Account']['fields']['date_modified']['calculated']=false;
$dictionary['Account']['fields']['date_modified']['enable_range_search']='1';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_rating.php

 // created: 2018-01-23 15:42:45
$dictionary['Account']['fields']['rating']['len']='100';
$dictionary['Account']['fields']['rating']['audited']=false;
$dictionary['Account']['fields']['rating']['massupdate']=false;
$dictionary['Account']['fields']['rating']['comments']='An arbitrary rating for this company for use in comparisons with others';
$dictionary['Account']['fields']['rating']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['rating']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['rating']['merge_filter']='disabled';
$dictionary['Account']['fields']['rating']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['rating']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_fenetres_total.php

 // created: 2018-01-24 11:12:20
$dictionary['Account']['fields']['nombre_fenetres_total']['name']='nombre_fenetres_total';
$dictionary['Account']['fields']['nombre_fenetres_total']['vname']='LBL_NOMBRE_FENETRES_TOTAL';
$dictionary['Account']['fields']['nombre_fenetres_total']['type']='varchar';
$dictionary['Account']['fields']['nombre_fenetres_total']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_fenetres_total']['massupdate']=false;
$dictionary['Account']['fields']['nombre_fenetres_total']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_fenetres_total']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_fenetres_total']['calculated']=false;
$dictionary['Account']['fields']['nombre_fenetres_total']['required']=true;
$dictionary['Account']['fields']['nombre_fenetres_total']['audited']=true;
$dictionary['Account']['fields']['nombre_fenetres_total']['importable']='true';
$dictionary['Account']['fields']['nombre_fenetres_total']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_fenetres_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_fenetres_achanger.php

 // created: 2018-01-24 11:10:09
$dictionary['Account']['fields']['nombre_fenetres_achanger']['name']='nombre_fenetres_achanger';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['vname']='LBL_NOMBRE_FENETRES_ACHANGER';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['type']='varchar';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['massupdate']=false;
$dictionary['Account']['fields']['nombre_fenetres_achanger']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['calculated']=false;
$dictionary['Account']['fields']['nombre_fenetres_achanger']['required']=false;
$dictionary['Account']['fields']['nombre_fenetres_achanger']['audited']=true;
$dictionary['Account']['fields']['nombre_fenetres_achanger']['importable']='true';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_fenetres_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_website.php

 // created: 2018-01-23 15:43:03
$dictionary['Account']['fields']['website']['len']='255';
$dictionary['Account']['fields']['website']['audited']=false;
$dictionary['Account']['fields']['website']['massupdate']=false;
$dictionary['Account']['fields']['website']['comments']='URL of website for the company';
$dictionary['Account']['fields']['website']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['website']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['website']['merge_filter']='disabled';
$dictionary['Account']['fields']['website']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['website']['calculated']=false;
$dictionary['Account']['fields']['website']['gen']='';
$dictionary['Account']['fields']['website']['link_target']='_self';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_twitter.php

 // created: 2018-01-23 15:41:36
$dictionary['Account']['fields']['twitter']['audited']=false;
$dictionary['Account']['fields']['twitter']['massupdate']=false;
$dictionary['Account']['fields']['twitter']['comments']='The twitter name of the company';
$dictionary['Account']['fields']['twitter']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['twitter']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['twitter']['merge_filter']='disabled';
$dictionary['Account']['fields']['twitter']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['twitter']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_phone_office.php

 // created: 2018-01-23 15:42:51
$dictionary['Account']['fields']['phone_office']['len']='100';
$dictionary['Account']['fields']['phone_office']['audited']=false;
$dictionary['Account']['fields']['phone_office']['massupdate']=false;
$dictionary['Account']['fields']['phone_office']['comments']='The office phone number';
$dictionary['Account']['fields']['phone_office']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['phone_office']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['phone_office']['merge_filter']='disabled';
$dictionary['Account']['fields']['phone_office']['full_text_search']=array (
  'enabled' => true,
  'boost' => '1.05',
  'searchable' => true,
);
$dictionary['Account']['fields']['phone_office']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_googleplus.php

 // created: 2018-01-23 15:41:42
$dictionary['Account']['fields']['googleplus']['audited']=false;
$dictionary['Account']['fields']['googleplus']['massupdate']=false;
$dictionary['Account']['fields']['googleplus']['comments']='The Google Plus name of the company';
$dictionary['Account']['fields']['googleplus']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['googleplus']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['googleplus']['merge_filter']='disabled';
$dictionary['Account']['fields']['googleplus']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['googleplus']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_description.php

 // created: 2018-01-23 15:41:20
$dictionary['Account']['fields']['description']['audited']=false;
$dictionary['Account']['fields']['description']['massupdate']=false;
$dictionary['Account']['fields']['description']['comments']='Full text of the note';
$dictionary['Account']['fields']['description']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['description']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['description']['merge_filter']='disabled';
$dictionary['Account']['fields']['description']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.72',
  'searchable' => true,
);
$dictionary['Account']['fields']['description']['calculated']=false;
$dictionary['Account']['fields']['description']['rows']='6';
$dictionary['Account']['fields']['description']['cols']='80';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_nombre_portes_achanger.php

 // created: 2018-01-24 11:13:02
$dictionary['Account']['fields']['nombre_portes_achanger']['name']='nombre_portes_achanger';
$dictionary['Account']['fields']['nombre_portes_achanger']['vname']='LBL_NOMBRE_PORTES_ACHANGER';
$dictionary['Account']['fields']['nombre_portes_achanger']['type']='varchar';
$dictionary['Account']['fields']['nombre_portes_achanger']['dbType']='varchar';
$dictionary['Account']['fields']['nombre_portes_achanger']['massupdate']=false;
$dictionary['Account']['fields']['nombre_portes_achanger']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['nombre_portes_achanger']['merge_filter']='enabled';
$dictionary['Account']['fields']['nombre_portes_achanger']['calculated']=false;
$dictionary['Account']['fields']['nombre_portes_achanger']['required']=false;
$dictionary['Account']['fields']['nombre_portes_achanger']['audited']=true;
$dictionary['Account']['fields']['nombre_portes_achanger']['importable']='true';
$dictionary['Account']['fields']['nombre_portes_achanger']['duplicate_merge_dom_value']='2';
$dictionary['Account']['fields']['nombre_portes_achanger']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_shipping_address_city.php

 // created: 2018-01-23 15:43:41
$dictionary['Account']['fields']['shipping_address_city']['len']='100';
$dictionary['Account']['fields']['shipping_address_city']['audited']=false;
$dictionary['Account']['fields']['shipping_address_city']['massupdate']=false;
$dictionary['Account']['fields']['shipping_address_city']['comments']='The city used for the shipping address';
$dictionary['Account']['fields']['shipping_address_city']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['shipping_address_city']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['shipping_address_city']['merge_filter']='disabled';
$dictionary['Account']['fields']['shipping_address_city']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['shipping_address_city']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_shipping_address_postalcode.php

 // created: 2018-01-23 15:43:56
$dictionary['Account']['fields']['shipping_address_postalcode']['len']='20';
$dictionary['Account']['fields']['shipping_address_postalcode']['audited']=false;
$dictionary['Account']['fields']['shipping_address_postalcode']['massupdate']=false;
$dictionary['Account']['fields']['shipping_address_postalcode']['comments']='The zip code used for the shipping address';
$dictionary['Account']['fields']['shipping_address_postalcode']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['shipping_address_postalcode']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['shipping_address_postalcode']['merge_filter']='disabled';
$dictionary['Account']['fields']['shipping_address_postalcode']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['shipping_address_postalcode']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_facebook.php

 // created: 2018-01-23 15:41:30
$dictionary['Account']['fields']['facebook']['audited']=false;
$dictionary['Account']['fields']['facebook']['massupdate']=false;
$dictionary['Account']['fields']['facebook']['comments']='The facebook name of the company';
$dictionary['Account']['fields']['facebook']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['facebook']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['facebook']['merge_filter']='disabled';
$dictionary['Account']['fields']['facebook']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['facebook']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_industry.php

 // created: 2018-01-23 15:41:57
$dictionary['Account']['fields']['industry']['len']=100;
$dictionary['Account']['fields']['industry']['audited']=false;
$dictionary['Account']['fields']['industry']['massupdate']=true;
$dictionary['Account']['fields']['industry']['comments']='The company belongs in this industry';
$dictionary['Account']['fields']['industry']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['industry']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['industry']['merge_filter']='disabled';
$dictionary['Account']['fields']['industry']['calculated']=false;
$dictionary['Account']['fields']['industry']['dependency']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_billing_address_street.php

 // created: 2018-02-20 15:05:16
$dictionary['Account']['fields']['billing_address_street']['audited']=false;
$dictionary['Account']['fields']['billing_address_street']['massupdate']=false;
$dictionary['Account']['fields']['billing_address_street']['comments']='The street address used for billing address';
$dictionary['Account']['fields']['billing_address_street']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['billing_address_street']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['billing_address_street']['merge_filter']='disabled';
$dictionary['Account']['fields']['billing_address_street']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.35',
  'searchable' => true,
);
$dictionary['Account']['fields']['billing_address_street']['calculated']=false;
$dictionary['Account']['fields']['billing_address_street']['rows']='4';
$dictionary['Account']['fields']['billing_address_street']['cols']='20';

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_billing_address_city.php

 // created: 2018-02-20 15:05:26
$dictionary['Account']['fields']['billing_address_city']['audited']=false;
$dictionary['Account']['fields']['billing_address_city']['massupdate']=false;
$dictionary['Account']['fields']['billing_address_city']['comments']='The city used for billing address';
$dictionary['Account']['fields']['billing_address_city']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['billing_address_city']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['billing_address_city']['merge_filter']='disabled';
$dictionary['Account']['fields']['billing_address_city']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['billing_address_city']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_billing_address_state.php

 // created: 2018-02-20 15:05:35
$dictionary['Account']['fields']['billing_address_state']['audited']=false;
$dictionary['Account']['fields']['billing_address_state']['massupdate']=false;
$dictionary['Account']['fields']['billing_address_state']['comments']='The state used for billing address';
$dictionary['Account']['fields']['billing_address_state']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['billing_address_state']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['billing_address_state']['merge_filter']='disabled';
$dictionary['Account']['fields']['billing_address_state']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['billing_address_state']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_billing_address_postalcode.php

 // created: 2018-02-20 15:05:46
$dictionary['Account']['fields']['billing_address_postalcode']['audited']=false;
$dictionary['Account']['fields']['billing_address_postalcode']['massupdate']=false;
$dictionary['Account']['fields']['billing_address_postalcode']['comments']='The postal code used for billing address';
$dictionary['Account']['fields']['billing_address_postalcode']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['billing_address_postalcode']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['billing_address_postalcode']['merge_filter']='disabled';
$dictionary['Account']['fields']['billing_address_postalcode']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['billing_address_postalcode']['calculated']=false;

 
?>
<?php
// Merged from custom/Extension/modules/Accounts/Ext/Vardefs/sugarfield_billing_address_country.php

 // created: 2018-02-20 15:05:57
$dictionary['Account']['fields']['billing_address_country']['audited']=false;
$dictionary['Account']['fields']['billing_address_country']['massupdate']=false;
$dictionary['Account']['fields']['billing_address_country']['comments']='The country used for the billing address';
$dictionary['Account']['fields']['billing_address_country']['duplicate_merge']='enabled';
$dictionary['Account']['fields']['billing_address_country']['duplicate_merge_dom_value']='1';
$dictionary['Account']['fields']['billing_address_country']['merge_filter']='disabled';
$dictionary['Account']['fields']['billing_address_country']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Account']['fields']['billing_address_country']['calculated']=false;
$dictionary['Account']['fields']['billing_address_country']['default']='Canada';

 
?>
