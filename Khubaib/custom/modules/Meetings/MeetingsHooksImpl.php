<?php

class MeetingsHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * Workflows: Sales rep to determine their availabilities
         */
        $this->makeAccountandOpportunity($bean, $event, $arguments);
    }

    function makeAccountandOpportunity(&$bean, &$event, &$arguments)
    {
        if ($bean->status != $bean->fetched_row['status'] && $bean->status === 'confirme_au_client') {
            if (!empty($bean->contact_id)) {
                $contact = BeanFactory::newBean('Contacts')->retrieve($bean->contact_id);

                $account = BeanFactory::newBean('Accounts');
                $account->name = $contact->name;
                $account->nombre_portes_total = 'nombre_portes_total';  // suppose these are
                $account->nombre_garage_total = 'nombre_garage_total';  // coming from portal
                $account->nombre_fenetres_total = 'nombre_fenetres_total';
                $account->save();
                
                if ($account->load_relationship('meetings')) {
                    $account->meetings->add($bean->id);
                } elseif ($account->load_relationship('account_meetings')) {
                    $account->account_meetings->add($bean->id);
                } else {
                    $GLOBALS['log']->fatal("Account-Meeting relationship not found");
                }

                $opportunity = BeanFactory::newBean('Opportunities');
                $opportunity->name = $contact->name;
                $opportunity->account_id = $account->id;
                $opportunity->save();

                if ($opportunity->load_relationship('contacts')) {
                    $opportunity->contacts->add($contact->id);
                }
                if ($opportunity->load_relationship('meetings')) {
                    $opportunity->meetings->add($bean->id);
                }

                $contact->account_id = $account->id;
                $contact->save();
            }
        }
    }
}
