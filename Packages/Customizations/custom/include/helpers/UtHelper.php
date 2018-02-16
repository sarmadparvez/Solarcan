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
}
