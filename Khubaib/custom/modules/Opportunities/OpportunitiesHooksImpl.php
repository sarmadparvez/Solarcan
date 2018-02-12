<?php

class OpportunitiesHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * Workflows: Contact Status
         */
        $this->setContactStatus($bean, $event, $arguments);
    }

    function setContactStatus(&$bean, &$event, &$arguments)
    {
        if ($bean->status != $bean->fetched_row['status'] && $bean->status === 'vente') {
            if ($bean->load_relationship('contacts')) {
                $contacts = $bean->contacts->getBeans();
                if (count($contacts) > 0) {
                    $contact = current($contacts);
                    while($contact) {
                        $contact->statut_contact = 'client';
                        $contact->save();
                        $contact = next($contacts);
                    }
                }
            } else {
                $GLOBALS['log']->debug("Opportunity-Contact relationship not found");
            }
        }
    }
}
