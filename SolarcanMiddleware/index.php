<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// script execution time set to unlimited as script can take alot of time to sync data
set_time_limit(0);

define('ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
set_include_path(ROOT);

require_once('config.php');
require_once('src/Application.php');
require_once('src/Db.php');
require_once('vendor/autoload.php');
require_once('src/RestCurlClient.php');

date_default_timezone_set($app_config['logs_time_zone']); // for logs generated in logs directory
$app = new Application();
$app->start();
