<?php

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
