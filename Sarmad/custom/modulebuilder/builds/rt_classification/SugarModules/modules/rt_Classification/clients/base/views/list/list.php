<?php
$module_name = 'rt_Classification';
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
                'name' => 'name',
                'label' => 'LBL_NAME',
                'default' => true,
                'enabled' => true,
                'link' => true,
              ),
              1 => 
              array (
                'name' => 'efficiency',
                'label' => 'LBL_EFFICIENCY',
                'enabled' => true,
                'default' => true,
              ),
              2 => 
              array (
                'name' => 'appointment_per_day',
                'label' => 'LBL_APPOINTMENT_PER_DAY',
                'enabled' => true,
                'default' => true,
              ),
              3 => 
              array (
                'name' => 'min_appointment_per_week',
                'label' => 'LBL_MIN_APPOINTMENT_PER_WEEK',
                'enabled' => true,
                'default' => true,
              ),
              4 => 
              array (
                'name' => 'max_appointment_per_week',
                'label' => 'LBL_MAX_APPOINTMENT_PER_WEEK',
                'enabled' => true,
                'default' => true,
              ),
              5 => 
              array (
                'name' => 'surplus_appointment_count',
                'label' => 'LBL_SURPLUS_APPOINTMENT_COUNT',
                'enabled' => true,
                'default' => true,
              ),
              6 => 
              array (
                'name' => 'team_name',
                'label' => 'LBL_TEAM',
                'default' => false,
                'enabled' => true,
              ),
              7 => 
              array (
                'name' => 'assigned_user_name',
                'label' => 'LBL_ASSIGNED_TO_NAME',
                'default' => false,
                'enabled' => true,
                'link' => true,
              ),
              8 => 
              array (
                'name' => 'date_modified',
                'enabled' => true,
                'default' => false,
              ),
              9 => 
              array (
                'name' => 'date_entered',
                'enabled' => true,
                'default' => false,
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
