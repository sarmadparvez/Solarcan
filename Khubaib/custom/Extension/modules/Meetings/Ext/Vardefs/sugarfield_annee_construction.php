<?php
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