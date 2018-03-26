<?php

function post_install()
{
    $sql_files = array(
        'custom/install/scripts/sql/users.txt',
        'custom/install/scripts/sql/rt_postal_codes.txt',
        'custom/install/scripts/sql/rt_postal_codes_users_c.txt',
        'custom/install/scripts/sql/teams.txt',
        'custom/install/scripts/sql/team_memberships.txt',
        'custom/install/scripts/sql/tm_telemarketers.txt',
        'custom/install/scripts/sql/non_visible_fields_role.txt',
        'custom/install/scripts/sql/rt_classification.txt'
    );

    $db = DBManagerFactory::getInstance();
    $GLOBALS['log']->fatal('Started: executing sql scripts for solarcan');
    foreach ($sql_files as $sql_file) {
        $sql_file_content = sugar_file_get_contents($sql_file);
        $sql_statements = explode(";", $sql_file_content);
        runSqlQuery($db, $sql_statements);
    }
    $GLOBALS['log']->fatal('Completed: executing sql scripts for solarcan');
}

function runSqlQuery($db, $sql_statements)
{
    foreach ($sql_statements as $sql_statement) {
        if (!empty($sql_statement)) {
            $db->query($sql_statement);
        }
    }
}
