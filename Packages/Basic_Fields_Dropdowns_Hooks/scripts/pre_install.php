<?php
require_once 'modules/Configurator/Configurator.php';

function pre_install()
{
    // execute query to add fields in users module
    global $db;

    $query = "DROP PROCEDURE IF EXISTS userColumns;";
    $result = $db->query($query, true, "ERROR: Could not drop procedure 'userColumns'");
    
    $query = "      
                        CREATE PROCEDURE userColumns()
                            BEGIN
                                DECLARE CONTINUE HANDLER FOR SQLEXCEPTION BEGIN END;
  				ALTER TABLE users ADD COLUMN adresse_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN cellulaire_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN codecie_rep_c VARCHAR(255) DEFAULT 'Solarcan';
                                ALTER TABLE users ADD COLUMN codelangue_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN courriel_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN fax_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN last_minute_appt TINYINT(1) DEFAULT 1;
                                ALTER TABLE users ADD COLUMN nom_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN nosolarcan_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN novendeur_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN pager_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN prenom_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN qualified_doors_rep_c TINYINT(1) DEFAULT 0;
                                ALTER TABLE users ADD COLUMN qualified_garage_rep_c TINYINT(1) DEFAULT 0;
                                ALTER TABLE users ADD COLUMN qualified_windows_rep_c TINYINT(1) DEFAULT 0;
                                ALTER TABLE users ADD COLUMN secteur_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN telres_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users ADD COLUMN ville_rep VARCHAR(255) DEFAULT NULL;
                                ALTER TABLE users add COLUMN can_sell text  NULL;
                            END
                    ;";
    $result = $db->query($query, true, "ERROR: Could not create procedure 'userColumns'");

    $query = "CALL userColumns();";
    $result = $db->query($query, true, "ERROR: Execution of procedure 'userColumns' failed");

    $query = "DROP PROCEDURE userColumns;";
    $result = $db->query($query, true, "ERROR: Could not drop procedure 'userColumns'");
    
}
