<?php

//Sarmad Parvez

if(!defined('sugarEntry')) define('sugarEntry', true);

set_include_path(
    dirname(__FILE__) . PATH_SEPARATOR .
    dirname(__FILE__) . '/..' . PATH_SEPARATOR .
    dirname(__FILE__) . '/../..' . PATH_SEPARATOR .
    get_include_path()
);

// constant to indicate that we are running tests
if (!defined('SUGAR_PHPUNIT_RUNNER'))
    define('SUGAR_PHPUNIT_RUNNER', true);

// initialize the various globals we use
global $sugar_config, $db, $fileName, $current_user, $locale, $current_language;
if ( !isset($_SERVER['HTTP_USER_AGENT']) )
    // we are probably running tests from the command line
    $_SERVER['HTTP_USER_AGENT'] = 'cli';

chdir(dirname(__FILE__) . '/../..');

// this is needed so modules.php properly registers the modules globals, otherwise they
// end up defined in wrong scope
global $beanFiles, $beanList, $objectList, $moduleList, $modInvisList, $bwcModules, $sugar_version, $sugar_flavor;
require_once 'include/entryPoint.php';
require_once 'include/utils/layout_utils.php';

chdir(sugar_root_dir());

$GLOBALS['db'] = DBManagerFactory::getInstance();
$current_language = $sugar_config['default_language'];
// disable the SugarLogger
$sugar_config['logger']['level'] = 'fatal';

$GLOBALS['sugar_config']['default_permissions'] = array (
        'dir_mode' => 02770,
        'file_mode' => 0777,
        'chown' => '',
        'chgrp' => '',
    );

$GLOBALS['js_version_key'] = 'testrunner';

if ( !isset($_SERVER['SERVER_SOFTWARE']) )
    $_SERVER["SERVER_SOFTWARE"] = 'PHPUnit';

// helps silence the license checking when running unit tests.
$_SESSION['VALIDATION_EXPIRES_IN'] = 'valid';


class Rt_PHPUnit_Framework_TestCase extends PHPUnit_Framework_TestCase
{
     /**
     * @param null|array $methods
     * @return \RestService
     */
    protected function getRestServiceMock($methods = null)
    {
        return $this->getMockBuilder('RestService')
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * Call a protected method on a class
     *
     * @param Object $classOrObject The Class we are working on
     * @param String $method The method name to call
     * @param array $args Arguments to pass to the method
     * @return mixed What ever is returned from the called method
     */
    protected function callProtectedMethod($classOrObject, $method, $args = array())
    {
        $rm = new \ReflectionMethod($classOrObject, $method);
        $rm->setAccessible(true);
        $object = is_object($classOrObject) ? $classOrObject : null;
        return $rm->invokeArgs($object, $args);
    }

    /**
     * Used to set the value of a protected or private variable
     *
     * @param Object $object THe Class we are trying to set a property on
     * @param string $property The name of the property
     * @param string $value The value for the property
     */
    protected function setProtectedValue($object, $property, $value)
    {
        $ro = new \ReflectionObject($object);
        $rp = $ro->getProperty($property);
        $rp->setAccessible(true);
        $rp->setValue($object, $value);
    }

    /**
     * Used to get the value of a protected or private variable
     *
     * @param Object $object THe Class we are trying to set a property on
     * @param string $property The name of the property
     * @return mixed What ever is stored in the property
     */
    protected function getProtectedValue($object, $property)
    {
        $ro = new \ReflectionObject($object);
        $rp = $ro->getProperty($property);
        $rp->setAccessible(true);
        return $rp->getValue($object);
    }
}
