<?php
 // created: 2018-01-25 14:18:02
$dictionary['Meeting']['fields']['etat_de_proprietaire']['name']='etat_de_proprietaire';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['type']='varchar';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['vname']='LBL_ETAT_DE_PROPRIETAIRE';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['studio']='visible';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['audited']=false;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['massupdate']=false;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['duplicate_merge']='disabled';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['duplicate_merge_dom_value']=0;
$dictionary['Meeting']['fields']['etat_de_proprietaire']['merge_filter']='disabled';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['calculated']='true';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['importable']='false';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['full_text_search']=array (
  'enabled' => '0',
  'boost' => '1',
  'searchable' => false,
);
$dictionary['Meeting']['fields']['etat_de_proprietaire']['formula']='related($contacts,"etat_de_proprietaire")';
$dictionary['Meeting']['fields']['etat_de_proprietaire']['enforced']=true;

 ?>