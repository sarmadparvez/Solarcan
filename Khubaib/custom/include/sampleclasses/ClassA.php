<?php

//Sarmad Parvez

require_once('custom/include/helpers/UtHelper.php');
class ClassA
{
    use UtHelper;

    public function functionA()
    {
        $data = $this->getDataFromDbForA();
        
        if (count($data) == 0) {
            throw new SugarApiExceptionInvalidParameter();
        } else if($data[0]['title'] == 'Sales Manager') {
            return "1";
        } else if ($data[0]['title'] == 'Sales Trainer') {
            return "2";
        } 
        return "invalid";
    }
    
    /**
    * gets contact title from database for id = 1
    */
    protected function getDataFromDbForA()
    {
        $sugar_query = $this->getSugarQuery();
        $sugar_query->select(array('title'));
        $sugar_query->from(BeanFactory::newBean('Contacts'), array('team_security' => false));
        $sugar_query->where()->equals('id', '1');
        $row = $sugar_query->execute();
        return $row;
    }
    
}