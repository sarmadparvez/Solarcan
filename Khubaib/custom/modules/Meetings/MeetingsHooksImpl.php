<?php

class MeetingsHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * Workflows: Contact Status Workflow/Behaviour
         */
        $this->setContactStatus($bean, $event, $arguments);
    }

    function setContactStatus(&$bean, &$event, &$arguments)
    {
        if ($bean->status == 'complete' && $bean->status != $bean->fetched_row['status']) {
            if ($bean->load_relationship('contacts')) {
                $contacts = $bean->contacts->getBeans();
                if (count($contacts) > 0) {
                    $contact = current($contacts);
                    while ($contact) {
                        $contact->statut_contact = 'rencontre';
                        $contact->save();
                        $contact = next($contacts);
                    }
                }
            }
        }
    }
}
