<?php

/**
* Application start and control
*/
class Application
{
	private static $logger; // logger object
	private $db; // database object
	private static $api_client; // curl api client
	private $sugar_access_token; // access_token to communicate with sugar rest api
	private $sugar_refresh_token; // refresh token for SugarCRM
	private $sync_log_id; // id of the current sync log record in sync_logs table
	private $lock_file_handle; // to check if script is already running or not 
    private $deleted_records = array();
	function __construct()
	{
		//instantiate logger object
		self::getLogger();

		//instantiate db
		$db = Db::getInstance();
		$this->db = $db->getConnection();
		$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false);
	}

	/**
	* Function: getApiClient
	* Get Instance of this class
	*/
	public static function getApiClient()
	{
		if (empty(self::$api_client)) {
			self::$api_client = new RestCurlClient();
		}
		return self::$api_client;
	}

	/**
	* Function: getApiUrl
	* Get url of sugar rest v10 api
	*/
	public function getApiUrl()
	{
		global $app_config;
		if(!empty($app_config['sugar_api_url'])) {
			return $app_config['sugar_api_url'];
		}
		return false;
	}
	/**
	* Function: getInstance
	* Get Instance of this class
	*/
	public function getSugarAuthToken($grant_type = 'password')
	{
		$client = self::getApiClient();
		$url = $this->getApiUrl() . '/oauth2/token';
		global $app_config;
		$params = array(
			"grant_type" => $grant_type,
			"client_id" => "sugar",
			"client_secret" => "",
			"username" => $app_config['sugar_username'],
			"password" => $app_config['sugar_password'],
			"platform" => "voxco-integration" 
		);
		if ($grant_type == 'refresh_token') {
			$params['refresh_token'] = $this->sugar_refresh_token;
		}
		try {
			$res = $client->post(
			  $url, json_encode($params),
			  array(
				CURLOPT_HTTPHEADER => array(
				  'Content-Type: application/json'
				)
			  )
			);
		} catch (Exception $e) {
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
			$this->updateSyncLogs(false, true);
			die();
		}

		// if successfully got access token from sugar
		if (isset($res['access_token'])) {
			$this->sugar_access_token = $res['access_token'];
			$this->sugar_refresh_token = $res['refresh_token'];
			return $res['access_token'];
		} else {
			// else log the response
			self::$logger->debug('Access token not found. login response: '.print_r($res,1));
			die();
		}
		
	}

	/**
	* Function: getLogger
	* Get Instance of logger class
	*/
	public static function getLogger()
	{
		if (empty(self::$logger)) {
			global $app_config;
			self::$logger = new Katzgrau\KLogger\Logger($app_config['log_dir']);
		}
		return self::$logger;
	}

	/**
	* Maintain sync logs
	*/
	public function updateSyncLogs($start = false, $end = false, $status = 'Completed')
	{
		try {
			if ($start) {
				//generate uuid
				$id_sql = "SELECT NEWID()";
				$stmt = $this->db->query($id_sql);
				$uuid = $stmt->fetchColumn();
				$sql = "INSERT INTO sync_logs (id, start_time, status) values 
					('{$uuid}', GETUTCDATE(), 'In Progress')";
				$this->db->query($sql);
				$this->sync_log_id = $uuid;
			} else if ($end) {
				$sql = "UPDATE sync_logs set  end_time = GETUTCDATE(), status ='".$status."' 
					where id = '{$this->sync_log_id}'";
				$this->db->query($sql);
				// check number of rows in log table
				// get log table maximum size from config, and delete extra rows
				global $app_config;
				$max_log_rows = (int)$app_config['log_table_max_rows'];
				//if ($rowCount > $max_log_rows) {
				$sql = "DELETE FROM sync_logs where id NOT IN 
					(
						SELECT id from 
						(SELECT TOP {$max_log_rows} id FROM sync_logs order by start_time desc) id_table
					)";
				$this->db->query($sql);
				//}
				// release lock file
				// All done; we blank the PID file and explicitly release the lock 
				// (although this should be unnecessary) before terminating.
				ftruncate($this->lock_file_handle, 0);
				flock($this->lock_file_handle, LOCK_UN);
			}
		}
		catch (PDOException $e) {
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
		}
	}

	/**
	* Function: start
	* Start Sync
	*/
	public function start()
	{
		global $app_config;
		// check if script is already running
		if ($this->checkScriptAlreadyRunning())
		{
			//script is already running
			return false;
		}
		// Change In Progress to Failed
		$this->updateFailedSyncStatus();
		if (!$this->validateSyncInterval()) {
			return false;
		}
		$this->updateSyncLogs(true);
		// perform all entities sync
		if (in_array('all', $app_config['entities_to_sync'])) {
			//perform all entities sync
			$this->performPushToSugarCRM();
			$this->PullCamaignListFromSugar();
		} else {
			if (in_array('push_to_sugarcrm', $app_config['entities_to_sync'])) {
				// perform push_to_sugarcrm
				$this->performPushToSugarCRM();
			}
			if (in_array('pull_from_sugarcrm', $app_config['entities_to_sync'])) {
				// perform pull_from_sugarcrm
				$this->PullCamaignListFromSugar();
			}
		}
		$this->updateSyncLogs(false, true);
	}
	
	private function PullCamaignListFromSugar()
	{
		global $app_config;
		$lastsync = '';
		// check if force synced is enabled and we need to sync all records since a default date
		if (empty($app_config['force_pull_from_sugarcrm_all'])) {
			// force sync is not enabled
			// get last sync date
			$lastsync = $this->getLastPullDate('pull_from_sugarcrm');
		}
		// this is the first sync, we need to fetch all records.
		if (empty($lastsync)) {
			// get default first sync datec
			if (!empty($app_config['pull_from_sugarcrm_default'])) {
				$lastsync = $app_config['pull_from_sugarcrm_default'];
			}
		}
		//calculate last sync
		$lastsync_updated = gmdate('Y-m-d H:i:s');
		// make api call to sugar to fetch data and save data in middleware database
		$this->performPullCamaignListFromSugar($lastsync);
		//update last sync in database
		$this->updateLastSync('lastsync_pull_from_sugarcrm', $lastsync_updated);
	}
	
	private function updateLastSync($column, $lastsync)
	{
		try {
			$sql = "update sync_logs set ".$column." = :lastsync where id = :id";
			$stmt = $this->db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$stmt->bindParam(':lastsync', $lastsync);
			$stmt->bindParam(':id', $this->sync_log_id);
			$stmt->execute();
		} catch (PDOException $e){
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
		}
	}
	
	/**
	* Make Curl call to SugarCRM to get CampaignList
	* @param string $lastsync last sync date
	*/
	private function performPullCamaignListFromSugar($lastsync = '')
	{
		global $app_config;
		self::$logger->info('Started Pull Campaign List From SugarCRM ');
		// get limit to fetch number of records from SugarCRM
		if (empty($app_config['pull_from_sugarcrm_chunk_size'])) {
			$limit = '500';
		} else {
			$limit = $app_config['pull_from_sugarcrm_chunk_size'];
		}
		$response = array();
		$offset = '0';
		do {
			$url = $this->getApiUrl() . $app_config['pull_from_sugarcrm_endpoint'] . '?' .
				'limit=' . $limit . '&offset='.$offset . '&lastsync=' .urlencode($lastsync);
			try 
			{
				$client = self::getApiClient();
				$oauth_token = empty($this->sugar_access_token) ? 
					$this->getSugarAuthToken() : $this->sugar_access_token;
				// get records via curl call
				
				$response = $client->get(
					$url,
					array(
						CURLOPT_HTTPHEADER => array(
						  'Content-Type: application/json',
						  'oauth-token: ' . $oauth_token
						)
					)
				);
				//self::$logger->debug('response: '.print_r($response,1));
				//self::$logger->debug('records fetched: '.$response['record_count']);
				if ($response['record_count'] == 0) {
					self::$logger->info('No records found in SugarCRM. Pull From SugarCRM sync completed');
					return;
				}
				//$this->updateSyncStatistics('push_to_sugarcrm', $response);
				$this->writeCampaignListToMiddleware($response, 'pull_from_sugarcrm');
				// if no records found, the sync is either complete or no records exist 
				// in local copy tables
				if ($response['next_offset'] == -1) {
					self::$logger->info('Completed Pull From SugarCRM');
					return;
				}
				$offset = $response['next_offset'];
			} catch (Exception $e) {
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
				if ($e->getCode() == 401) {
					// access token expired, regenerate it
					self::$logger->error('regenerating access token');
					$this->getSugarAuthToken('refresh_token');
				} else {
					$this->updateSyncLogs(false, true, 'Failed');
					die();
					//return false;
				}
			}

		} while ($response['next_offset'] != -1);
	}
	
	/**
	* Update MiddleWare tables when the records are synced
	*/
	private function writeCampaignListToMiddleware($response, $entity)
	{
		global $app_config;
		$table_name = $app_config['entity_to_table'][$entity];
		if (!empty($table_name)) {
			try {
				$sql_data = $this->prepareWriteQueryForCampaignList($response);
				$temp_table_insert_sql = DB::PUSH_TO_VOXCO_INSERT_SQL . $sql_data['sql_insert'];
				// write to temp table
				$this->db->query($temp_table_insert_sql);
				if (!empty($this->deleted_records['contact_id']) && !empty($this->deleted_records['campaign_id'])) {
					$this->db->query(
						"DELETE 
							FROM pushToVoxco_temp
							WHERE sugar_campaign_id = (Select sugar_campaign_id from pushToVoxco where sugar_campaign_id in (".implode(',',array_values($this->deleted_records['campaign_id'])).")
								AND SugarCRMID in (".implode(',',array_values($this->deleted_records['contact_id'])).")
								AND action = 'delete')
							AND SugarCRMID = (Select SugarCRMID from pushToVoxco where sugar_campaign_id in (".implode(',',array_values($this->deleted_records['campaign_id'])).")
								AND SugarCRMID in (".implode(',',array_values($this->deleted_records['contact_id'])).")
								AND action = 'delete')");
				}
				// upsert
				$this->db->query(DB::PUSH_TO_VOXCO_UPSERT_SQL);
				
			} catch (PDOException $e){
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
			}
		} else {
			self::$logger->error('config attribute entity_to_table is empty for entity : ' . $entity);
			die();
		}
	}

	/**
	* Prepare mass insert query. The data will be inserted in temporary table to perform upsert.
	*/
	private function prepareWriteQueryForCampaignList($response)
	{
		
		$sql_insert = '';
		$sep = '';
		$sql_delete = '';
		$sep_delete = '';

		foreach ($response['records'] as $record)
		{ self::$logger->error($record['campaign_deleted']);
			$action = 'insert';
			if ( $record['campaign_deleted'] == '1' || $record['plc_deleted'] == '1' || 
				 $record['plp_deleted'] == '1' || $record['contact_deleted'] || $record['pli_deleted'] == '1' ) {
					 // set action value as delete
					 $action = 'delete';
					 $this->deleted_records['contact_id'][] = $this->quoted($record['contact_id']);
					 $this->deleted_records['campaign_id'][] = $this->quoted($record['campaign_id']);
					 //record is deleted in sugarcrm
					 /* $sql_delete .= $sep_delete . ' ( ';
					 $sql_delete .= 'SugarCRMID = ' . $this->db->quote($record['contact_id']);
					 $sql_delete .= ' AND sugar_campaign_id = ' . $this->db->quote($record['campaign_id']) . ' )';
					 
					 $sep_delete = ' OR ';*/
			} else {
				// set action value as update
				//record is added or updated
				$action = 'add';
			}
			$sql_insert .= $sep . " ( ";
			$sql_insert .= $this->quoted($record['contact_id']) . ', ';
			$sql_insert .= $this->quoted($record['dbName']) . ', ';
			$sql_insert .= $this->quoted($record['ResLang']) . ', ';
			$sql_insert .= $this->quoted($record['ResActive']) . ', ';
			$sql_insert .= $this->quoted($record['RpsRegionI']) . ', ';
			$sql_insert .= $this->quoted($record['phone_home']) . ', ';
			$sql_insert .= $this->quoted($record['modified']) . ', ';
			$sql_insert .= $this->quoted($action) . ', ';
			$sql_insert .= $this->quoted($record['campaign_id']) . ', ';
			$sql_insert .= $this->quoted($record['first_name']) . ', ';
			$sql_insert .= $this->quoted($record['last_name']) . ') ';
			
			$sep = ',';
		}
		
		return array(
			'sql_insert' => $sql_insert,
		);
	}
	
	/**
	 * Return string properly quoted with ''
	 * @param string $string
	 * @return string
	 */
	public function quoted($string)
	{
		return "'".$this->quote($string)."'";
	}
	
    /**
     * @see DBManager::quote()
     */
    private function quote($string)
    {
        return str_replace("'","''", $this->quoteInternal($string));
    }

		/**
	 * Pre-process string for quoting
	 * @internal
	 * @param string $string
     * @return string
     */
	private function quoteInternal($string)
	{
		return $this->decodeHTML($string);
	}
	
	/**
	 * Replaces specific HTML entity values with the true characters
	 * @param string $string String to check/replace
	 * @param bool $encode Default true
	 * @return string
	 */
	private function decodeHTML($string)
	{
		if (!is_string($string)) {
			return $string;
		}
		return htmlspecialchars_decode($string, ENT_QUOTES);
	}
	
	
	/**
	* Get last sync date from database
	*/
	private function getLastPullDate($entity = '')
	{
		if (empty($entity)) {
			return false;
		}
		$column = 'lastsync_'.$entity;
		$sql = "select TOP 1 $column from sync_logs order by $column desc ";
		try {
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$lastsync = $stmt->fetchColumn(0);
			return $lastsync;
		} catch (PDOException $e) {
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
			die();
		}
	}

	/**
	* Cron handling, to run the script only after the interval set in config.php
	* By default return true if no interval is set
	*/
	private function validateSyncInterval()
	{
		global $app_config;
		if (isset($app_config['sync_interval'])) {
			// dont run the sync until this interval is passed
			$minutes = 0;
			if (isset($app_config['sync_interval']['minutes']) &&
				!empty($app_config['sync_interval']['minutes'])) {
				$minutes += (int)$app_config['sync_interval']['minutes'];
			}
			if (isset($app_config['sync_interval']['hours']) &&
				!empty($app_config['sync_interval']['hours'])) {
				$minutes += (int)$app_config['sync_interval']['hours'] * 60; //converting into minutes
			}
			try {
				if ($minutes > 0) {
					// get difference in minutes from last sync
					$id = $this->checkLastSync();
					if (!empty($id)) {
						$sql = "SELECT DATEDIFF(MINUTE, end_time, GETUTCDATE()) as mins
							from sync_logs where id = '{$id}'";
							$stmt = $this->db->prepare($sql);
							$stmt->execute();
							$mins_last_sync = $stmt->fetchColumn(0);
							if ($mins_last_sync < $minutes) {
								// not $minutes passed since last sync
								return false;
							}
					}
				}
			}
			catch (PDOException $e) {
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
				return false;
			}
		}
		return true;
	}

	/**
	* Change any records in sync_info table status to Failed where status in progress
	* Because we arleady checked that sync is not already running
	*/
	private function updateFailedSyncStatus()
	{
		try {
			$sql = "SELECT count(id) FROM sync_logs where status = 'In Progress' ";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			$in_progress_count = $stmt->fetchColumn(0);
			if ($in_progress_count > 0) {
				$this->db->query("UPDATE sync_logs set status = 'Failed' where status = 'In Progress'");
			}
		}
		catch (PDOException $e) {
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
		}
	}

	/**
	* Get last sync record
	*/
	private function checkLastSync()
	{
		try {
			// get latest sync_start_time record
			$sql = "SELECT id from sync_logs ORDER BY sync_end_time DESC limit 1";
			$stmt = $this->db->prepare($sql);
			$stmt->execute();
			return $stmt->fetchColumn(0);
		}
		catch (PDOException $e) {
			self::$logger->error($e->getMessage());
			self::$logger->error($e->getTraceAsString());
			return false;
		}
	}

	/**
	* Check if script is already running
	* returns true if script is running already
	*/
	private function checkScriptAlreadyRunning()
	{
		$lock_file = fopen(ROOT.'script.pid', 'c');
		$got_lock = flock($lock_file, LOCK_EX | LOCK_NB, $wouldblock);
		if ($lock_file === false || (!$got_lock && !$wouldblock)) {
			throw new Exception(
				"Unexpected error opening or locking lock file. Perhaps you " .
				"don't  have permission to write to the lock file or its " .
				"containing directory?"
			);
		}
		else if (!$got_lock && $wouldblock) {
			return true;
			//exit("Another instance is already running; terminating.\n");
		}

		// Lock acquired; let's write our PID to the lock file for the convenience
		// of humans who may wish to terminate the script.
		ftruncate($lock_file, 0);
		fwrite($lock_file, getmypid() . "\n");

		$this->lock_file_handle = $lock_file;
		return false;
	}

	/**
	* Function: performLocalSync
	* Sync records in SugarCRM
	*/
	public function performPushToSugarCRM()
	{
		global $app_config;
		//$module = $app_config['rawtable_to_SugarModule'][$table_name];
		self::$logger->info('Started Push To SugarCRM ');
		do {
			$data = $this->getDataChunkForPush();
			// if no records found, the sync is either complete or no records exist in pushToSugarCRM
			if ($data['record_count'] == 0) {
				self::$logger->info('No records found to sync into SugarCRM. Push TO SugarCRM sync completed');
				return;
			}
			$url = $this->getApiUrl() . $app_config['bulkimport_endpoint'];
			// prepare url by filling in the appropriate SugarCRM module name
			$url = str_replace(
				':module',
				$app_config['entity_to_sugarmodule']['push_to_sugarcrm'],
				$url
			);
			try 
			{
				$client = self::getApiClient();
				$oauth_token = empty($this->sugar_access_token) ? 
					$this->getSugarAuthToken() : $this->sugar_access_token;
				// create update records via curl call
				$res = $client->post(
					$url,
					json_encode(array('records' => $data['records'])),
					array(
						CURLOPT_HTTPHEADER => array(
						  'Content-Type: application/json',
						  'oauth-token: ' . $oauth_token
						)
					)
				);
				//self::$logger->debug('response: '.print_r($res,1));
				$this->updateSyncStatistics('push_to_sugarcrm', $res);

				$this->updateMiddleWare($res, 'push_to_sugarcrm', 'SugarCRMID');
				// if no records found, the sync is either complete or no records exist 
				// in local copy tables
				if ($data['next_offset'] == -1) {
					self::$logger->info('Completed Push To SugarCRM ');
					return;
				}   
			} catch (Exception $e) {
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
				if ($e->getCode() == 401) {
					// access token expired, regenerate it
					self::$logger->error('regenerating access token');
					$this->getSugarAuthToken('refresh_token');
				} else {
					$this->updateSyncLogs(false, true, 'Failed');
					die();
				}
			}

		} while ($data['next_offset'] != -1);
	}
	

	/**
	* Update MiddleWare tables when the records are synced
	*/
	public function updateMiddleWare($response, $entity, $table_column)
	{
		global $app_config;
		$table_name = $app_config['entity_to_table'][$entity];
		if (!empty($table_name)) {
			try {
				foreach ($response['list']['created'] as $record)
				{
					$sql = "update {$table_name} set $table_column = :value where id = :voxco_middleware_id";
					$sth = $this->db->prepare($sql);
					$sth->bindValue(':value', $record['sugar_id'], PDO::PARAM_STR);
					$sth->bindValue(':voxco_middleware_id', $record['external_key'], PDO::PARAM_STR);
					$sth->execute();	
				}
			} catch (PDOException $e){
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
			}
		}
	}
	
	/**
	* Function: getDataChunkForPush
	* Get data chunk from db to sync into sugar (calls)
	*/
	public function getDataChunkForPush()
	{
		global $app_config;
		if (!empty($app_config['entity_to_table']['push_to_sugarcrm'])) {
			$table_name = $app_config['entity_to_table']['push_to_sugarcrm'];
			
			try {
				$max = (int)$app_config['push_to_sugarcrm_chunk_size'] + 1; // query for limit + 1 to check if
				// still there are more records (next chunk)
				$sql = "SELECT TOP $max * FROM {$table_name} where SugarCRMID IS NULL OR SugarCRMID = ''";
				$sth = $this->db->prepare($sql);
				//$sth->bindValue(':max', $max, PDO::PARAM_INT);
				$sth->execute();
				$result = $sth->fetchAll(PDO::FETCH_ASSOC);
				$record_count = count($result);
				if ($record_count == $max) {
					$next_offset = 0;
					//remove last record from array as its additional record only fetched for pagination
					array_pop($result);
					$record_count = $record_count - 1;
				} else {
					$next_offset = -1;
				}
				$data = array();
				$data['next_offset'] = $next_offset;
				$data['record_count'] = $record_count;
				$data['records'] = $result;
				return $data;
			} catch (PDOException $e) {
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
			}
		}
		return false;
	}


	/**
	* Maintain sync Statistics
	*/
	public function updateSyncStatistics($column, $response)
	{
		global $app_config;
		try {
			if (isset($response['count']) && !empty($column)) {
				// first get current statistics from db, as the sync is in chunks, add new statistics in
				// the previous ones
				$sql = "SELECT {$column} from sync_logs where id = '{$this->sync_log_id}'";
				$stmt = $this->db->prepare($sql);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if (!empty($row)) {
					$data = $row[$column];
					if (empty($data)) {
						// first time inserting statistics for current module and sync
						$encoded_data = json_encode($response['count']);
						$sql = "UPDATE sync_logs set {$column} = :data where id = 
							'{$this->sync_log_id}'";
						$stmt = $this->db->prepare($sql);
						$stmt->bindValue(':data', $encoded_data);
					} else {
						$db_data = json_decode($data,1);
						$updated_statistics = array();
						foreach (array_keys($db_data + $response['count']) as $key) {
							$updated_statistics[$key] = (int)$db_data[$key] + (int)$response['count'][$key];
						}
						$updated_statistics = json_encode($updated_statistics);
						$sql = "UPDATE sync_logs set {$column} = :data where id = 
							'{$this->sync_log_id}'";
						$stmt = $this->db->prepare($sql);
						$stmt->bindValue(':data', $updated_statistics);
					}
					$stmt->execute();
				}
			}

			} catch (PDOException $e) {
				self::$logger->error($e->getMessage());
				self::$logger->error($e->getTraceAsString());
			}
	}
}