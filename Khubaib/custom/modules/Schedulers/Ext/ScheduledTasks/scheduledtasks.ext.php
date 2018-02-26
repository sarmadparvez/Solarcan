<?php
// WARNING: The contents of this file are auto-generated.
?>
<?php
// Merged from custom/Extension/modules/Schedulers/Ext/ScheduledTasks/ops_backups_fetch_exports.php


$job_strings[] = 'ops_backups_fetch_exports';

function ops_backups_fetch_exports() {
    global $sugar_config;

    // First lets clean out any old junk
    $Backup = BeanFactory::newBean('ops_Backups');

    if (empty($Backup)) {
        $GLOBALS['log']->error("Failed to instantiate ops_Backups bean");
        return;
    }

    ops_Backups::removeExpired();

    $backups = $Backup->getAppInstanceExports();

    foreach ($backups as $backup) {
        $backup = $Backup->verifyExport($backup);
        if ($backup) {
            $sql = new SugarQuery();
            $sql->select('id');
            $sql->from($Backup);
            $sql->where()->equals('download_url', $backup->download_url);

            $result = $sql->execute();
            $count = count($result);

            if ($count == 0) {
                $newBean = BeanFactory::newBean($Backup->module_name);
                if (empty($newBean)) {
                    $GLOBALS['log']->error("Failed to instantiate a new ops_Backups bean");
                    continue;
                }
                $newBean->name = (isset($backup->name)?$backup->name:$sugar_config['host_name']);
                $newBean->date_entered = $backup->created_at->format('Y-m-d H:i:s');
                $newBean->expires_at = $backup->expires_at->format('Y-m-d H:i:s');
                $newBean->description = sprintf(translate('LBL_CREATED_DESC', 'ops_Backups'),
                    $sugar_config['host_name'],
                    $backup->created_at->format($GLOBALS['timedate']->get_date_format())
                );
                $newBean->description .= sprintf(translate('LBL_EXPIRES_DESC', 'ops_Backups'),
                    $backup->expires_at->format($GLOBALS['timedate']->get_date_format())
                );
                $newBean->download_url = $backup->download_url;
                $newBean->save();
                if ($newBean->id) {
                    $GLOBALS['log']->info(sprintf("opsBackups saved backup: %s", $newBean->id));
                } else {
                    $GLOBALS['log']->fatal(sprintf("opsBackups failed to save backup: %s", $backup->download_url));
                }
            } else {
                $GLOBALS['log']->info(sprintf("opsBackups skipping this export because we already have a record for %s", $backup->download_url));
            }
        }
    }
    return true;
}

?>
<?php
// Merged from custom/Extension/modules/Schedulers/Ext/ScheduledTasks/ContactsDNCUpdate.php


/**
 * This job runs when importing DNC List and updates contacts according to DNC Workflow
 */
class ContactsDNCUpdate implements RunnableSchedulerJob
{

    /**
     * This method implements setJob from RunnableSchedulerJob. It sets the
     * SchedulersJob instance for the class.
     *
     * @param SchedulersJob $job the SchedulersJob instance set by the job queue
     */
    public function setJob(SchedulersJob $job)
    {
        $this->job = $job;
    }

    /**
     * Executes a job to clean sync.
     * @param $data
     * @return bool
     */
    public function run($data)
    {
        try {
            $GLOBALS['log']->fatal("DNC Post Import Job");
            global $db;
            $contacts_dnc_query = " SELECT  contacts.id as contact, dsm_dnc.id as dsm_dnc
                                    FROM    dsm_dnc join contacts on digits(CONCAT(dsm_dnc.regional_code, dsm_dnc.name)) = digits(contacts.phone_other)
                                    WHERE   contacts.deleted = 0
                                    AND     dsm_dnc.deleted = 0";
            $result             = $db->query($contacts_dnc_query, true,
                "Error retrieving matching contacts");

            $contact_dnc = array();
            $i = 0;
            while (($row      = $db->fetchByAssoc($result))) {
                $contact_dnc[$i]['contact'] = empty($row['contact']) ? "" : $row['contact'];
                $contact_dnc[$i]['dsm_dnc'] = empty($row['dsm_dnc']) ? "" : $row['dsm_dnc'];
                ++$i;
            }

            if (!empty($contact_dnc)) {
                foreach ($contact_dnc as $arr) {
                    $GLOBALS['log']->fatal($arr);
                    $contactBean = BeanFactory::newBean('Contacts')->retrieve($arr['contact']);
//                    if ($contactBean) {
//
//                        $contactBean->statut_dnc = "inactive";
//                        $contactBean->dsm_dnc_id = $arr['dsm_dnc'];
//                        $dnc_historic = BeanFactory::newBean('dsm_dnc_historic');
//                        $dnc_historic->name = $contactBean->name;
//                        $dnc_historic->statut_precedent = $contactBean->statut_dnc;
//                    }
                }
            }
        } catch (Exception $e) {
            $this->job->failJob($e->getMessage());
            return false;
        }

        return true;
    }
}
?>
