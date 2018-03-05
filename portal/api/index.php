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

/*$app->get('/wines', 'getWines');
$app->get('/wines/:id',	'getWine');
$app->get('/wines/search/:query', 'findByName');
$app->post('/wines', 'addWine');
$app->put('/wines/:id', 'updateWine');
$app->delete('/wines/:id',	'deleteWine');*/

$app->post('/user',	'addUser');
$app->post('/user/login', 'login');
$app->get('/checkLogin', 'checkLogin');
$app->post('/logout', 'logout');
$app->post('/getAvailableAppointments', authorize(), 'getAvailableAppointments');
$app->post('/bookAppointment', authorize(), 'bookAppointment');
$app->post('/saveInfoandAccount', authorize(), 'saveInfoandAccount');

$app->run();

function addUser()
{
	//code for signup goes here
	$app = Application::getInstance();
	$request = Slim::getInstance()->request();
	$tm = json_decode($request->getBody());
	$app->addUser($tm);
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

function getWines() {
	$sql = "select * FROM wine ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		// echo '{"wine": ' . json_encode($wines) . '}';
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getWine($id) {
	$sql = "SELECT * FROM wine WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$wine = $stmt->fetchObject();  
		$db = null;
		echo json_encode($wine); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addWine() {
	error_log('addWine\n', 3, '/var/tmp/php.log');
	$request = Slim::getInstance()->request();
	$wine = json_decode($request->getBody());
	$sql = "INSERT INTO wine (name, grapes, country, region, year, description, picture) VALUES (:name, :grapes, :country, :region, :year, :description, :picture)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $wine->name);
		$stmt->bindParam("grapes", $wine->grapes);
		$stmt->bindParam("country", $wine->country);
		$stmt->bindParam("region", $wine->region);
		$stmt->bindParam("year", $wine->year);
		$stmt->bindParam("description", $wine->description);
		$stmt->bindParam("picture", $wine->picture);
		$stmt->execute();
		$wine->id = $db->lastInsertId();
		$db = null;
		echo json_encode($wine); 
	} catch(PDOException $e) {
		error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateWine($id) {
	$request = Slim::getInstance()->request();
	$body = $request->getBody();
	$wine = json_decode($body);
	$sql = "UPDATE wine SET name=:name, grapes=:grapes, country=:country, region=:region, year=:year, description=:description, picture=:picture WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $wine->name);
		$stmt->bindParam("grapes", $wine->grapes);
		$stmt->bindParam("country", $wine->country);
		$stmt->bindParam("region", $wine->region);
		$stmt->bindParam("year", $wine->year);
		$stmt->bindParam("description", $wine->description);
		$stmt->bindParam("picture", $wine->picture);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($wine); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteWine($id) {
	$sql = "DELETE FROM wine WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function findByName($query) {
	$sql = "SELECT * FROM wine WHERE UPPER(name) LIKE :query ORDER BY name";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";  
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="";
	$dbname="cellar";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}
