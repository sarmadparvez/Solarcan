<?php
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