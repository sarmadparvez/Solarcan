<?php

class dsm_dncHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        /**
         * 
         */
        $this->setSourceField($bean, $event, $arguments);
    }

    function setSourceField(&$bean, &$event, &$arguments)
    {
        if (isset($_REQUEST['import_type'])) {
            $bean->source = 'Import';
            $bean->date_enregistrement = $bean->date_modified;
        } else {
            global $current_user;
            $bean->source = 'agent';
            $bean->user_id = $current_user->id;
        }
    }
}
