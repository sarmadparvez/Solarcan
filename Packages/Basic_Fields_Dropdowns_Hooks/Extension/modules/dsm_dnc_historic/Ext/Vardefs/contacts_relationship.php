<?php

$dictionary['dsm_dnc_historic']['fields']['contacts'] = array(
  	'name'          => 'contacts',
    'type'          => 'link',
    'relationship'  => 'contacts_dsm_dnc_historic',
    'module'        => 'Contact',
    'bean_name'     => 'Contacts',
    'source'        => 'non-db',
    'vname'         => 'LBL_CONTACTS',
);

$dictionary['dsm_dnc_historic']['relationships']['contacts_dsm_dnc_historic'] = array(
    'lhs_module'		=> 'Contacts',
    'lhs_table'			=> 'contacts',
    'lhs_key'			=> 'id',
    'rhs_module'		=> 'dsm_dnc_historic',
    'rhs_table'			=> 'dsm_dnc_historic',
    'rhs_key'			=> 'contact_id',
    'relationship_type'	=> 'one-to-many',
);
