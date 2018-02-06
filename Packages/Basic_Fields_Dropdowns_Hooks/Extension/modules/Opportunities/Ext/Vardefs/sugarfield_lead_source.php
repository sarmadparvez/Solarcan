<?php
 // created: 2018-01-25 14:14:37
$dictionary['Opportunity']['fields']['lead_source']['type']='varchar';
$dictionary['Opportunity']['fields']['lead_source']['len']='100';
$dictionary['Opportunity']['fields']['lead_source']['required']=false;
$dictionary['Opportunity']['fields']['lead_source']['audited']=false;
$dictionary['Opportunity']['fields']['lead_source']['massupdate']=false;
$dictionary['Opportunity']['fields']['lead_source']['comments']='Source of the opportunity';
$dictionary['Opportunity']['fields']['lead_source']['duplicate_merge']='disabled';
$dictionary['Opportunity']['fields']['lead_source']['duplicate_merge_dom_value']=0;
$dictionary['Opportunity']['fields']['lead_source']['merge_filter']='disabled';
$dictionary['Opportunity']['fields']['lead_source']['calculated']='true';
$dictionary['Opportunity']['fields']['lead_source']['options']='';
$dictionary['Opportunity']['fields']['lead_source']['importable']='false';
$dictionary['Opportunity']['fields']['lead_source']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Opportunity']['fields']['lead_source']['formula']='related($contacts,"source")';
$dictionary['Opportunity']['fields']['lead_source']['enforced']=true;

 ?>