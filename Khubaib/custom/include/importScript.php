<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

$GLOBALS['log']->fatal('---------------IMPORT SCRIPT---------------');

//$GLOBALS['log']->fatal('---------------USER-POSTALCODE IMPORT---------------');
//$importFile = file("/var/www/html/User-PostalCode.csv");
//$data       = array_map('str_getcsv', $importFile);
//
//$line = current($data);
//if (!empty($line)) {
//    // skip header
//    $line = next($data);
//}
//$user     = null;
//$prevUser = null;
//
//$processed = 0;
//
//while ($line) {
//    // $line[0] -> user
//    // $line[3] -> postal code
//    if ($prevUser != $line[0]) {
//        $prevUser = $line[0];
//        $user     = BeanFactory::newBean('Users')->retrieve_by_string_fields(
//            array('novendeur_rep' => $line[0])
//        );
//        $GLOBALS['log']->fatal("Importing for ---> $user->novendeur_rep ($user->name)");
//    }
//    if (!empty($user) && !empty($line[3])) {
//        if ($user->load_relationship('rt_postal_codes_users')) {
//            $postal_code = BeanFactory::newBean('rt_postal_codes')->retrieve_by_string_fields(
//                array('name' => $line[3])
//            );
//            if (!empty($postal_code)) {
//                $user->rt_postal_codes_users->add($postal_code->id);
//                ++$processed;
//            }
//        }
//    }
//    $line = next($data);
//}
//$GLOBALS['log']->fatal("$processed records processed");


// -----------------------------------------------------------------------------------------------------------------------------------


//$teamCSV     = file("/home/khubaib.afzal/Desktop/Solarcan/Packages/Team.csv");
//$salesRepCSV = file("/home/khubaib.afzal/Desktop/Solarcan/Packages/List_salesrep.csv");
//
//$teamData     = array_map('str_getcsv', $teamCSV);
//$salesRepData = array_map('str_getcsv', $salesRepCSV);
//
//if (!empty($teamData) && !empty($salesRepData)) {
//
//    $GLOBALS['log']->fatal("----------------DATA LOADED----------------");
//
//    $teamLine = current($teamData);
//    $teamLine = next($teamData);    // skip header
//
//    $salesRepLine = current($salesRepData);
//    $salesRepLine = next($salesRepData);    // skip header
//
//    while ($salesRepLine) {
//        // $salesRepLine[4] = team number
//        $team     = $salesRepLine[4];
//        $salesRep = $salesRepLine[2];
//        $GLOBALS['log']->fatal("Sales Rep Number: $salesRep");
//        $salesRep = BeanFactory::newBean('Users')->retrieve_by_string_fields(array(
//            'novendeur_rep' => $salesRep));
//        $GLOBALS['log']->fatal("Sales Rep Name: $salesRep->name");
//        if (!empty($salesRep)) {
//            $current      = 1;  // skip header
//            $tempTeamLine = $teamData[$current];
//            while ($tempTeamLine) {
//                if ($tempTeamLine[0] == $team) {
//                    $reportsTo               = $tempTeamLine[2];
//                    $GLOBALS['log']->fatal("Reports To Number: $reportsTo");
//                    $reportsTo               = BeanFactory::newBean('Users')->retrieve_by_string_fields(array(
//                        'novendeur_rep' => $reportsTo));
//                    $GLOBALS['log']->fatal("Reports To Name: $reportsTo->name");
//                    $salesRep->reports_to_id = $reportsTo->id;
//
//                    $GLOBALS['log']->fatal("Team Number: $team");
//                    $team = BeanFactory::newBean('Teams')->retrieve_by_string_fields(array(
//                        'name' => $tempTeamLine[5]));
//                    $GLOBALS['log']->fatal("Team Name: $team->name");
//
//                    if ($salesRep->load_relationship('team_memberships') && !empty($team)) {
//                        $salesRep->team_memberships->add($team->id);
//                        $GLOBALS['log']->fatal("-------------TEAM LINKED-------------");
//                    } else {
//                        $GLOBALS['log']->fatal("-------------USR REL ERR-------------");
//                    }
//                    $salesRep->save();
//                }
//                $tempTeamLine = $teamData[$current++];
//            }
//        }
//        $salesRepLine = next($salesRepData);
//    }
//}
