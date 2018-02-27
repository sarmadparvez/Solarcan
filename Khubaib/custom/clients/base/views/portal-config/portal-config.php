<?php

$viewdefs['base']['view']['portal-config'] = array(
    'panels' => array(
        array(
            'fields' => array (
                    0 => array(
                        array(
                            'name' => 'x_hours',
                            'label' => 'LBL_APPOINTMENT_IN_X_HOURS',
                            'type' => 'int',
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
                    )
                )
            ),
        )
);
