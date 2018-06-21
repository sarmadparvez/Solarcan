<?php

class Db
{
    private $_connection;
    private static $_instance; //The single instance
    private $_host;
	private $_port;
    private $_username;
    private $_password;
    private $_database;
	const DELETE_PUSH_TO_VOXCO_SQL = "DELETE FROM [SugarCRMBridge].[dbo].[pushToVoxco] where ";
	/*const PUSH_TO_VXCO_TEMP = '#phushToVoxcoTemp'; //temporary table to push campagin list database
	const PUSH_TO_VXCO_TEMP_SQL = "
	IF OBJECT_ID('tempdb.#phushToVoxcoTemp') IS NOT NULL DROP TABLE #phushToVoxcoTemp;
	CREATE TABLE #phushToVoxcoTemp(
		[SugarCRMID] [varchar](100) NOT NULL,
		[dbName] [varchar](25) NOT NULL,
		[ResLang] [int] NOT NULL,
		[ResBlocked] [bit] NOT NULL,
		[ResWaveImportNo] [int] NOT NULL,
		[ResActive] [bit] NOT NULL,
		[RpsRegionI] [varchar](50) NOT NULL,
		[RpsPhoneI] [varchar](20) NOT NULL,
		[action] [varchar](20) NULL,
		[modified] [datetime] NULL,
		[isImported] [int] NULL CONSTRAINT [DF_pushToVoxco_isImported]  DEFAULT ((0)),
		[sugar_campaign_id] [varchar](50) NOT NULL,
		CONSTRAINT idx_campaign_contact UNIQUE (SugarCRMID, sugar_campaign_id)
	); "; */
	const PUSH_TO_VOXCO_INSERT_SQL = "
		TRUNCATE TABLE pushToVoxco_temp; 
		INSERT INTO pushToVoxco_temp (
			SugarCRMID,
			dbName,
			ResLang,
			ResActive,
			RpsRegionI,
			RpsPhoneI,
			modified,
			action,
			sugar_campaign_id,
                        RpsFirstNameI,
                        RpsLastNameI
		) values ";
	
	const PUSH_TO_VOXCO_UPSERT_SQL = "
	MERGE pushToVoxco AS t
	USING pushToVoxco_temp AS s
	ON (s.SugarCRMID = t.SugarCRMID AND s.sugar_campaign_id = t.sugar_campaign_id)
	WHEN NOT MATCHED BY TARGET
	THEN INSERT(
		SugarCRMID,
		dbName,
		ResLang,
		ResActive,
		RpsRegionI,
		RpsPhoneI,
		modified,
		action,
		sugar_campaign_id
	) VALUES(s.SugarCRMID, s.dbName, s.ResLang, s.ResActive, s.RpsRegionI,
	s.RpsPhoneI,s.modified,s.action, s.sugar_campaign_id)
	WHEN MATCHED 
    THEN UPDATE SET 
	t.SugarCRMID = s.SugarCRMID,
	t.dbName = s.dbName,
	t.ResLang = s.ResLang,
	t.ResActive = s.ResActive,
	t.RpsRegionI = s.RpsRegionI,
	t.RpsPhoneI = s.RpsPhoneI,
	t.modified = s.modified,
	t.action = CASE 
	WHEN s.action = 'add' AND t.action = 'delete' THEN 'add' 
	WHEN s.action = 'add' AND t.action != 'delete' THEN 'update'
	ELSE s.action END,
	t.sugar_campaign_id = s.sugar_campaign_id; ";
    
    /**
    Function: getInstance
    Get an instance of the Database
    @return Instance
    */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    // Constructor
    private function __construct()
    {
		putenv('ODBCSYSINI=/etc');
		putenv('ODBCINI=/etc/odbc.ini');
        try {
        	global $app_config;
        	$this->_host = $app_config['db_config']['hostname'];
        	$this->_username = $app_config['db_config']['username'];
        	$this->_password = $app_config['db_config']['password'];
        	$this->_database = $app_config['db_config']['db_name'];
			$this->_port = $app_config['db_config']['port'];

            //$this->_connection  = new \PDO("sqlsrv:server=$this->_host;database=$this->_database", $this->_username, $this->_password);
			
			$server = $this->_host;
			if (!empty($this->_port)) {
				$server.= ",$this->_port";
			}
			$this->_connection = new PDO("odbc:Driver=ODBC Driver 17 for SQL Server; Server=$server; Database=$this->_database;",
				$this->_username, $this->_password
			);
		} catch (PDOException $e) {
        	Application::getLogger()->error($e->getMessage());
        	die();	
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone()
    {
    }
    // Get mysql pdo connection
    public function getConnection()
    {
        return $this->_connection;
    }
}
