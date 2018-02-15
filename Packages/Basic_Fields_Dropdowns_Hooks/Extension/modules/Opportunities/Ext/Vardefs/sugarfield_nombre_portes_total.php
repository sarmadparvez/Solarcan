<?php
 // created: 2018-01-25 12:05:38
$dictionary['Opportunity']['fields']['nombre_portes_total']['name']='nombre_portes_total';
$dictionary['Opportunity']['fields']['nombre_portes_total']['vname']='LBL_NOMBRE_PORTES_TOTAL';
$dictionary['Opportunity']['fields']['nombre_portes_total']['type']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_total']['dbType']='varchar';
$dictionary['Opportunity']['fields']['nombre_portes_total']['massupdate']=false;
$dictionary['Opportunity']['fields']['nombre_portes_total']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_total']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['nombre_portes_total']['calculated']='true';
$dictionary['Opportunity']['fields']['nombre_portes_total']['required']=true;
$dictionary['Opportunity']['fields']['nombre_portes_total']['audited']=true;
$dictionary['Opportunity']['fields']['nombre_portes_total']['importable']='false';
$dictionary['Opportunity']['fields']['nombre_portes_total']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['nombre_portes_total']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['nombre_portes_total']['formula']='related($accounts,"nombre_portes_total")';
$dictionary['Opportunity']['fields']['nombre_portes_total']['enforced']=true;

 ?>