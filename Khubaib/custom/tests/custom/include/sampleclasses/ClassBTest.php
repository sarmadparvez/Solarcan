<?php

//Sarmad Parvez

require_once('custom/include/sampleclasses/ClassB.php');

/*
* Unit test example for dataprovider concept and testing exception
*/
class ClassBTest extends RT_PHPUnit_Framework_TestCase
{
    /**
    * this function tests ClassB::functionB success scenarios
    * @dataProvider functionBSuccessDataProvider
    */
    public function testFunctionBSuccess($result, $expected)
    {
        $obj = $this->getMockBuilder('ClassB')
            ->setMethods(['getDataFromDbForB'])
            ->getMock();

        $obj->expects($this->once())->method('getDataFromDbForB')->will($this->returnValue($result));
        $result = $obj->functionB();
        $this->assertEquals($expected, $result);
    }
    
    /*
     * data provider for testFunctionBSuccess
     */
    public function functionBSuccessDataProvider()
    {
        return [
            [
                'result' => [
                    0 => ['title' => 'Sales Manager'],
                ],
                'expected' => '1'
            ],
            [
                'result' => [
                    0 => ['title' => 'Sales Trainer'],
                ],
                'expected' => '2',
            ],
            [
                'result' => [
                    0 => ['title' => "Project Manager"],
                ],
                'expected' => 'invalid',
            ],
            
        ];
    }
    
    /**
    * this function tests ClassB::functionB failure scenarios
    * @dataProvider functionBfailureDataProvider
    */
    public function testFunctionBFailure($result, $expected)
    {
        $obj = $this->getMockBuilder('ClassB')
            ->setMethods(['getDataFromDbForB'])
            ->getMock();

        $obj->expects($this->once())->method('getDataFromDbForB')->will($this->returnValue($result));
        $this->setExpectedException($expected);
        $result = $obj->functionB();
    }
    
    /*
     * data provider for testFunctionBFailure
     */
    public function functionBfailureDataProvider()
    {
        return [
            [
                'result' => [
                    0 => ['title' => ''],
                ],
                'expected' => 'SugarApiExceptionInvalidParameter'
            ],
            [
                'result' => [
                    0 => ['title' => null],
                ],
                'expected' => 'SugarApiExceptionInvalidParameter',
            ],
            [
                'result' => [],
                'expected' => 'SugarApiExceptionInvalidParameter'
            ],
        ];
    }
    
    /**
     * @dataProvider getDataFromDbForBDataProvider
    */
    public function testGetDataFromDbForB($result, $expected)
    {
        $obj = $this->getMockBuilder('ClassB')
            ->setMethods(['getSugarQuery'])
            ->getMock();

        $sugar_query_mock = $this->getMockBuilder('SugarQuery')
            ->setMethods(['execute'])
            ->getMock();
        $sugar_query_mock->expects($this->once())->method('execute')->will($this->returnValue($result));
        $obj->expects($this->once())->method('getSugarQuery')->will($this->returnValue($sugar_query_mock));
        $data = $this->callProtectedMethod($obj, 'getDataFromDbForB');
        $this->assertEquals($expected, $data);
        
    }

    /**
    * data provider for testGetDataFromDbForB
    */
    public function getDataFromDbForBDataProvider()
    {
        return [
            [
                'result' => [
                    0 => ['title' => 'foo'],
                ],
                'expected' => [
                    0 => ['title' => 'foo'],
                ],
            ]
        ];
    }

}