<?php
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