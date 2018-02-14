<?php

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
