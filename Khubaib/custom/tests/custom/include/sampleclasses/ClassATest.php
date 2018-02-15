<?php

//Sarmad Parvez

require_once('custom/include/sampleclasses/ClassA.php');

/*
* Functional test
*/
class ClassATest extends Rt_PHPUnit_Framework_TestCase
{
    /**
    * This is called before every unit test execution
    * create test data in this function which is required for our code being tested
    */
    public function setUp()
    {
        global $db;
        $db->query(
            "Replace INTO `contacts` (id, title) VALUES('1', 'Sales Manager')"
        );
        parent::setUp();
    }
    /**
    * unit test for ClassA::functionA
    */
    public function testFunctionA()
    {       
        $obj = new ClassA();
        $result = $obj->functionA();
        $this->assertEquals("1", $result);
    }
    
    /**
    * Delete test data after unit test execution
    * This is called after every unit test execution
    */
    public function tearDown()
    {
        global $db;
        $db->query("DELETE FROM contacts WHERE id  = '1'");
        parent::tearDown();
    }
}