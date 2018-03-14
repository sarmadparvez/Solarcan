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
        if ($module != 'Meetings') {
            return parent::getFieldListAccess($module, $field_list, $context);
        }
        
        $acl = array();

        // no need to modify field acl if bean is not set or its a new bean
        if (!isset($context['bean']) || $this->isNewBean($context['bean']) || 
            empty($context['bean']->assigned_user_id)) {
            return $acl;
        }

        $is_owner = false;
        global $current_user;

        //acl should apply to users own records and should not apply to admin
        if ($current_user->id == $context['bean']->assigned_user_id &&
            !$current_user->is_admin &&
            $context['bean']->status == 'assigne') {
            $is_owner = true;
        } else {
            return $acl;
        }

        // if current date is one day before meeting then acl should not apply , simple return empty $acl array
        // acl should only apply once the meeting is booked and assigned to sales rep
        $acl = parent::getFieldListAccess($module, $field_list, $context);

        $td = new TimeDate($current_user);
        $time_offset = ($td->getUserUTCOffset() / 60);  // get time offset of current user
        $meeting_date = $td->to_db_date($context['bean']->date_start);  // get meeting date according to db (utc)
        $current_date = gmdate('Y-m-d');    // get current date according to db (utc)

        $date1 = new DateTime($meeting_date);
        $date2 = new DateTime($current_date);
        $date_diff = $date1->diff($date2);
        // $GLOBALS['log']->fatal("Date diff: $date_diff->d");

        $force_acl = false;
        if ($date_diff->d > 1 && $meeting_date > $current_date) {   // $date_diff->d gives date difference in days
            // if day before appointment
            $force_acl = true;
        }

        if ($force_acl) {
            $role_bean = BeanFactory::newBean('ACLRoles')->retrieve_by_string_fields(array('name' => 'Non Visible Fields'));
            if (!empty($role_bean)) {
                $role_id = $role_bean->id;
                // get the field acl from this $role_id
                $field_acl = $this->getACLFieldsByRoleModule($role_id, $module, $is_owner);
                // modifying the field acl (applying role's acl)
                foreach ($field_acl as $acl_data) {
                    $acl[$acl_data['name']] = $acl_data['aclaccess'];
                }
            }
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
