<?php
 // created: 2018-02-20 16:37:30
$dictionary['Meeting']['fields']['location']['audited']=false;
$dictionary['Meeting']['fields']['location']['massupdate']=false;
$dictionary['Meeting']['fields']['location']['comments']='Meeting location';
$dictionary['Meeting']['fields']['location']['importable']='false';
$dictionary['Meeting']['fields']['location']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['location']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['location']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['location']['full_text_search']=array (
  'enabled' => true,
  'boost' => '0.36',
  'searchable' => true,
);
$dictionary['Meeting']['fields']['location']['calculated']='1';
$dictionary['Meeting']['fields']['location']['formula']='concat(related($accounts,"billing_address_street")," ",related($accounts,"billing_address_city")," ",related($accounts,"billing_address_state")," ",related($accounts,"billing_address_postalcode"))';
$dictionary['Meeting']['fields']['location']['enforced']=true;

 ?>