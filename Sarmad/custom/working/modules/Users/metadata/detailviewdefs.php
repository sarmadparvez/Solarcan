<?php
$viewdefs['Users'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'form' => 
      array (
        'headerTpl' => 'modules/Users/tpls/DetailViewHeader.tpl',
        'footerTpl' => 'modules/Users/tpls/DetailViewFooter.tpl',
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_USER_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EDITVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
        'LBL_EMPLOYEE_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'LBL_USER_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 'user_name',
          1 => 
          array (
            'name' => 'first_name',
            'label' => 'LBL_FIRST_NAME',
          ),
        ),
        1 => 
        array (
          0 => 'status',
          1 => 
          array (
            'name' => 'last_name',
            'label' => 'LBL_LAST_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'UserType',
            'customCode' => '{$USER_TYPE_READONLY}',
          ),
        ),
        3 => 
        array (
          0 => 'picture',
        ),
      ),
      'lbl_editview_panel1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'adresse_rep',
            'label' => 'LBL_ADRESSE_REP',
          ),
          1 => 
          array (
            'name' => 'ville_rep',
            'label' => 'LBL_VILLE_REP',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'prenom_rep',
            'label' => 'LBL_PRENOM_REP',
          ),
          1 => 
          array (
            'name' => 'nom_rep',
            'label' => 'LBL_NOM_REP',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'cellulaire_rep',
            'label' => 'LBL_CELLULAIRE_REP',
          ),
          1 => 
          array (
            'name' => 'fax_rep',
            'label' => 'LBL_FAX_REP',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'codecie_rep_c',
            'label' => 'LBL_CODECIE_REP_C',
          ),
          1 => 
          array (
            'name' => 'codelangue_rep',
            'label' => 'LBL_CODELANGUE_REP',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'courriel_rep',
            'label' => 'LBL_COURRIEL_REP',
          ),
          1 => 
          array (
            'name' => 'pager_rep',
            'label' => 'LBL_PAGER_REP',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'novendeur_rep',
            'label' => 'LBL_NOVENDEUR_REP',
          ),
          1 => 
          array (
            'name' => 'nosolarcan_rep',
            'label' => 'LBL_NOSOLARCAN_REP',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'secteur_rep',
            'label' => 'LBL_SECTEUR_REP',
          ),
          1 => 
          array (
            'name' => 'telres_rep',
            'label' => 'LBL_TELRES_REP',
          ),
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'qualified_doors_rep_c',
            'label' => 'LBL_QUALIFIED_DOORS_REP_C',
          ),
          1 => 
          array (
            'name' => 'qualified_windows_rep_c',
            'label' => 'LBL_QUALIFIED_WINDOWS_REP_C',
          ),
        ),
        8 => 
        array (
          0 => 
          array (
            'name' => 'qualified_garage_rep_c',
            'label' => 'LBL_QUALIFIED_GARAGE_REP_C',
          ),
        ),
      ),
      'LBL_EMPLOYEE_INFORMATION' => 
      array (
        0 => 
        array (
          0 => 'employee_status',
          1 => 'show_on_employees',
        ),
        1 => 
        array (
          0 => 'title',
          1 => 'phone_work',
        ),
        2 => 
        array (
          0 => 'department',
          1 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 'reports_to_name',
          1 => 'phone_other',
        ),
        4 => 
        array (
          0 => '',
          1 => 'phone_fax',
        ),
        5 => 
        array (
          0 => '',
          1 => 'phone_home',
        ),
        6 => 
        array (
          0 => 'messenger_type',
          1 => 'messenger_id',
        ),
        7 => 
        array (
          0 => 'address_street',
          1 => 'address_city',
        ),
        8 => 
        array (
          0 => 'address_state',
          1 => 'address_postalcode',
        ),
        9 => 
        array (
          0 => 'address_country',
        ),
        10 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
