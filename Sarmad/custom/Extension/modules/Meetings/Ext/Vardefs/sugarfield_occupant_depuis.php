<?php
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