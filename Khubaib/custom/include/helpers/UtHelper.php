<?php

//Sarmad Parvez

/**
* A trait to get common utilities
*/
trait UtHelper
{

    /**
    * @codeCoverageIgnore
    */
    protected function getSugarConfig()
    {
        return SugarConfig::getInstance();
    }

    /**
    * @codeCoverageIgnore
    */
    protected function getSugarQuery()
    {
        return new SugarQuery();
    }
}
