<?php

require_once('custom/include/helpers/CampaignListHelper.php');

// Api to get Contacts list against all Non-Email based (telesales) campaigns
class CampaignListApi extends SugarApi
{
	private $campaignListhelperObject;
	/**
	* @codeCoverageIgnore
	*/
    public function registerApiRest()
    {
        return array(
            array(
                'reqType' => 'GET',
                'path' => array('CampaignList'),
                'pathVars' => array(''),
                'method' => 'getCampaignList',
                'shortHelp' => 'Admin Only - GET CampaignList',
            )
        );
    }

    /**
    * Get campaign list
    * @param ServiceBase $api
    * @param array $args arguments pased to the api
    * @return array
    */
    public function getCampaignList(ServiceBase $api, array $args)
    {
    	$this->helper()->checkIfCurrentUserIsAdmin();
    	//by default return 20 records
    	$offset = isset($args['offset']) ? (int)$args['offset'] : 0;
    	$limit = isset($args['limit']) ? (int)$args['limit'] : 20;
    	$lastsync = isset($args['lastsync']) && !empty($args['lastsync']) ? $args['lastsync'] : '';

    	$response = array();
    	$data = $this->helper()->getList($offset, $limit, $lastsync);
    	$total_records = count($data);
    	$response['records'] = $data;
    	$response['record_count'] = $total_records;
    	if ($total_records == $limit + 1) {
    		// we have a next page
    		// remove extra record at the end that we fetched to detect the next page
    		array_pop($response['records']);
    		$response['next_offset'] = $offset + $limit;
    		$response['record_count']-- ; // because we fetched an extra record
    	} else {
    		// this is the last page
    		$response['next_offset'] = -1;
    	}
    	return $response;
    }

    protected function helper()
    {
        if(empty($this->campaignListhelperObject)) {
            $this->campaignListhelperObject = new CampaignListHelper();
        }
        return $this->campaignListhelperObject;
    }
}
