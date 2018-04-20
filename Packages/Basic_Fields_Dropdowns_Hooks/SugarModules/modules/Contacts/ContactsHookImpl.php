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
        'postalcode_id'
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
        // Start: DEV-305 Region of postal code
        if ($bean->primary_address_postalcode != $bean->fetched_row['primary_address_postalcode'] || 
            (empty($bean->postalcode_id) && !empty($bean->primary_address_postalcode)) || 
                $bean->postalcode_id != $bean->fetched_row['postalcode_id']
            ) {
            $this->relatePostalCode($bean);
        }
        // End: DEV-305
        // Start: DEV-315
        if ($bean->lead_source == 'solarcan') {
            $bean->source_details = $bean->lead_source;
        }
        // End

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
    * Add/Remove relation ship with Postal Codes
    */
    protected function relatePostalCode(Contact $bean)
    {
        global $db;
        // because we have to do matching, it shouldn't fail due to leading or trailing spaces
        $bean->primary_address_postalcode = trim($bean->primary_address_postalcode);
        if (!empty($bean->primary_address_postalcode)) {
            $postalcode_initials = $bean->primary_address_postalcode;
            if (strlen($postalcode_initials) > 3) {
                $postalcode_initials = substr($postalcode_initials, 0, 3);
            }
            // match postal code in postalcode module, give preference to full match, other wise
            // if only 3 digit postal code exist in postal codes module match with it
            $s_query = new SugarQuery();
            $s_query->select(array('id','name', 'nostrate_legacy'));
            $s_query->from(BeanFactory::newBean('rt_postal_codes'), array('team_security' => false));
            $s_query->where()->queryOr()
            ->equals('name', $bean->primary_address_postalcode)
            ->queryAnd()->starts('name', $postalcode_initials)
            ->addRaw("LENGTH(name) = 3");
            $s_query->orderByRaw("LENGTH(name)");
            $postalcodes = $s_query->execute();
            if (count($postalcodes) > 0) {
                $postal_code = current($postalcodes);
                $bean->postalcode_id = $postal_code['id'];
                $bean->strate = $postal_code['nostrate_legacy'];
            } else {
                // if no match found, break the relationship
                $bean->postalcode_id = '';
                $bean->strate = '';
                $postal_code['id'] = null;
            }            
        } else {
            $bean->postalcode_id = '';
            $bean->strate = '';
            $postal_code['id'] = null;      
        }

        if (!empty($bean->account_id)) {
            $sql = "UPDATE accounts set postalcode_id = ".$db->quoted($postal_code['id']). 
                "WHERE id = ".$db->quoted($bean->account_id);
            $db->query($sql);
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
