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


$GLOBALS['log']->fatal("DNC Post Import Job");
global $db;
$contacts_dnc_query = " SELECT dsm_dnc.id as dsm_dnc, contacts.id as contact
                        FROM dsm_dnc
			RIGHT OUTER JOIN contacts
			ON digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_home)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_mobile)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_work)
                        OR digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_other)
			WHERE contacts.deleted = 0";
$result             = $db->query($contacts_dnc_query, true,
    "Error retrieving matching contacts");

$contact_dnc_list = array();
$i           = 0;
while (($row         = $db->fetchByAssoc($result))) {
    $contact_dnc_list[$i]['contact'] = empty($row['contact']) ? "" : $row['contact'];
    $contact_dnc_list[$i]['dsm_dnc'] = empty($row['dsm_dnc']) ? "" : $row['dsm_dnc'];
    ++$i;
}

if (!empty($contact_dnc_list)) {
    foreach ($contact_dnc_list as $arr) {
        $contactBean = BeanFactory::newBean('Contacts')->retrieve($arr['contact']);
        if ($contactBean) {

            if ($contactBean->consentement == false) {  // no explicit consent
                if ($arr['dsm_dnc'] == "") {    // if not on dnc list
                    $GLOBALS['log']->fatal("NOT ON DNC ---> $contactBean->id");
                    if ($contactBean->statut_dnc != 'active') {     // if this contact is not active
                        $contactBean->statut_dnc = "active";        // make it active
                    }
                } else {    // if on dnc list
                    if ($contactBean->statut_dnc != "inactive") {   // if not already inactive
                        $GLOBALS['log']->fatal("ON DNC ---> $contactBean->id");
                        $contactBean->statut_dnc = "inactive";
                        $contactBean->dsm_dnc_id = $arr['dsm_dnc'];
                        $dnc                     = BeanFactory::newBean('dsm_dnc')->retrieve($arr['dsm_dnc']);
                        if ($dnc->load_relationship('dsm_dnc_dsm_dnc_historic')) {
                            $dnc->dsm_dnc_dsm_dnc_historic->add($contactBean->id);
                        }
                    } else {
                        $GLOBALS['log']->fatal("ALREADY INACTIVE ---> $contactBean->id");
                    }
                }
                $dnc_historic                   = BeanFactory::newBean('dsm_dnc_historic');
                $dnc_historic->name             = $contactBean->name;
                $dnc_historic->statut_precedent = $contactBean->statut_dnc;

                $contactBean->save();
                $dnc_historic->save();

                if ($contactBean->load_relationship('contacts_dsm_dnc_historic')) {
                    $contactBean->contacts_dsm_dnc_historic->add($dnc_historic->id);
                }
            } else {
                $GLOBALS['log']->fatal("EXPLICIT CONSENT ---> $contactBean->id");
            }
        }
    }
}
