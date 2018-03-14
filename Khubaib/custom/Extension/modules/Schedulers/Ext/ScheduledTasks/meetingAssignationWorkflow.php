<?php
array_push($job_strings, 'meetingAssignationWorkflow');

function meetingAssignationWorkflow()
{
    $GLOBALS['log']->fatal("In meetingAssignationWorkflow");
    global $db;

    // get all meetings with 'waiting for assignation' status
    $meetings_query = " SELECT m.id, c.primary_address_postalcode, c.codecie_c, c.preferred_language,
                        (a.nombre_fenetres_achanger > 0) as window,
                        (a.nombre_portes_achanger > 0) as door,
                        (a.nombre_garage_achanger > 0) as garage,
                        DATE(m.date_start) as date, m.timeslot_name AS timeslot
                        FROM meetings m
                        INNER JOIN meetings_contacts mc on mc.meeting_id = m.id AND mc.deleted = 0
                        INNER JOIN contacts c on mc.contact_id = c.id AND c.deleted = 0
                        INNER JOIN accounts_contacts ac ON ac.contact_id = c.id AND ac.deleted = 0
                        INNER JOIN accounts a ON ac.account_id = a.id AND a.deleted = 0
                        WHERE m.status = 'en_attente_dassignation'
                        AND m.deleted = 0
                        AND c.deleted = 0
                        AND DATE(m.date_start) > CURDATE()
                        ORDER BY m.date_start ASC";
    $result = $db->query($meetings_query, true, "Could not fetch 'en_attente_dassignation' meetings from DB");

    // collect in array according to sorted date_start index
    $meetings_and_reps = array();
    while ($row = $db->fetchByAssoc($result)) {
        $arr = array(
            'id' => $row['id'],
            'codecie_c' => $row['codecie_c'],
            'preferred_language' => ($row['preferred_language'] == 'francais') ? '1' : '2',
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
                        WHERE (m.status = 'disponible' OR m.status = 'en_attente_dassignation')
                        AND m.deleted = 0
                        AND u.deleted = 0
                        AND DATE(m.date_start) > CURDATE()
                        ORDER BY m.date_start ASC, c.name ASC";
    $result = $db->query($sales_rep_query, true, "Could not fetch sales_reps from DB");

    while ($row = $db->fetchByAssoc($result)) {
        $key = $row['date'].' '.$row['timeslot'];
        if (isset($meetings_and_reps[$key])) {
            $arr = array(
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


    // $GLOBALS['log']->fatal("MEETINGS AND REPS: ", $meetings_and_reps);
    // $GLOBALS['log']->fatal("STARTING ASSIGNATION");
    // for each timeslot check if the available reps match remaining criterias
    foreach ($meetings_and_reps as $key => $timeslot) {
        if (isset($timeslot['waiting']) && isset($timeslot['reps'])) {
            foreach ($timeslot['waiting'] as $m => $meeting) {
                $postalcodeBean = BeanFactory::newBean('rt_postal_codes')->retrieve_by_string_fields(array('name' => $meeting['postalcode']));
                if (!empty($postalcodeBean)) {
                    $assigned = false;
                    foreach ($timeslot['reps'] as $r => $rep) {
                        // first match all critereas to make sure this sales rep is qualified
                        if ($rep['codecie_rep_c'] == $meeting['codecie_c'] &&
                           ($rep['codelangue_rep'] == '3' || $rep['codelangue_rep'] == $meeting['preferred_language']) &&
                           (($meeting['door'] == 1) ? ($meeting['door'] == $rep['door']) : true) &&
                           (($meeting['window'] == 1) ? ($meeting['window'] == $rep['window']) : true) &&
                           (($meeting['garage'] == 1) ? ($meeting['garage'] == $rep['garage']) : true)) {
                            // now check if this sales rep has this postal code
                            $query = "  SELECT id
                                        FROM rt_postal_codes_users_c pcu
                                        WHERE pcu.rt_postal_codes_usersusers_idb = '".$rep['id']."'
                                        AND pcu.rt_postal_codes_usersrt_postal_codes_ida = '".$postalcodeBean->id."'
                                        AND pcu.deleted = 0";
                            $result = $db->query($query, true, "Failed to check postal code from DB");
                            while ($row = $db->fetchByAssoc($result)) {
                                // already checking for best classification sales_rep (sorted in $sales_rep_query)
                                // inside this loop means this rep can go to the postal code
                                // now just assign this sales rep the meeting and remove him from this timeslot array
                                $meetingBean = BeanFactory::newBean('Meetings')->retrieve($meeting['id']);
                                $meetingBean->status = 'assigne';
                                $meetingBean->assigned_user_id = $rep['id'];
                                $meetingBean->save();
                                $GLOBALS['log']->fatal("Meeting $meetingBean->id is assinged to User ".$rep['id']." $r");
                                unset($timeslot['reps'][$r]);
                                $assigned = true;
                                break;
                            }
                            if ($assigned) {
                                break;
                            }
                        }
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
