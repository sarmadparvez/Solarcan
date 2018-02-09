<?php
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