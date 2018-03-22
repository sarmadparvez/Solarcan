<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

/**
 * ContactsHookImpl
 *
 * All the logic hooks related with contacts module is defined in this class.
 */
class ContactsHookImpl
{
    
    private $fields_to_check = array(
        'phone_home',
        'preferred_language',
        'statut_dnc',
        'region'
    );
    /**
     * Function: beforeSave
     *
     * All before_save logic hooks is inside this function.
     *
     * @param object $bean
     * @param string $event
     * @param array $arguments
     */
    public function beforeSave($bean, $event, $arguments)
    {
        //the record is being updated
        if ($arguments['isUpdate'] && !empty($bean->fetched_row['id'])) {
            if ($this->areVoxcoFieldsUpdated($bean)) {
                $bean->date_modified_pronto = TimeDate::getInstance()->nowDb();
            }
        } else {
            $bean->date_modified_pronto = $bean->date_modified;
        }
    }

    /**
    * Check if fields which are synced with voxco are changed on a bean
    * @param Contact $bean
    * @return boolean
    */
    protected function areVoxcoFieldsUpdated(Contact $bean)
    {
        foreach ($this->fields_to_check as $field) {
            if ($bean->$field != $bean->fetched_row[$field]) {
                return true;
            }
        }
        return false;
    }

}
