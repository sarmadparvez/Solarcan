<?php
/**
 * ContactsPortalApi
 */

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}

require_once 'modules/Contacts/clients/base/api/ContactsApi.php';

class ContactsPortalApi extends ContactsApi
{
    protected $accountFields = array(
        'annee_construction',
        'nombre_portes_total',
        'nombre_fenetres_total',
        'nombre_garage_total',
        'nombre_portes_achanger',
        'nombre_fenetres_achanger',
        'nombre_garage_achanger'
    );
    public function registerApiRest()
    {
        return array(
            'get_Contact' => array(
                'reqType' => 'GET',
                'path' => array('getPortalContact', '<module>', '?'),
                'pathVars' => array('endpoint', 'module', 'record'),
                'method' => 'retrieveRecord',
                'shortHelp' => 'return requested contact and its related account data',
                'longHelp' => '',
            ),
        );
    }

    /**
     * @Override
    */
    public function retrieveRecord($api, $args) {
        $data = parent::retrieveRecord($api, $args);
        
        // Retrieve account's data
        $accountBean = $this->loadBean(
            $api,
            array('module' => 'Accounts', 'record' => $data['account_id']),
            'view'
        );
        $account_data = $this->formatBean(
            $api,
            array('module' => 'Accounts', 'record' => $data['account_id']),
            $accountBean
        );

        foreach ($this->accountFields as $field) {
            $data[$field] = $account_data[$field];
        }

        return $data;
    }
}
