<?php
$viewdefs['Accounts'] = 
array (
  'base' => 
  array (
    'view' => 
    array (
      'list' => 
      array (
        'panels' => 
        array (
          0 => 
          array (
            'name' => 'panel_header',
            'label' => 'LBL_PANEL_1',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'name',
                'link' => true,
                'label' => 'LBL_LIST_ACCOUNT_NAME',
                'enabled' => true,
                'default' => true,
                'width' => 'xlarge',
              ),
              1 => 
              array (
                'name' => 'billing_address_street',
                'label' => 'LBL_BILLING_ADDRESS_STREET',
                'enabled' => true,
                'sortable' => false,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'billing_address_city',
                'label' => 'LBL_LIST_CITY',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'billing_address_state',
                'label' => 'LBL_BILLING_ADDRESS_STATE',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'billing_address_postalcode',
                'label' => 'LBL_BILLING_ADDRESS_POSTALCODE',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'billing_address_country',
                'label' => 'LBL_BILLING_ADDRESS_COUNTRY',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => true,
              ),
              7 => 
              array (
                'name' => 'date_entered',
                'type' => 'datetime',
                'label' => 'LBL_DATE_ENTERED',
                'enabled' => true,
                'default' => true,
                'readonly' => true,
              ),
            ),
          ),
        ),
      ),
    ),
  ),
);
