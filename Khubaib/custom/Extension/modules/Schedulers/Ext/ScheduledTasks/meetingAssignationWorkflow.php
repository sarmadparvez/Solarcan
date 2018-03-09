<?php
array_push($job_strings, 'meetingAssignationWorkflow');

function meetingAssignationWorkflow()
{
    $GLOBALS['log']->fatal("In meetingAssignationWorkflow");
    global $db;

    // get all meetings with 'waiting for assignation' status
    $meetings_query = " SELECT m.id, c.primary_address_street, c.primary_address_city, c.primary_address_postalcode,
                        c.primary_address_state, c.primary_address_country,
                        c.codecie_c, c.preferred_language,
                        (a.nombre_fenetres_achanger > 0) as window,
                        (a.nombre_portes_achanger > 0) as door,
                        (a.nombre_garage_achanger > 0) as garage,
                        DATE(m.date_start) as date, m.timeslot_name AS timeslot
                        FROM meetings m
                        INNER JOIN meetings_contacts mc on mc.meeting_id = m.id
                        INNER JOIN contacts c on mc.contact_id = c.id
                        INNER JOIN accounts_contacts ac ON ac.contact_id = c.id
                        INNER JOIN accounts a ON ac.account_id = a.id
                        WHERE m.status = 'en_attente_dassignation'
                        AND m.deleted = 0
                        AND c.deleted = 0
                        AND DATE(m.date_start) > CURDATE()
                        ORDER BY m.date_start ASC";
    $result         = $db->query($meetings_query, true,
        "Could not fetch 'en_attente_dassignation' meetings from DB");

    // collect in array according to sorted date_start index
    $meetings_and_reps = array();
    while ($row               = $db->fetchByAssoc($result)) {
        $arr                                                               = array(
            'id' => $row['id'],
            'codecie_c' => $row['codecie_c'],
            'preferred_language' => ($row['preferred_language'] == 'francais') ? '1'
                    : '2',
            'street' => $row['primary_address_street'],
            'city' => $row['primary_address_city'],
            'state' => $row['primary_address_state'],
            'country' => $row['primary_address_country'],
            'postalcode' => $row['primary_address_postalcode'],
            'window' => $row['window'],
            'door' => $row['door'],
            'garage' => $row['garage'],
            'date' => $row['date'],
            'timeslot' => $row['timeslot']
        );
        $meetings_and_reps[$row['date'].' '.$row['timeslot']]['waiting'][] = $arr;
    }

    $sales_rep_query = "SELECT c.name as classification, m.created_by, u.codecie_rep_c, u.codelangue_rep, 
                        u.qualified_doors_rep_c, u.qualified_windows_rep_c, u.qualified_garage_rep_c,
                        DATE(m.date_start) as date, m.timeslot_name as timeslot
                        FROM meetings m
                        INNER JOIN rt_classification_users_c cu on m.created_by = cu.rt_classification_usersusers_idb AND cu.deleted =0
                        INNER JOIN rt_classification c on cu.rt_classification_usersrt_classification_ida = c.id AND c.deleted =0
                        INNER JOIN users u on u.id = m.created_by
                        WHERE m.assigned_user_id IS NULL OR m.assigned_user_id = ''
                        AND m.deleted = 0
                        AND u.deleted = 0
                        AND DATE(m.date_start) > CURDATE()
                        ORDER BY m.date_start ASC, c.name ASC";
    $result          = $db->query($sales_rep_query, true,
        "Could not fetch sales_reps from DB");

    while ($row = $db->fetchByAssoc($result)) {
        $key = $row['date'].' '.$row['timeslot'];
        if (isset($meetings_and_reps[$key])) {
            $arr                               = array(
                'id' => $row['created_by'],
                'classification' => $row['classification'],
                'codecie_rep_c' => $row['codecie_rep_c'],
                'codelangue_rep' => $row['codelangue_rep'],
                'door' => $row['qualified_doors_rep_c'],
                'window' => $row['qualified_windows_rep_c'],
                'garage' => $row['qualified_garage_rep_c'],
                'date' => $row['date'],
                'timeslot' => $row['timeslot']
            );
            $meetings_and_reps[$key]['reps'][] = $arr;
        }
    }

//    $GLOBALS['log']->fatal("MEETINGS AND REPS", $meetings_and_reps);
    // for each timeslot check if the available reps match remaining criterias
    $GLOBALS['log']->fatal("STARTING ASSIGNATION");
    foreach ($meetings_and_reps as $key => $timeslot) {
        if (isset($timeslot['waiting']) && isset($timeslot['reps'])) {
            foreach ($timeslot['waiting'] as $m => $meeting) {
                $classification   = '';
                $shortlisted_reps = array();
                $postalcodeBean   = BeanFactory::newBean('rt_postal_codes')->retrieve_by_string_fields(array(
                    'name' => $meeting['postalcode']));
                if (!empty($postalcodeBean)) {
                    foreach ($timeslot['reps'] as $r => $rep) {
                        if ($rep['codecie_rep_c'] == $meeting['codecie_c'] &&
                            ($rep['codelangue_rep'] == '3' || $rep['codelangue_rep']
                            == $meeting['preferred_language']) &&
                            (($meeting['door'] == 1) ? ($meeting['door'] == $rep['door'])
                                    : true) &&
                            (($meeting['window'] == 1) ? ($meeting['window'] == $rep['window'])
                                    : true) &&
                            (($meeting['garage'] == 1) ? ($meeting['garage'] == $rep['garage'])
                                    : true)) {
                            $query  = "  SELECT id
                                        FROM rt_postal_codes_users_c pcu
                                        WHERE pcu.rt_postal_codes_usersusers_idb = '".$rep['id']."'
                                        AND pcu.rt_postal_codes_usersrt_postal_codes_ida = '".$postalcodeBean->id."'
                                        AND pcu.deleted = 0";
                            $result = $db->query($query, true,
                                "Failed to check postal code from DB");
                            while ($row    = $db->fetchByAssoc($result)) {
                                // already checking for best classification sales_rep
                                // inside this loop means we found a matching id for postal code
                                // now just add these in shorlisted array for highest classification
                                if ($classification == '') {
                                    $classification = $rep['classification'];
                                }
                                if ($classification == $rep['classification']) {
                                    $rep['key']         = $r;
                                    $shortlisted_reps[] = $rep;
                                }
                            }
//                            if ($assigned) break;
                        }
                    }
                    $assign_to = findNearest($shortlisted_reps, $meeting);
                    if (!empty($assign_to)) {
                        $GLOBALS['log']->fatal("Assigning ".$meeting['id']." to ".$assign_to['id']);
                        $meetingBean                   = BeanFactory::newBean('Meetings')->retrieve($meeting['id']);
                        $meetingBean->status           = 'assigne';
                        $meetingBean->assigned_user_id = $assign_to['id'];
                        $meetingBean->save();
                        unset($timeslot['reps'][$assign_to['key']]);
                    }
                } else {
                    $GLOBALS['log']->fatal("Could not find Postal Code ".$meeting['postalcode']." in system");
                }
            }
        }
    }

//    $GLOBALS['log']->fatal("MEETINGS AND REPS", $meetings_and_reps);

    return true;
}

function findNearest($sales_reps, $meeting)
{
    $GLOBALS['log']->fatal("FIND NEAREST among ".count($sales_reps)." sales reps");
    $GLOBALS['log']->fatal("Meeting", $meeting, "Sales Reps", $sales_reps);
    if (count($sales_reps) == 1) {  // if only one sales rep then return him to assign
        return $sales_reps[0];
    } else if (count($sales_reps) == 0) {
        return "";
    }

    $full_meeting_address = !empty($meeting['street']) ? $meeting['street'] : "";
    $full_meeting_address .=!empty($meeting['city']) ? ", ".$meeting['city'] : "";
    $full_meeting_address .=!empty($meeting['state']) ? ", ".$meeting['state'] : "";
    $full_meeting_address .=!empty($meeting['country']) ? ", ".$meeting['country']
            : "";
    $full_meeting_address .=!empty($meeting['postalcode']) ? ", ".$meeting['postalcode']
            : "";
    $meeting_coords       = getCoords("J0L+2K0");
    if (empty($meeting_coords)) {
        $GLOBALS['log']->fatal("Meeting Coords not found");
        return "";
    }

    global $db;
    if ($meeting['timeslot'] == 'AM2') {
        $destinations = array();
        foreach ($sales_reps as $rep) {
            // AM2 slot so get team of each rep
            // find nearest team distance from meeting
            $rep_team = "   SELECT team_id
                            FROM team_memberships tm
                            INNER JOIN teams t on t.id = tm.team_id
                            WHERE tm.user_id = '".$rep['id']."'
                            AND t.private = 0
                            AND t.deleted = 0
                            AND tm.deleted = 0
                            AND tm.team_id != 1";
            $result   = $db->query($rep_team, true,
                'Error finding team of sales rep');
            $row      = $db->fetchByAssoc($result);
            if (!empty($row)) {
                $team           = (new Team())->retrieve($row['team_id']);
                $team_location  = $team->description;
                $team_coords    = getCoords($team_location);
                $GLOBALS['log']->fatal("$team->id coords: ", $team_coords);
                $arr            = array(
                    'rep_id' => $rep['id'],
                    'team_coords' => $team_coords
                );
                $destinations[] = $arr;
            } else {
                $GLOBALS['log']->fatal("Could not fetch team of user ".$rep['id']);
            }
        }
        getDistances($meeting_coords, $destinations);
    }
    return "";
}

function getCoords($address)
{
    require_once '/var/www/html/Solarcan/solarcanportal/api/RestCurlClient.php';

    $api_key = 'AIzaSyA55lZ-A1lzH51qpARA1tExIz5KgWINfKk';
    $url     = "https://maps.googleapis.com/maps/api/geocode/";

    $rcc    = new RestCurlClient();
    $GLOBALS['log']->fatal("ADDR URL: ".$url."json?address=".$address."&key=".$api_key);
    $coords = $rcc->get($url."json?address=".$address."&key=".$api_key);
    if (isset($coords['results'][0]['geometry']['location'])) {
        $coords = $coords['results'][0]['geometry']['location'];    // array('lat' => ?, 'lng' => ?)
        return $coords;
    } else {
        $GLOBALS['log']->fatal("ADDRESS RETURNED: ", $coords);
        return "";
    }
}

function getDistances($sourceCoords, $allDestinations)
{
    require_once '/var/www/html/Solarcan/solarcanportal/api/RestCurlClient.php';

    $api_key             = 'AIzaSyA55lZ-A1lzH51qpARA1tExIz5KgWINfKk';
    $url                 = 'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial';
    $allDestinations_url = $url."&origins=".$sourceCoords['lat'].",".$sourceCoords['lng']."&destinations=";

    $i = 0;
    foreach ($allDestinations as $dest) {
        if (!empty($dest['team_coords'])) {
            if ($i == 0) {
                $allDestinations_url.= $dest['team_coords']['lat'].",".$dest['team_coords']['lng'];
            } else {
                $allDestinations_url.= "|".$dest['team_coords']['lat'].",".$dest['team_coords']['lng'];
            }
            $i++;
        }
    }
    $allDestinations_url .= "&key=".$api_key;
    $rcc = new RestCurlClient();
    $GLOBALS['log']->fatal("FULL DISTANCE URL: $allDestinations_url");
}
