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
    //Save the new setting
    $configuratorObj->saveConfig();


    global $db;

    $query = "DROP FUNCTION IF EXISTS digits;";
    $result = $db->query($query, true, "ERROR: Could not drop function 'digits'");

    $query = "  CREATE DEFINER=root@localhost FUNCTION digits( str CHAR(32) ) RETURNS char(32) CHARSET latin1
                BEGIN
                    DECLARE i, len SMALLINT DEFAULT 1;
                    DECLARE ret CHAR(32) DEFAULT '';
                    DECLARE c CHAR(1);

                    IF str IS NULL
                    THEN
                        RETURN '';
                    END IF;

                    SET len = CHAR_LENGTH( str );
                    REPEAT
                        BEGIN
                            SET c = MID( str, i, 1 );
                            IF c BETWEEN '0' AND '9' THEN
                                SET ret=CONCAT(ret,c);
                            END IF;
                            SET i = i + 1;
                        END;
                    UNTIL i > len END REPEAT;
                    RETURN ret;
                END;";
    $result = $db->query($query, true, "ERROR: Could not create function 'digits'");
}
