<?php
array_push($job_strings, 'automateTargetListForContacts');
require_once 'custom/include/helpers/ProspectListHelper.php';

function automateTargetListForContacts()
{    
    $helper = new ProspectListHelper();
    $helper->processTargetLists();
    return true;
}
