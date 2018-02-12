<?php
 // created: 2018-01-25 12:02:04
$dictionary['Opportunity']['fields']['annee_construction']['name']='annee_construction';
$dictionary['Opportunity']['fields']['annee_construction']['vname']='LBL_ANNEE_CONSTRUCTION';
$dictionary['Opportunity']['fields']['annee_construction']['type']='varchar';
$dictionary['Opportunity']['fields']['annee_construction']['dbType']='varchar';
$dictionary['Opportunity']['fields']['annee_construction']['massupdate']=false;
$dictionary['Opportunity']['fields']['annee_construction']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['annee_construction']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['annee_construction']['calculated']='true';
$dictionary['Opportunity']['fields']['annee_construction']['required']=true;
$dictionary['Opportunity']['fields']['annee_construction']['audited']=true;
$dictionary['Opportunity']['fields']['annee_construction']['importable']='false';
$dictionary['Opportunity']['fields']['annee_construction']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['annee_construction']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['annee_construction']['rows']='4';
$dictionary['Opportunity']['fields']['annee_construction']['cols']='20';
$dictionary['Opportunity']['fields']['annee_construction']['formula']='related($accounts,"annee_construction")';
$dictionary['Opportunity']['fields']['annee_construction']['enforced']=true;

 ?>