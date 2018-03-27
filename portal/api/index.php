<?php
session_start();
require_once('Slim/Slim.php');

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR . '../');
set_include_path(ROOT);

require_once('config.php');
require_once('vendor/autoload.php');
require_once('api/RestCurlClient.php');
require_once('api/Application.php');

//initializing the global $logger
$logger = new Katzgrau\KLogger\Logger($app_config['log_dir']);
$app = new Slim();

$app->post('/contact', authorize(), 'getContact');
$app->post('/user/login', 'login');
$app->get('/checkLogin', 'checkLogin');
$app->post('/logout', 'logout');
$app->post('/getAvailableAppointments', authorize(), 'getAvailableAppointments');
$app->post('/bookAppointment', authorize(), 'bookAppointment');
$app->post('/saveInfoandAccount', authorize(), 'saveInfoandAccount');

$app->run();

/**
* Get contact information based on the id 
*/
function getContact()
{
	$app = Application::getInstance();
	$app->getContact();
}

/**
* Login user and save login info in session
*/
function login()
{
	//global $logger;
	//$logger->debug('session: '. print_r($_SESSION, 1));
	$app = Application::getInstance();
	$app->login();
}

/**
* Destroy session to logout user
*/
function logout()
{
	session_destroy();
	echo json_encode(array('result' => true));
}

/**
* Check if user is logged in
*/
function checkLogin()
{
	//global $logger;
	//$logger->debug('session: '. print_r($_SESSION, 1));
    if (!empty($_SESSION['user']['role'])) {
        echo json_encode(array('result' => true));
    } else {
        $app = Slim::getInstance();
        $app->halt(401, 'Unauthorized!');
    }
}

/**
 * Authorise function, used as Slim Route Middlewear
 */
function authorize($role = "user") {
    return function () use ( $role ) {
    	//global $logger;
    	//$logger->info('session: '.print_r($_SESSION,1));
        // Get the Slim framework object
        $app = Slim::getInstance();
        // First, check to see if the user is logged in at all
        if(!empty($_SESSION['user'])) {
            // Next, validate the role to make sure they can access the route
            // We will assume admin role can access everything
            if($_SESSION['user']['role'] == $role) {
                //User is logged in and has the correct permissions... Nice!
                return true;
            }
        } else {
            // If a user is not logged in at all, return a 401
            $app->halt(401, 'Unauthorized!');
        }
    };
}

/**
* Get available appointments from SugarCRM
*/
function getAvailableAppointments()
{
	$app = Application::getInstance();
	$app->getAvailableAppointments();
}

/**
* Book Appointment in CRM
*/
function bookAppointment()
{
	$app = Application::getInstance();
	$app->bookAppointment();
}
/**
* Save Info and Account
*/
function saveInfoandAccount()
{
	$app = Application::getInstance();
	$app->saveInfoandAccount();	
}
