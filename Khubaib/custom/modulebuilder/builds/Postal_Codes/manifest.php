<?php
/*
 * Your installation or use of this SugarCRM file is subject to the applicable
 * terms available at
 * http://support.sugarcrm.com/Resources/Master_Subscription_Agreements/.
 * If you do not agree to all of the applicable terms or do not have the
 * authority to bind the entity as an authorized representative, then do not
 * install or use this SugarCRM file.
 *
 * Copyright (C) SugarCRM Inc. All rights reserved.
 */

// THIS CONTENT IS GENERATED BY MBPackage.php
$manifest = array (
  'built_in_version' => '7.10.2.0',
  'acceptable_sugar_versions' => 
  array (
    0 => '',
  ),
  'acceptable_sugar_flavors' => 
  array (
    0 => 'ENT',
    1 => 'ULT',
  ),
  'readme' => '',
  'key' => 'rt',
  'author' => '',
  'description' => '',
  'icon' => '',
  'is_uninstallable' => true,
  'name' => 'Postal_Codes',
  'published_date' => '2018-01-31 07:37:04',
  'type' => 'module',
  'version' => 1517384225,
  'remove_tables' => 'prompt',
);


$installdefs = array (
  'id' => 'Postal_Codes',
  'beans' => 
  array (
    0 => 
    array (
      'module' => 'rt_postal_codes',
      'class' => 'rt_postal_codes',
      'path' => 'modules/rt_postal_codes/rt_postal_codes.php',
      'tab' => true,
    ),
  ),
  'layoutdefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/rt_postal_codes_users_Users.php',
      'to_module' => 'Users',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/layoutdefs/rt_postal_codes_users_rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
    ),
  ),
  'relationships' => 
  array (
    0 => 
    array (
      'meta_data' => '<basepath>/SugarModules/relationships/relationships/rt_postal_codes_usersMetaData.php',
    ),
  ),
  'copy' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/modules/rt_postal_codes',
      'to' => 'modules/rt_postal_codes',
    ),
  ),
  'language' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'en_us',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'bg_BG',
    ),
    2 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'cs_CZ',
    ),
    3 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'da_DK',
    ),
    4 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'de_DE',
    ),
    5 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'el_EL',
    ),
    6 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'es_ES',
    ),
    7 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'fr_FR',
    ),
    8 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'he_IL',
    ),
    9 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'hu_HU',
    ),
    10 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'hr_HR',
    ),
    11 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'it_it',
    ),
    12 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'lt_LT',
    ),
    13 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ja_JP',
    ),
    14 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ko_KR',
    ),
    15 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'lv_LV',
    ),
    16 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'nb_NO',
    ),
    17 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'nl_NL',
    ),
    18 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'pl_PL',
    ),
    19 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'pt_PT',
    ),
    20 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ro_RO',
    ),
    21 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ru_RU',
    ),
    22 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'sv_SE',
    ),
    23 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'th_TH',
    ),
    24 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'tr_TR',
    ),
    25 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'zh_TW',
    ),
    26 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'zh_CN',
    ),
    27 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'pt_BR',
    ),
    28 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ca_ES',
    ),
    29 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'en_UK',
    ),
    30 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'sr_RS',
    ),
    31 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'sk_SK',
    ),
    32 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'sq_AL',
    ),
    33 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'et_EE',
    ),
    34 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'es_LA',
    ),
    35 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'fi_FI',
    ),
    36 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'ar_SA',
    ),
    37 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
      'language' => 'uk_UA',
    ),
    38 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_us',
    ),
    39 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'bg_BG',
    ),
    40 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'cs_CZ',
    ),
    41 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'da_DK',
    ),
    42 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'de_DE',
    ),
    43 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'el_EL',
    ),
    44 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_ES',
    ),
    45 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'fr_FR',
    ),
    46 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'he_IL',
    ),
    47 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hu_HU',
    ),
    48 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'hr_HR',
    ),
    49 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'it_it',
    ),
    50 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lt_LT',
    ),
    51 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ja_JP',
    ),
    52 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ko_KR',
    ),
    53 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'lv_LV',
    ),
    54 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nb_NO',
    ),
    55 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'nl_NL',
    ),
    56 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pl_PL',
    ),
    57 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_PT',
    ),
    58 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ro_RO',
    ),
    59 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ru_RU',
    ),
    60 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sv_SE',
    ),
    61 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'th_TH',
    ),
    62 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'tr_TR',
    ),
    63 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_TW',
    ),
    64 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'zh_CN',
    ),
    65 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'pt_BR',
    ),
    66 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ca_ES',
    ),
    67 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'en_UK',
    ),
    68 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sr_RS',
    ),
    69 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sk_SK',
    ),
    70 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'sq_AL',
    ),
    71 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'et_EE',
    ),
    72 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'es_LA',
    ),
    73 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'fi_FI',
    ),
    74 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'ar_SA',
    ),
    75 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/language/Users.php',
      'to_module' => 'Users',
      'language' => 'uk_UA',
    ),
    76 => 
    array (
      'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
      'to_module' => 'application',
      'language' => 'en_us',
    ),
  ),
  'sidecar' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/clients/base/layouts/subpanels/rt_postal_codes_users_rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/clients/mobile/layouts/subpanels/rt_postal_codes_users_rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
    ),
  ),
  'vardefs' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/rt_postal_codes_users_Users.php',
      'to_module' => 'Users',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/vardefs/rt_postal_codes_users_rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
    ),
  ),
  'wireless_subpanels' => 
  array (
    0 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/rt_postal_codes_users_Users.php',
      'to_module' => 'Users',
    ),
    1 => 
    array (
      'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/rt_postal_codes_users_rt_postal_codes.php',
      'to_module' => 'rt_postal_codes',
    ),
  ),
  'image_dir' => '<basepath>/icons',
);