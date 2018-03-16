<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Administration/Ext/Administration/ops_modules.php


    $section_links = array(
        'Administration' => array(
            'ops_backups' => array(
                'DataSets',
                'LBL_OPS_BACKUPS',
                'LBL_OPS_BACKUPS_DESCRIPTION',
                'javascript:parent.SUGAR.App.router.navigate("ops_Backups", {trigger: true});',
            ),
        )
    );

    if (strpos($GLOBALS['sugar_version'], "7.5") === false) {
        $section_links['Administration']['ops_notification_settings'] = array(
            'Administration',
            'LBL_OPS_NOTIFICATION_SETTINGS_LINK_NAME',
            'LBL_OPS_NOTIFICATION_SETTINGS_LINK_DESCRIPTION',
            'javascript:parent.SUGAR.App.router.navigate("ops_Backups/config", {trigger: true});',
        );
    }

    $admin_group_header[] = array(
        //Section header label
        'LBL_OPS_ONDEMAND_SECTION_HEADER',
        //$other_text parameter for get_form_header()
        '',
        //$show_help parameter for get_form_header()
        false,
        //Section links
        $section_links,
        //Section description label
        'LBL_OPS_ONDEMAND_SECTION_DESCRIPTION'
    );

?>
<?php
// Merged from custom/Extension/modules/Administration/Ext/Administration/PortalConfig.php

$admin_option_defs = array();
$admin_option_defs['Administration']['portal_config'] = array(
    //Icon name. Available icons are located in ./themes/default/images
    'ConfigureCalendar',
    'LBL_APPOINTMENT_CONFIG',
    '',
    'javascript:parent.SUGAR.App.router.navigate("Home/layout/portal-config", {trigger: true})',
    // './index.php?module=Administration&layout=portal_config',
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

?>
