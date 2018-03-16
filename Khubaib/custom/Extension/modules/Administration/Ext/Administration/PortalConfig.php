<?php
$admin_option_defs = array();
$admin_option_defs['Administration']['portal_config'] = array(
    //Icon name. Available icons are located in ./themes/default/images
    'ConfigureCalendar',
    'LBL_APPOINTMENT_CONFIG',
    '',
    'javascript:parent.SUGAR.App.router.navigate("Home/layout/portal-config", {trigger: true})',
);

$admin_group_header[] = array(
    //Section header label
    'LBL_APPOINTMENT_CONFIG',
    //$other_text parameter for get_form_header()
    '',
    //$show_help parameter for get_form_header()
    false,
    //Section links
    $admin_option_defs,
    //Section description label
    'LBL_APPOINTMENT_CONFIG_ATTR'
);
