<?php

$viewdefs['base']['view']['portal-config'] = array(
    'panels' => array(
        array(
            'fields' => array (
                    0 => array(
                        array(
                            'name' => 'x_hours',
                            'label' => 'LBL_APPOINTMENT_IN_X_HOURS',
                            'type' => 'text',
                            'required' => true,
                            'error_message'=> 'ERR_INVALID_X_HOURS',
                            'span' => 3,
                        )
                    ),
                    1 => array(
                        array(
                            'name' => 'appointments_upto',
                            'label' => 'LBL_APPOINTMENT_FILTER',
                            'type' => 'datetimecombo',
                            'options' => 'date_range_search_dom',
                            'required' => true,
                            'error_message'=> 'ERR_APPOINTMENT_FILTER',
                            'span' => 3
                        ),
                    ),
                    2 => array(
                        array(
                            'name' => 'param_portes',
                            'label' => 'LBL_PARAM_PORTES',
                            'type' => 'decimal',
                            'comment' => 'Parameter for portential amount of sales for doors',
                            'required' => true,
                            'span' => 3,
                            'error_message'=> 'ERR_INVALID_PARAM_DOORS',
                        ),
                    ),
                    3 => array(
                        array(
                            'name' => 'param_fenetres',
                            'label' => 'LBL_PARAM_FENETRES',
                            'type' => 'decimal',
                            'comment' => 'Parameter for portential amount of sales for windows',
                            'required' => true,
                            'span' => 3,
                            'error_message'=> 'ERR_INVALID_PARAM_WINDOWS',
                        ),
                    ),
                    4 => array(
                        array(
                            'name' => 'param_garage',
                            'label' => 'LBL_PARAM_GARAGE',
                            'type' => 'decimal',
                            'comment' => 'Parameter for portential amount of sales for garage',
                            'required' => true,
                            'span' => 3,
                            'error_message'=> 'ERR_INVALID_PARAM_GARAGE',
                        ),
                    )
                )
            ),
        )
);
