<?php
$module_name = 'tm_telemarketers';
$viewdefs[$module_name] = 
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
            'label' => 'LBL_PANEL_1',
            'fields' => 
            array (
              0 => 
              array (
                'name' => 'noagent',
                'label' => 'LBL_NOAGENT',
                'enabled' => true,
                'default' => true,
                'link' => true,
              ),
              1 => 
              array (
                'name' => 'nom',
                'label' => 'LBL_NOM',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'prenom',
                'label' => 'LBL_PRENOM',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'notp',
                'label' => 'LBL_NOTP',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'nocallgen',
                'label' => 'LBL_NOCALLGEN',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'team',
                'label' => 'LBL_TEAM',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => true,
                'enabled' => true,
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              8 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => true,
              ),
              9 => 
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => true,
              ),
              10 => 
              array (
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => false,
                'enabled' => true,
                'link' => true,
              ),
            ),
          ),
        ),
        'orderBy' => 
        array (
          'field' => 'date_modified',
          'direction' => 'desc',
        ),
      ),
    ),
  ),
);
