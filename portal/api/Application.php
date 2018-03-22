<?php

/**
* Application start and control
*/
class Application
{
    private static $_instance; //The single instance
    private static $logger; // logger object
    private static $api_client; // curl api client
    private $sugar_access_token; // access_token to communicate with sugar rest api
    private $sugar_refresh_token; // refresh token for SugarCRM

    private function __construct()
    {
        //instantiate logger object
        self::getLogger();
    }

    /**
    Function: getInstance
    Get an instance of the Application
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
    * Function: getLogger
    * Get Instance of logger class
    */
    public static function getLogger()
    {
        if (empty(self::$logger)) {
            global $app_config;
            self::$logger = new Katzgrau\KLogger\Logger($app_config['log_dir']);
        }
        return self::$logger;
    }

    /**
    * Function: getApiClient
    * Get Instance of this class
    */
    protected static function getApiClient()
    {
        if (empty(self::$api_client)) {
            self::$api_client = new RestCurlClient();
        }
        return self::$api_client;
    }

    /**
    * Function: getApiUrl
    * Get url of sugar rest api
    */
    protected function getApiUrl()
    {
        global $app_config;
        if(!empty($app_config['sugar_api_url'])) {
            return $app_config['sugar_api_url'];
        }
        return false;
    }

    /**
    * Function: getInstance
    * Get Instance of this class
    */
    protected function getSugarAuthToken($grant_type = 'password')
    {
        $client = self::getApiClient();
        $url = $this->getApiUrl() . '/oauth2/token';
        global $app_config;
        $params = array(
            "grant_type" => $grant_type,
            "client_id" => "sugar",
            "client_secret" => "",
            "username" => $app_config['sugar_username'],
            "password" => $app_config['sugar_password'],
            "platform" => "portal-integration" 
        );
        if ($grant_type == 'refresh_token') {
            $params['refresh_token'] = $this->sugar_refresh_token;
        }
        try {
            $res = $client->post(
              $url, json_encode($params),
              array(
                CURLOPT_HTTPHEADER => array(
                  'Content-Type: application/json'
                )
              )
            );
        } catch (Exception $e) {
            self::$logger->error($e->getMessage());
            self::$logger->error($e->getTraceAsString());
            die();
        }

        // if successfully got access token from sugar
        if (isset($res['access_token'])) {
            $this->sugar_access_token = $res['access_token'];
            $this->sugar_refresh_token = $res['refresh_token'];
            return $res['access_token'];
        } else {
            // else log the response
            self::$logger->error('Access token not found. login response: '.print_r($res,1));
            die();
        }
    }

    public function addUser($tm)
    {
        global $app_config;
        try 
        {
            $client = self::getApiClient();
            $oauth_token = empty($this->sugar_access_token) ? 
                            $this->getSugarAuthToken() : $this->sugar_access_token;

            $tm->name = $tm->prenom.' '.$tm->nom;

            $res = $client->post(
                $app_config['sugar_api_url'].'/tm_telemarketers',
                json_encode($tm),
                array(
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'oauth-token: ' . $oauth_token
                    )
                )
            );
            echo json_encode(array('result' => $res));

        } catch (Exception $e) {
            self::$logger->error($e->getMessage());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired, regenerate it
                self::$logger->error('regenerating access token');
                $this->getSugarAuthToken('refresh_token');
            } elseif ($e->getCode() == 422) {
                $msg = json_encode($e->getMessage());
                echo json_encode(array('error' => 422, 'error_message' => $e->getMessage()));
            } else {
                // safely terminate
            }
        }
    }

    /**
    * retrieve a user from sugarcrm
    */
    public function login()
    {
        global $app_config;
        try
        {
            $oauth_token = empty($this->sugar_access_token) ? 
                $this->getSugarAuthToken() : $this->sugar_access_token;
            $url =  $this->getApiUrl().'/tm_telemarketers';
            $url.= "?max_num=20&order_by=date_modified%3Adesc&filter%5B0%5D%5Bnoagent%5D=".$_REQUEST['noagent']."&filter%5B1%5D%5Bpassword%5D=".$_REQUEST['password'];
            self::$logger->info('url: '.$url);
            $client = self::getApiClient();
            $res = $client->get(
                $url,
                array(
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      'oauth-token: ' . $oauth_token
                    )
                )
            );
            //self::$logger->info('result: '.print_r($res,1));
            if (count($res['records']) == 1 && !empty($res['records'][0]['id'])) {
                echo json_encode(array('result' => true, 'id' => $res['records'][0]['id']));
                $user = array(
                    "noagent"=>$_REQUEST['noagent'], 
                    "role"=>"user"
                );
                $_SESSION['user'] = $user;
            } else if (count($res['records']) == 0){
                throw new PortalApiExceptionInvalidParameter('Invalid Credentials !', 422);
            } else if (count($res['records']) > 1){
                throw new PortalApiExceptionInvalidParameter(
                    'Unable to login. Mutiple users found with same NOAGENT',
                    422
                );
            }
        } 
        catch (Exception $e) {
            self::$logger->error('caught exception: '.$e->getMessage() . ' : code: '. $e->getCode());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired, regenerate it
                self::$logger->error('SugarCRM access token expired');
            } else {
                //safely return
                echo json_encode(
                    array(
                      'error' => array(
                            'msg' => $e->getMessage(),
                            'code' => $e->getCode()
                        ),
                    )
                );
            }
        }
    }

    /**
    * Get contact information based on the id 
    */
    public function getContact()
    {
        // self::$logger->info('REQUEST: '.print_r($_REQUEST, 1));
        try {
            $required_args = array(
                'id'
            );
            //require arguments
            $this->requireArgs($_REQUEST, $required_args);
            $oauth_token = empty($this->sugar_access_token) ?
                $this->getSugarAuthToken() : $this->sugar_access_token;
            $url =  $this->getApiUrl().'/Contacts/'.$_REQUEST['id'];
            self::$logger->info('url: '.$url);
            $client = self::getApiClient();
            $res = $client->get(
                $url,
                array(
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      'oauth-token: ' . $oauth_token
                    )
                )
            );
            self::$logger->info('Contact: '.print_r($res, 1));
            echo json_encode(array('result' => true, 'records' => $res));
        }
        catch (Exception $e) {
            self::$logger->error('caught exception: '.$e->getMessage() . ' : code: '. $e->getCode());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired
                self::$logger->error('SugarCRM access token expired');
            } else {
                //safely return
                echo json_encode(
                    array(
                      'error' => array(
                            'msg' => $e->getMessage(),
                            'code' => $e->getCode()
                        ),
                    )
                );
            }
        }
    }

    /**
    * Get available appointments from sugarcrm
    */
    public function getAvailableAppointments()
    {
        try{
            $required_args = array(
                'billing_address_postalcode',
                'preferred_language_1',
                'preferred_language_2',
                'codecie_c',
                'categories'
            );
            //require arguments
            $this->requireArgs($_REQUEST, $required_args);
            $oauth_token = empty($this->sugar_access_token) ? 
                $this->getSugarAuthToken() : $this->sugar_access_token;
            $url =  $this->getApiUrl().'/Meetings/getAvailableAppointments';
            self::$logger->info('url: '.$url);
            $client = self::getApiClient();
            $res = $client->post(
                $url,
                json_encode(
                    array(
                        'postalcode' => $_REQUEST['billing_address_postalcode'],
                        'preferred_language_1' => $_REQUEST['preferred_language_1'],
                        'preferred_language_2' => $_REQUEST['preferred_language_2'],
                        'codecie_c' => $_REQUEST['codecie_c'],
                        'categories' => $_REQUEST['categories']
                    )
                ),
                array(
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      'oauth-token: ' . $oauth_token
                    )
                )
            );
            self::$logger->info('result: '.print_r($res,1));
            echo json_encode(array('result' => true, 'records' => $res));
        }
        catch (Exception $e) {
            self::$logger->error('caught exception: '.$e->getMessage() . ' : code: '. $e->getCode());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired
                self::$logger->error('SugarCRM access token expired');
            } else {
                //safely return
                echo json_encode(
                    array(
                      'error' => array(
                            'msg' => $e->getMessage(),
                            'code' => $e->getCode()
                        ),
                    )
                );
            }
        }
    }
    /**
    * Book appointment. Make curl call to SugarCRM
    */
    public function bookAppointment()
    {
        try{
            self::$logger->debug('_REQUEST: '.print_r($_REQUEST,1));
            $required_args = array(
                'meeting_id','contact_id','postalcode','financement',
                'description',
                'contact_model',
                'account_model'
            );
            //require arguments
            $this->requireArgs($_REQUEST, $required_args);
            $oauth_token = empty($this->sugar_access_token) ? 
                $this->getSugarAuthToken() : $this->sugar_access_token;
            $url =  $this->getApiUrl().'/Meetings/bookAppointment';
            self::$logger->info('url: '.$url);
            $client = self::getApiClient();
            $res = $client->post(
                $url,
                json_encode(
                    array(
                        'meeting_id' => $_REQUEST['meeting_id'],
                        'contact_id' => $_REQUEST['contact_id'],
                        'postalcode' => $_REQUEST['postalcode'],
                        /*'phone_home' => $_REQUEST['phone_home'],
                        'phone_work' => $_REQUEST['phone_work'],
                        'phone_other' => $_REQUEST['phone_other'],
                        'phone_mobile' => $_REQUEST['phone_mobile'],*/
                        'financement' => $_REQUEST['financement'],
                        'description' => $_REQUEST['description'],
                        'contact_model' => $_REQUEST['contact_model'],
                        'account_model' => $_REQUEST['account_model'],
                        /*'annee_construction' => $_REQUEST['annee_construction'],
                        'occupant_depuis' => $_REQUEST['occupant_depuis'],
                        'billing_address_street' => $_REQUEST['billing_address_street'],
                        'billing_address_city' => $_REQUEST['billing_address_city'],
                        'billing_address_state' => $_REQUEST['billing_address_state'],
                        'nombre_portes_total' => $_REQUEST['nombre_portes_total'],
                        'nombre_portes_achanger' => $_REQUEST['nombre_portes_achanger'],
                        'nombre_fenetres_total' => $_REQUEST['nombre_fenetres_total'],
                        'nombre_fenetres_achanger' => $_REQUEST['nombre_fenetres_achanger'],
                        'nombre_garage_total' => $_REQUEST['nombre_garage_total'],
                        'nombre_garage_achanger' => $_REQUEST['nombre_garage_achanger'],
                        'etat_de_proprietaire' => $_REQUEST['etat_de_proprietaire']*/
                        'noagent' => $_SESSION['user']['noagent'],
                        'partenaire_info' => isset($_REQUEST['partenaire_info']) ? $_REQUEST['partenaire_info'] : ''
                    )
                ),
                array(
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      'oauth-token: ' . $oauth_token
                    )
                )
            );
            self::$logger->info('result: '.print_r($res,1));
            echo json_encode(array('result' => true, 'res' => $res));
        }
        catch (Exception $e) {
            self::$logger->error('caught exception: '.$e->getMessage() . ' : code: '. $e->getCode());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired
                self::$logger->error('SugarCRM access token expired');
            } else {
                //safely return
                echo json_encode(
                    array(
                      'error' => array(
                            'msg' => $e->getMessage(),
                            'code' => $e->getCode()
                        ),
                    )
                );
            }
        }
    }

    public function saveInfoandAccount()
    {
        try{
            self::$logger->debug('_REQUEST: '.print_r($_REQUEST,1));
            $required_args = array(
                'contact_model',
                'account_model'
            );
            //require arguments
            $this->requireArgs($_REQUEST, $required_args);
            $oauth_token = empty($this->sugar_access_token) ?
                $this->getSugarAuthToken() : $this->sugar_access_token;
            $url =  $this->getApiUrl().'/Meetings/saveInfoandAccount';
            self::$logger->info('url: '.$url);
            $client = self::getApiClient();
            $res = $client->post(
                $url,
                json_encode(
                    array(
                        'contact_model' => $_REQUEST['contact_model'],
                        'account_model' => $_REQUEST['account_model'],
                        'noagent' => $_SESSION['user']['noagent'],
                        'postalcode' => $_REQUEST['contact_model']['billing_address_postalcode'],
                        'partenaire_info' => isset($_REQUEST['partenaire_info']) ? $_REQUEST['partenaire_info'] : ''
                    )
                ),
                array(
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      'oauth-token: ' . $oauth_token
                    )
                )
            );
            self::$logger->info('result: '.print_r($res,1));
            echo json_encode(array('result' => true, 'res' => $res));
        }
        catch (Exception $e) {
            self::$logger->error('caught exception: '.$e->getMessage() . ' : code: '. $e->getCode());
            self::$logger->error($e->getTraceAsString());
            if ($e->getCode() == 401) {
                // access token expired
                self::$logger->error('SugarCRM access token expired');
            } else {
                //safely return
                echo json_encode(
                    array(
                      'error' => array(
                            'msg' => $e->getMessage(),
                            'code' => $e->getCode()
                        ),
                    )
                );
            }
        }
    }

    /**
    * require arguments for the api
    */
    protected function requireArgs($request, $args) 
    {
        foreach ($args as $arg) {
            if (!isset($request[$arg])){
                throw new PortalApiExceptionInvalidParameter(
                    "Missing Parameter $arg",
                    422
                );
            }
        }
    }
}

class PortalApiExceptionInvalidParameter extends Exception{}