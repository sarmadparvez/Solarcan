<?php

class dsm_dnc_historicHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * Workflows: Consent date
         */
        $this->setDateAndSourceField($bean, $event, $arguments);
    }

    function setDateAndSourceField(&$bean, &$event, &$arguments)
    {
        if ($bean->id != $bean->fetched_row['id'] && !empty($bean->contact_id)) {
            global $current_user;
            $bean->user_id = $current_user->id;
            $contact       = BeanFactory::newBean('Contacts')->retrieve($bean->contact_id);
            if (!empty($contact->dsm_dnc_id)) {
                $dnc = BeanFactory::newBean('dsm_dnc')->retrieve($contact->dsm_dnc_id);
                if (!empty($dnc->date_enregistrement)) {
                    $bean->date_enregistrement = $dnc->date_enregistrement;
                }
                if ($dnc->load_relationship('dsm_dnc_dsm_dnc_historic')) {
                    $dnc->dsm_dnc_dsm_dnc_historic->add($bean->id);
                }
            }
        }
    }
}
