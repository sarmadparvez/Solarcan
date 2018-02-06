<?php

$dictionary['dsm_dnc_historic']['fields']['dsm_dnc'] = array(
  	'name'          => 'dsm_dnc',
    'type'          => 'link',
    'relationship'  => 'dsm_dnc_dsm_dnc_historic',
    'module'        => 'dsm_dnc',
    'bean_name'     => 'dsm_dnc',
    'source'        => 'non-db',
    'vname'         => 'LBL_DSM_DNC',
);

$dictionary['dsm_dnc_historic']['relationships']['dsm_dnc_dsm_dnc_historic'] = array(
    'lhs_module'		=> 'dsm_dnc',
    'lhs_table'			=> 'dsm_dnc',
    'lhs_key'			=> 'id',
    'rhs_module'		=> 'dsm_dnc_historic',
    'rhs_table'			=> 'dsm_dnc_historic',
    'rhs_key'			=> 'dsm_dnc_id',
    'relationship_type'	=> 'one-to-many',
);
