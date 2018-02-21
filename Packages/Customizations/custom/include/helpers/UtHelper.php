<?php

/**
* This trait will provide common utilities
*/
trait UtHelper
{
	/**
	* @codeCoverageIgnore
	* @return Configurator
	*/
	protected function getConfigurator()
	{
		return new Configurator();
	}

	/**
	* @codeCoverageIgnore
	* @return SugarConfig
	*/
	protected function getSugarConfig()
	{
		return SugarConfig::getInstance();
	}

	/**
	* @codeCoverageIgnore
	* @return Timedate
	*/
	protected function getTimeDate()
	{
		return Timedate::getInstance();
	}

	/**
	* @codeCoverageIgnore
	* @return Timedate
	*/
	protected function getSugarQuery()
	{
		return new SugarQuery();
	}

	/**
	* @codeCoverageIgnore
	* @return Timedate
	*/
	protected function getNewBean($module, $options = array() )
	{
		return BeanFactory::newBean($module);
	}

	/**
	* @codeCoverageIgnore
	* @return Timedate
	*/
	protected function retrieveBean($module, $id = null, $options = array(), $deleted = true)
	{
		return BeanFactory::retrieveBean($module, $id, $options, $deleted);
	}
}
