<?php

class CreateMeetingsApi extends SugarApi
{

    /**
     * Return array containing infomartion about
     * End Point Registration
     *
     * @return Array
     */
    public function registerApiRest()
    {
        return array(
            'createMeetings' => array(
                'reqType' => 'POST',
                'path' => array('Meetings', 'mass_create'),
                'pathVars' => array('module', ''),
                'method' => 'createMeetings',
                'shortHelp' => 'Create new meetings with available (disponible) status',
                'longHelp' => '',
            ),
        );
    }

    /**
     *
     * @param type $api
     * @param Array $args
     * @return Array
     */
    public function createMeetings($api, $args)
    {
        $this->requireArgs($args, array('newMeetings'));
        global $current_user;
        foreach ($args['newMeetings'] as $newMeeting) {

            $meeting = BeanFactory::newBean($args['module']);
            $meeting->name = $newMeeting['name'];
            $meeting->duration_hours = 2;
            $meeting->duration_minutes = 0;
            $meeting->status = $newMeeting['status'];

            $sugarField = SugarFieldHandler::getSugarField('datetime');
            $date_start = $sugarField->apiUnformatField($newMeeting['date_start']);

            $meeting->date_start = $date_start;

            $meeting->timeslot_name = $newMeeting['timeslot_name'];
            $meeting->timeslot_datetime = $newMeeting['date_start'];

            $meeting->save();
            /**
             * DEV-809 : QA Portal Regression: Availability check by a representative
             */
            $meeting->set_accept_status($current_user, 'none');
        }

        return true;
    }
}
