<?php

require_once('custom/include/helpers/UtHelper.php');

class CampaignListHelper
{
	use UtHelper;

	/**
	* Get Contact List (Contacts related to Campaigns)
	* @param int $offset
	* @param int $limit
	* @param string $lastsync
	*/
	public function getList($offset = 0, $limit = 20, $lastsync)
	{
		$s_query = $this->getSugarQuery();
		$s_query->from(BeanFactory::newBean('Campaigns'), array(
				'team_security' => false,
				'add_deleted' => false
			)
		);
        $s_query->select(
            array(
            	array($s_query->getFromAlias().'.id', 'campaign_id'),
                array($s_query->getFromAlias().'.voxco_db', 'dbName'),
                array($s_query->getFromAlias().'.deleted', 'campaign_deleted'),
                array($s_query->getFromAlias().'.date_modified_pronto', 'campaign_date_modified_pronto')
            )
        );
        $s_query->select()->fieldRaw('plp.prospect_list_id', 'prospect_list_id');
        $s_query->select()->fieldRaw('c.id', 'contact_id');
        $s_query->select()->fieldRaw(
            "case WHEN c.preferred_language = 'francais' THEN 1
             WHEN c.preferred_language = 'anglais' THEN 2 END
            ", 'ResLang'
        );
        $s_query->select()->fieldRaw(
            "case WHEN c.statut_dnc = 'active' THEN 1
             WHEN c.statut_dnc = 'inactive' THEN 0 END
            ", 'ResActive'
        );
        $s_query->select()->fieldRaw('c.strate', 'RpsRegionI');
        $s_query->select()->fieldRaw('c.first_name', 'first_name');
        $s_query->select()->fieldRaw('c.last_name', 'last_name');
        $s_query->select()->fieldRaw('c.phone_home', 'phone_home');
        $s_query->select()->fieldRaw('MIN(plc.deleted)', 'plc_deleted');
        $s_query->select()->fieldRaw('MIN(plp.deleted)', 'plp_deleted');
        $s_query->select()->fieldRaw('c.deleted', 'contact_deleted');
        $s_query->select()->fieldRaw('plc.date_modified', 'plc__date_modified');
        $s_query->select()->fieldRaw('plp.date_modified', 'plp__date_modified');
        $s_query->select()->fieldRaw('pli.deleted', 'pli_deleted');
        // greatest date modifed will be considered as date modified of the record
        $s_query->select()->fieldRaw("GREATEST(COALESCE(campaigns.date_modified_pronto, ''), plc.date_modified, plp.date_modified, COALESCE(c.date_modified_pronto, ''))"
            , 'modified');

		$s_query->joinTable(
            'prospect_list_campaigns',
            array(
                'alias' => 'plc',
                'joinType' => 'INNER',
                'linkingTable' => true,
            )
        )->on()->equalsField('plc.campaign_id', $s_query->getFromAlias().'.id')
        ->equals($s_query->getFromAlias().'campaign_type', 'Telesales');

        /**
         * JIRA DEV-607
         * Added By: SMQB
         * Date: 07/06/18
         */
        
	$s_query->joinTable(
            'prospect_lists',
            array(
                'alias' => 'pli',
                'joinType' => 'INNER',
                'linkingTable' => true,
            )
        )->on()->equalsField('pli.id', 'plc.prospect_list_id');
        
        $s_query->joinTable(
        	'prospect_lists_prospects',
        	array(
        		'alias' => 'plp',
        		'joinType' => 'INNER',
        		'linkingTable' => true,
        	)
        )->on()->equalsField('plp.prospect_list_id', 'plc.prospect_list_id')
        ->equals('plp.related_type', 'Contacts');


		$s_query->joinTable(
			'contacts',
			array(
				'alias' => 'c',
				'joinType' => 'INNER'
			)
		)->on()->equalsField('plp.related_id', 'c.id');

		if (!empty($lastsync)) {
			$s_query->orWhere()
            ->gte($s_query->getFromAlias().'.date_modified_pronto' , $lastsync)
			->gte('plc.date_modified' , $lastsync)
			->gte('plp.date_modified' , $lastsync)
			->gte('c.date_modified_pronto' , $lastsync);
		}

		$s_query->groupBy('plc.campaign_id');
		$s_query->groupBy('pli.id');
		$s_query->groupBy('c.id');
		$s_query->orderBy('plc.date_modified', 'ASC');
		$s_query->orderBy('plp.date_modified', 'ASC');
		$s_query->orderBy('c.date_modified_pronto', 'ASC');
		// fetch limit + 1 records, to see if we have next page
		$s_query->limit($limit+1);
		$s_query->offset($offset);

        $result = $s_query->execute();

        return $result;
	}

    /**
     * Get a list of bean types created in the import
     *
     * @param string $module  module being imported into
     */
    public function getRegionalCodeFromLastImport($module)
    {
        global $current_user;

        $db = DBManagerFactory::getInstance();

        $query1 = sprintf(
            'select regional_code from dsm_dnc dnc inner join '
            .' (select bean_id from users_last_import where assigned_user_id = %s AND import_module = %s '
            .'AND deleted = 0 limit 1) st on dnc.id = st.bean_id',
            $db->quoted($current_user->id),
            $db->quoted($module)
        );

        $result1 = $db->query($query1);
        if (!$result1) {
            return false;
        }

        $regional_code = '';
        $row1 = $db->fetchByAssoc($result1);
        if (!empty($row1)) {
            $regional_code = $row1['regional_code'];
        }
        return $regional_code;
    }
}