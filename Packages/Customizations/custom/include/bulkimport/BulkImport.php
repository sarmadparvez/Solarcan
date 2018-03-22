<?php

require_once('custom/include/helpers/UtHelper.php');
/**
* The class holds the logic to bulk import data into SugarCRM
*/
class BulkImport
{
    use UtHelper;
    protected $import_settings = array();
    protected $response = array();

    protected $sugar_exteranal_mapping =  array(
        'Calls' => array(
            'HisCallDate' => 'date_start',
            'HisCallDuration' => 'duration_minutes',
            'ResModified' => 'date_modified'
        )
    );

    protected $calls_date_fields = array(
        'date_start',
        'date_modified'
    ); 

    public function __construct()
    {
        $this->loadConfigSettings();
        $this->initiateResponseArray();
    }

    /**
     * @return array
     */
    public function getResponseArray()
    {
        foreach (array('count', 'list') as $type) {
            foreach ($this->response[$type] as $key => $val) {
                if(empty($val)) {
                    unset($this->response[$type][$key]);
                }
            }
        }
        return $this->response;
    }

    /**
     * @return array
     */
    public function getImportSettings()
    {
        return $this->import_settings;
    }

    /**
     * @param SugarBean $b
     * @param array $data
     * @param array $args
     */
    public function handleAdditionalMappingBeforeSave($b, $data, $args)
    {
/*        // handle user's password hashing for the 'password' plain text field into the user_hash
        if($b->table_name == 'users' && !empty($data['password'])) {
            $b->user_hash = $b->getPasswordHash($data['password']);
            unset($b->password);
        }*/
        //handle assigned user id, if its not sent by external system, set it as that of admin user
        if (empty($b->assigned_user_id)) {
            $b->assigned_user_id = 1;
        }
        // handle created by overriding
        if(!empty($data['created_by'])) {
            $b->created_by = $data['created_by'];
            $b->set_created_by = false;
        }

        // handle modified user id overriding
        if(!empty($data['modified_user_id'])) {
            $b->modified_user_id = $data['modified_user_id'];
            $b->update_modified_by = false;
        }

        // handle date entered overriding
        if(isset($record['date_entered']) && !empty($record['date_entered'])) {
            $b->update_date_entered = false;
        }

        // handle date modified overriding
        if(isset($record['date_modified']) && !empty($record['date_modified'])) {
            $b->update_date_modified = false;
        }
    }

    /**
     * Create new record or update existing
     * @param array $record
     * @param SugarBean $bean
     * @param array $args
     */
    public function handleRecordSave($record, $bean, $args)
    {
        // check for empty record
        if(!$this->isPassedArrayFullyEmpty($record)) {
 
            $external_key_field = $this->getExternalKeyFieldForModule($bean->module_name);
            $sugar_key_field = $this->getSugarKeyFieldForModule($bean->module_name);
            if(!empty($external_key_field) && !empty($record[$external_key_field])) {
                $create_only = $this->getCreateOnly($args['module']);
                // retrieve the record
                $record_id = '';
                // if $create_only is true it means, records only need to be created and not updated
                if (!$create_only) {
                    $record_id = $this->getSugarRecordId($bean, $record[$external_key_field]);
                }
                
                //update case
                if(!empty($record_id)) {

                    if(empty($args['skipUpdate'])) {
                        $GLOBALS['log']->fatal('update case');
                        // retrieve also if deleted, and undelete
                        $b = BeanFactory::getBean($args['module'], $record_id, array('deleted' => false));

                        // handle undelete/delete
                        if(!$record['deleted'] && $b->deleted) {
                            $b->mark_undeleted($b->id);
                        } else if($record['deleted'] && !$b->deleted) {
                            $b->mark_deleted($b->id);
                        }

                        // unset id for existing records
                        if(!empty($record['id'])) {
                            unset($record['id']);
                        }
  
                        foreach ($record as $field => $value) {
                           //we need this if condition only when sugar key field and external key field are different
                            /*if(!empty($sugar_key_field) && $field == $external_key_field) {
                                $b->$sugar_key_field = $value;
                            } else {*/
                                $b->$field = $value;
                            //}
                        }
                       
                        // handle additional mapping before save
                        $this->handleAdditionalMappingBeforeSave($b, $record, $args);

                        try {
                            $b->save();
                            $this->addToResponseArray('updated',
                                array(
                                    array(
                                        'external_key' => $record[$external_key_field],
                                        'sugar_id' => $b->id,
                                    )
                                )
                            );
                        } catch (Exception $e) {
                            $GLOBALS['log']->error(
                                'Module ' . $args['module'] . ' update failed for ' .
                                'external record key ' . $external_key_field . ': ' . $record[$external_key_field] . ' and sugar id: ' . $b->id
                            );
                            $this->addToResponseArray('errors',
                                array(
                                    array(
                                        'external_key' => $record[$external_key_field],
                                        'sugar_id' => $b->id,
                                        'message' => 'Module ' . $args['module'] . ' update failed',
                                    )
                                )
                            );
                        }
                    } else {
                        $this->addToResponseArray('warnings',
                            array(
                                array(
                                    'external_key' => $record[$external_key_field],
                                    'sugar_id' => $record_id,
                                    'message' => 'Module ' . $args['module'] . ' update skipped as requested',
                                )
                            )
                        );
                    }
                } else {
                    // for now a clean bean for each new record
                    $b = BeanFactory::newBean($args['module']);

                    foreach ($record as $field => $value) {
                       //we need this if condition only when sugar key field and external key field are different
                        if(!empty($sugar_key_field) && $field == $external_key_field) {
                            $b->$sugar_key_field = $value;
                        } else if (isset($this->sugar_exteranal_mapping[$args['module']][$field])) {
                            $bean_field = $this->sugar_exteranal_mapping[$args['module']][$field];
                            $b->$bean_field = $value;
                        } else {
                            $b->$field = $value;
                        }
                    }

                    // special case for calls module
                    if ($args['module'] == 'Calls') {
                        if (!empty($b->duration_minutes)) {
                            $b->duration_minutes = ceil($b->duration_minutes/60);
                        }
                        foreach ($this->calls_date_fields as $field) {
                            if (!empty($b->$field)) {
                                $b->$field = substr($b->$field, 0, strpos($b->$field, "."));
                            }
                        }
                        //set a default name for call
                        $b->name = 'Pronto Call';
                        //set default status
                        $b->status = 'Held';
                    }

                    //fix date fields
                    //substr($variable, 0, strpos($variable, "By"));

                    // handle setting of sugar id if required
                    if(!empty($b->id)) {
                        $b->new_with_id = true;
                    }

                    // handle additional mapping before save
                    $this->handleAdditionalMappingBeforeSave($b, $record, $args);

                    try {
                        $b->save();
                        $this->addToResponseArray('created',
                            array(
                                array(
                                    'external_key' => $record[$external_key_field],
                                    'sugar_id' => $b->id,
                                )
                            )
                        );
                    } catch (Exception $e) {
                        $GLOBALS['log']->error(
                            'Module ' . $args['module'] . ' creation of record failed for ' .
                            'external record key ' . $external_key_field . ': ' . $record[$external_key_field]
                        );
                        $this->addToResponseArray('errors',
                            array(
                                array(
                                    'external_key' => $record[$external_key_field],
                                    'message' => 'Module ' . $args['module'] . ' creation of record failed',
                                )
                            )
                        );
                    }
                }
            } else {
                $GLOBALS['log']->error('Module ' . $args['module'] . ' key: ' .$external_key_field. ' empty');
                $this->addToResponseArray('errors',
                    array(
                        array(
                            'message' => 'Module ' . $args['module'] . ' key: ' .$external_key_field. ' empty',
                        )
                    )
                );
            }
        } else {
            // passed empty record
            $this->addToResponseArray('warnings',
                array(
                    array(
                        'message' => 'Empty record passed for module ' . $args['module'],
                    )
                )
            );
        }
    }

    /**
     * Create new relationships between objects
     * @param array $record
     * @param SugarBean $leftbean
     * @param SugarBean $rightbean
     * @param array $args
     */
    public function handleRelationshipSave($record, $leftbean, $rightbean, $args)
    {
        $current_error = false;
        $external_rel_keys = $this->getExternalRelationshipKeys($args['module'], $args['linkfield']);

        if(!empty($external_rel_keys) && !empty($record[$external_rel_keys['external_key_field_left']]) && !empty($record[$external_rel_keys['external_key_field_right']])) {
            // retrieve the records
            $sugar_id_left = $this->getSugarRecordId($leftbean, $record[$external_rel_keys['external_key_field_left']]);
            $sugar_id_right = $this->getSugarRecordId($rightbean, $record[$external_rel_keys['external_key_field_right']]);

            if(!empty($sugar_id_left)) {
                if(!empty($sugar_id_right)) {
                    $b = BeanFactory::getBean($leftbean->module_name, $sugar_id_left);

                    if(!empty($record['relationship_params'])) {
                        // adding relationship params
                        $rel_params = $record['relationship_params'];
                    } else {
                        $rel_params = array();
                    }

                    $this->handleManyToManyRelationship($b, array(
                        'sugar_id_left' => $sugar_id_left,
                        'external_key_left' => $record[$external_rel_keys['external_key_field_left']],
                        'sugar_id_right' => $sugar_id_right,
                        'external_key_right' => $record[$external_rel_keys['external_key_field_right']],
                        'relationship_params' => $rel_params
                    ), $args);
                } else {
                    $current_error = true;
                    $this->addToResponseArray('errors',
                        array(
                            array(
                                'external_key_left' => $record[$external_rel_keys['external_key_field_left']],
                                'sugar_id_left' => $sugar_id_left,
                                'external_key_right' => $record[$external_rel_keys['external_key_field_right']],
                                'sugar_id_right' => '',
                            )
                        )
                    );
                }
            } else {
                $current_error = true;
                $this->addToResponseArray('errors',
                    array(
                        array(
                            'external_key_left' => $record[$external_rel_keys['external_key_field_left']],
                            'sugar_id_left' => '',
                            'external_key_right' => $record[$external_rel_keys['external_key_field_right']],
                            'sugar_id_right' => $sugar_id_right,
                        )
                    )
                );
            }
        } else {
            $current_error = true;
            $this->addToResponseArray('errors',
                array(
                    array(
                        'external_key_left' => $record[$external_rel_keys['external_key_field_left']],
                        'sugar_id_left' => '',
                        'external_key_right' => $record[$external_rel_keys['external_key_field_right']],
                        'sugar_id_right' => '',
                    )
                )
            );
        }

        // add more comprehensive logging to determine which records did not relate
        if($current_error) {
            $GLOBALS['log']->error(
                'Relationship import error due to missing record.' .
                ' Left Module: ' . $leftbean->module_name .
                ' Left key: ' . $record[$external_rel_keys['external_key_field_left']] .
                ' Left id: ' . $sugar_id_left .
                ' Right Module: ' . $rightbean->module_name .
                ' Right key: ' . $record[$external_rel_keys['external_key_field_right']] .
                ' Right id: ' . $sugar_id_right
            );
        }
    }

    /**
     * Delete record
     * @param array $record
     * @param SugarBean $bean
     * @param array $args
     */
    public function handleRecordDelete($record, $bean, $args)
    {
        // check for empty record
        if(!$this->isPassedArrayFullyEmpty($record)) {
 
            $key_field = $this->getDeletionKeyForModule($bean->module_name);

            if(!empty($key_field) && !empty($record[$key_field])) {
                // if key field is other than id, then get id from database from key field
                if ($key_field != 'id') {
                    $record_id = $this->getSugarRecordIdForDeletion($bean, $record[$key_field]);
                } else {
                    $record_id = $record[$key_field];
                }
                
                if(!empty($record_id)) {
                    // retrieve record
                    $b = BeanFactory::getBean(
                        $args['module'],
                        $record_id,
                        array('strict_retrieve' => true)
                    );
                    try {
                        if (!empty($b)) {
                            $b->team_set_id = null;
                            $b->mark_deleted($b->id);
                            $this->addToResponseArray('deleted',
                                array(
                                    array(
                                        'external_key' => $record[$key_field],
                                        'sugar_id' => $record_id,
                                    )
                                )
                            );
                        } else {
                            $GLOBALS['log']->error(
                                'Module ' . $args['module'] . 'bean not found for ' .
                                'record key ' . $key_field . ': ' . $record[$key_field] . ' and sugar id: ' . $record_id
                            );
                            $this->addToResponseArray('errors',
                                array(
                                    array(
                                        'external_key' => $record[$key_field],
                                        'sugar_id' => $record_id,
                                        'message' => 'Module ' . $args['module'] . ' bean not found',
                                    )
                                )
                            );
                        }

                    } catch (Exception $e) {
                        $GLOBALS['log']->error(
                            'Module ' . $args['module'] . ' delete failed for ' .
                            'record key ' . $key_field . ': ' . $record[$key_field] . ' and sugar id: ' . $b->id
                        );
                        $this->addToResponseArray('errors',
                            array(
                                array(
                                    'external_key' => $record[$key_field],
                                    'sugar_id' => $b->id,
                                    'message' => 'Module ' . $args['module'] . ' delete failed',
                                )
                            )
                        );
                    }
                }
            } else {
                $GLOBALS['log']->error('Module ' . $args['module'] . ' key: ' .$key_field. ' empty');
                $this->addToResponseArray('errors',
                    array(
                        array(
                            'message' => 'Module ' . $args['module'] . ' key: ' .$key_field. ' empty',
                        )
                    )
                );
            }
        } else {
            // passed empty record
            $this->addToResponseArray('warnings',
                array(
                    array(
                        'message' => 'Empty record passed for module ' . $args['module'],
                    )
                )
            );
        }
    }

    /**
     * Check if the required arguments exists
     * @param $args
     */
    public function checkImportArgsForModules($args)
    {
        if(empty($args['module']) || empty($args['records'])) {
            $this->parameterError(
                'Following parameters are empty: ' .
                (empty($args['module']) ? 'Module' : '') .
                (empty($args['records']) ? ', Records' : '')
            );
        }

        if(!in_array($args['module'], $this->getAllowedModules())) {
            $this->parameterError('Module ' . $args['module'] . ' not allowed');
        }
    }

    /**
     * Log functionality with error and exception
     * @param $message
     * @throws SugarApiExceptionInvalidParameter
     */
    public function parameterError($message) {
        $GLOBALS['log']->error($message);
        throw new SugarApiExceptionInvalidParameter($message);
    }

    /**
     * Log execution time if more than 30 seconds
     * @param $message
     */
    public function logExecutionTime($time) {
        if($time > 30) {
            $GLOBALS['log']->fatal('Slow execution time: ' . $time . '. Please reduce the number of records passed to the Bulk Import API at any one time'); 
        } else {
            $GLOBALS['log']->info('Finished, total execution time: ' . $time); 
        }
    }   

    /**
     * @return array
     */
    public function getAllowedRelationshipModules() {
        if(!empty($this->import_settings['relationships'])) {
            return array_keys($this->import_settings['relationships']);
        }
        
        return array();
    }

    /**
     * @return array
     */
    public function getAllowedRelationshipLinkfields($module) {
        if(!empty($module) && !empty($this->import_settings['relationships'][$module])) {
            return array_keys($this->import_settings['relationships'][$module]);
        }
        
        return array();
    }

    /**
     * Retrieves a Sugar record id by executing a SQL lookup, based on the predefined configuration query
     * @param SugarBean $b
     * @param string $lookup_id
     * @return false|string
     */
    protected function getSugarRecordId($b, $lookup_id)
    {
        // check if it is a valid module
        if (!empty($b)) {
            $query = $this->writeSQLQuery($b->module_name);
            $stmt = $GLOBALS['db']->getConnection()->executeQuery($query, array($lookup_id));
            $id = $stmt->fetch();
            if(!empty($id)) {
                // return the value, whatever the key might be (id or id_c)
                return current($id);
            }
        }
        return false;
    }

    /**
     * @param SugarBean $b
     * @param array $data
     * @param array $args
     */
    private function handleManyToManyRelationship($b, $data, $args)
    {
        $linkfield = '';
        if(in_array($args['linkfield'], $this->getAllowedRelationshipLinkfields($args['module']))) {
            $linkfield = $args['linkfield'];
        }

        if(!empty($linkfield)) {
            // relate the records
            $b->load_relationship($linkfield);
            if(!empty($b->$linkfield)) {

                if(!empty($data['relationship_params']) && is_array($data['relationship_params'])) {
                    try {
                        $b->$linkfield->add($data['sugar_id_right'], $data['relationship_params']);
                        $this->addToResponseArray('related',
                            array(
                                array(
                                    'external_key_left' => $data['external_key_left'],
                                    'sugar_id_left' => $b->id,
                                    'external_key_right' => $data['external_key_right'],
                                    'sugar_id_right' => $data['sugar_id_right'],
                                )
                            )
                        );
                    } catch (Exception $e) {
                        $this->addToResponseArray('errors',
                            array(
                                array(
                                    'external_key_left' => $data['external_key_left'],
                                    'sugar_id_left' => $b->id,
                                    'external_key_right' => $data['external_key_right'],
                                    'sugar_id_right' => $data['sugar_id_right'],
                                )
                            )
                        );
                    }
                } else {
                    try {
                        $b->$linkfield->add($data['sugar_id_right']);
                        $this->addToResponseArray('related',
                            array(
                                array(
                                    'external_key_left' => $data['external_key_left'],
                                    'sugar_id_left' => $b->id,
                                    'external_key_right' => $data['external_key_right'],
                                    'sugar_id_right' => $data['sugar_id_right'],
                                )
                            )
                        );
                    } catch (Exception $e) {
                        $this->addToResponseArray('errors',
                            array(
                                array(
                                    'external_key_left' => $data['external_key_left'],
                                    'sugar_id_left' => $b->id,
                                    'external_key_right' => $data['external_key_right'],
                                    'sugar_id_right' => $data['sugar_id_right'],
                                )
                            )
                        );
                    }
                }
            }
        }
    }

    private function initiateResponseArray()
    {
        $this->response = array();
        $this->response['count'] = array();
        $this->response['count']['related'] = 0;
        $this->response['count']['created'] = 0;
        $this->response['count']['updated'] = 0;
        $this->response['count']['deleted'] = 0;
        $this->response['count']['warnings'] = 0;
        $this->response['count']['errors'] = 0;

        $this->response['list'] = array();
        $this->response['list']['related'] = array();
        $this->response['list']['created'] = array();
        $this->response['list']['updated'] = array();
        $this->response['list']['deleted'] = array();
        $this->response['list']['warnings'] = array();
        $this->response['list']['errors'] = array();
    }

    private function addToResponseArray($list_type, $list)
    {
        if(!empty($list_type) && !empty($list)) {
            foreach ($list as $val) {
                $this->response['list'][$list_type][] = $val;
            }
            // update count
            $this->response['count'][$list_type] = count($this->response['list'][$list_type]);
        }
    }

    /**
     * @param array $record
     * @return bool
     */
    private function isPassedArrayFullyEmpty($record) {
        if(!empty($record)) {
            foreach ($record as $field => $value) {
                if(!empty($value)) {
                    return false;
                }
            }
        }
        
        return true;
    }

    private function loadConfigSettings() {
        $this->import_settings = SugarConfig::getInstance()->get('bulk_import_settings');

        /*
            sample config options:

            $sugar_config['bulk_import_settings']['modules']['Users']['sugar_key_field'] = 'ext_key_c';
            $sugar_config['bulk_import_settings']['modules']['Users']['external_key_field'] = 'external_key';
            $sugar_config['bulk_import_settings']['modules']['Users']['sql_query'] = "select id_c from users_cstm where ext_key_c = ?";
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_before_save']['file'] = 'custom/modules/Users/UsersBulkImport.php';
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_before_save']['class'] = 'UsersBulkImport';
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_before_save']['method'] = 'usersBeforeSave';
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_after_save']['file'] = 'custom/modules/Users/UsersBulkImport.php';
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_after_save']['class'] = 'UsersBulkImport';
            $sugar_config['bulk_import_settings']['modules']['Users']['custom_after_save']['method'] = 'usersAfterSave';
            $sugar_config['bulk_import_settings']['modules']['Accounts']['sugar_key_field'] = 'ext_key_c';
            $sugar_config['bulk_import_settings']['modules']['Accounts']['external_key_field'] = 'external_key';
            $sugar_config['bulk_import_settings']['modules']['Accounts']['sql_query'] = "select id_c from accounts_cstm where ext_key_c = ?";
            $sugar_config['bulk_import_settings']['modules']['Contacts']['sugar_key_field'] = 'ext_key_c';
            $sugar_config['bulk_import_settings']['modules']['Contacts']['external_key_field'] = 'external_key';addToResponseArray
            $sugar_config['bulk_import_settings']['modules']['Contacts']['sql_query'] = "select id_c from contacts_cstm where ext_key_c = ?";
            $sugar_config['bulk_import_settings']['relationships']['Accounts']['contacts']['external_key_field_left'] = 'left_external_key';
            $sugar_config['bulk_import_settings']['relationships']['Accounts']['contacts']['external_key_field_right'] = 'right_external_key';
        */
    }

    /**
     * @return array
     */
    private function getAllowedModules() {
        return array_keys($this->import_settings['modules']);
    }

    /**
     * @param string $module
     * @param string $linkfield
     * @return array
     */
    private function getExternalRelationshipKeys($module, $linkfield) {
        if(!empty($module) && !empty($linkfield) && !empty($this->import_settings['relationships'][$module][$linkfield])) {
            return $this->import_settings['relationships'][$module][$linkfield];
        }

        return array();
    }

    /**
     * @param string $module
     * @return string|void
     */
    private function getSugarKeyFieldForModule($module) {
        if(!empty($module) && !empty($this->import_settings['modules'][$module]['sugar_key_field'])) {
            return $this->import_settings['modules'][$module]['sugar_key_field'];
        }

        return '';
    }

    /**
     * @param string $module
     * @return string|void
     */
    private function getCreateOnly($module) {
        if(!empty($module) && !empty($this->import_settings['modules'][$module]['create_only'])) {
            return $this->import_settings['modules'][$module]['create_only'];
        }
        return false;
    }

    /**
     * @param string $module
     * @return string|void
     */
    private function getDeletionKeyForModule($module) {
        if(!empty($module) && !empty($this->import_settings['modules'][$module]['deletion_key'])) {
            return $this->import_settings['modules'][$module]['deletion_key'];
        }
        return '';
    }

    /**
     * @param string $module
     * @return string|void
     */
    private function getExternalKeyFieldForModule($module) {
        if(!empty($module) && !empty($this->import_settings['modules'][$module]['external_key_field'])) {
            return $this->import_settings['modules'][$module]['external_key_field'];
        }
        
        return '';
    }

    /**
     * @param string $module
     * @return string|void
     */
    private function writeSQLQuery($module) {
        if(!empty($module) && !empty($this->import_settings['modules'][$module]['sql_query'])) {
            return $this->import_settings['modules'][$module]['sql_query'];
        }

        return '';
    }
}
