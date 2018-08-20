<?php
require_once 'modules/Configurator/Configurator.php';

function post_install()
{
    $configuratorObj = new Configurator();
    //Load config
    $configuratorObj->loadConfig();
    //Update a specific setting
    $configuratorObj->config['additional_js_config']['appointment_timeslots'] = array(
        'regular_case' => array(
            'AM2' => array(
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
            ),
            'PM1' => array(
                'start_time' => '13:30:00',
                'end_time' => '15:30:00',
            ),
            'PM2' => array(
                'start_time' => '16:00:00',
                'end_time' => '18:00:00',
            ),
            'SOIR1' => array(
                'start_time' => '18:30:00',
                'end_time' => '20:30:00',
            ),
            'SOIR2' => array(
                'start_time' => '20:30:00',
                'end_time' => '22:30:00',
            ),
        ),
        'special_case' => array(
            'AM2' => array(
                'start_time' => '09:30:00',
                'end_time' => '11:30:00',
            ),
            'PM1' => array(
                'start_time' => '12:30:00',
                'end_time' => '14:30:00',
            ),
            'PM2' => array(
                'start_time' => '15:00:00',
                'end_time' => '17:00:00',
            ),
        )
    );
    // add config for bulk import
    $configuratorObj->config['search_engine']['force_async_index'] = true;
    $configuratorObj->config['bulk_import_settings']['modules']['Calls']['sugar_key_field'] = 'voxco_middleware_id';
    $configuratorObj->config['bulk_import_settings']['modules']['Calls']['external_key_field'] = 'ID';
    $configuratorObj->config['bulk_import_settings']['modules']['Calls']['sql_query'] = 'select id from calls where voxco_middleware_id = ?';
    $configuratorObj->config['bulk_import_settings']['modules']['Calls']['create_only'] = true; // set to true if records only needed to be created and not updated

    //Save the new setting
    $configuratorObj->saveConfig();

}

