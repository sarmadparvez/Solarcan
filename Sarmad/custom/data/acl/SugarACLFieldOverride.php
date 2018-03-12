<?php

/**
 * SugarACLNoAccess
 */
class SugarACLFieldOverride extends SugarACLStrategy 
{

    private static $fields_access = null;

    public function checkAccess($module, $view, $context)
    {
        return true;
    }

    public function getFieldListAccess($module, $field_list, $context)
    {
        $acl = array();
        // no need to modify field acl if bean is not set or its a new bean
        if (!isset($context['bean']) || $this->isNewBean($context['bean']) || 
            empty($context['bean']->assigned_user_id)) {
            return $acl;
        }
        $is_owner = false;
        global $current_user;
        //acl should apply to users own records and should not apply to admin
        if ($current_user->id == $context['bean']->assigned_user_id && !$current_user->is_admin) {
            $is_owner = true;
        } else {
            return $acl;
        }
        // if current date is one day before meeting then acl should not apply , simple return empty $acl array
        // acl should only apply once the meeting is booked and assigned to sales rep
        
        $acl = parent::getFieldListAccess($module, $field_list, $context);
        $role_id = 'c7785ca6-22e2-11e8-b943-ecf4bb90601d';
        // get the field acl from this $role_id
        $field_acl = $this->getACLFieldsByRoleModule($role_id, 'Meetings', $is_owner);
        // modifying the field acl
        foreach ($field_acl as $acl_data) {
            $acl[$acl_data['name']] = $acl_data['aclaccess'];
        }
        return $acl;
    }

    /**
     * @internal
     * @param string $role_id
     * @return array
     */
    protected function getACLFieldsByRoleModule($role_id, $module, $is_owner = false)
    {
        if (!empty(self::$fields_access)) {
            return self::$fields_access;
        }
        $query = 'SELECT id, name, category, role_id, aclaccess
            FROM acl_fields
            WHERE role_id = ? AND category = ?
            AND deleted = 0';

        $stmt = DBManagerFactory::getConnection()
            ->executeQuery($query, array($role_id, $module));
        $tbaConfigurator = new TeamBasedACLConfigurator();
        $fields = array();
        while (($row = $stmt->fetch())) {
            if($row['aclaccess'] == ACL_READ_WRITE || ($is_owner && ($row['aclaccess'] == ACL_READ_OWNER_WRITE || $row['aclaccess'] == ACL_OWNER_READ_WRITE)) || $row['aclaccess'] == 0) {
                $row['aclaccess'] = 4;
            } elseif($row['aclaccess'] == ACL_READ_ONLY || $row['aclaccess']==ACL_READ_OWNER_WRITE) {
                $row['aclaccess'] = 1;
            } elseif ($tbaConfigurator->isEnabledForModule($module) && $tbaConfigurator->isValidAccess($row['aclaccess'])) {
                // Handled by SugarACLTeamBased.
                $row['aclaccess'] = 4;
            } else {
                $row['aclaccess'] = 0;
            }
            $fields[$row['id']] = $row;
        }
        self::$fields_access = $fields;
        return $fields;
    }

    /**
    * @return true if bean is new otherwise false
    */
    protected function isNewBean(SugarBean $bean = null)
    {
        return isset($bean)
            && (!$bean->id
            || $bean->new_with_id
            || (isset($bean->isDuplicate) && $bean->isDuplicate));
    }
}
