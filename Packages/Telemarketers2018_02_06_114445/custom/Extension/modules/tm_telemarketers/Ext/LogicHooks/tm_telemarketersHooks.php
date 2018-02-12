<?php

    $hook_array['before_save'][] = array(
        1,
        'Throw exception if noagent is duplicate',
        'custom/modules/tm_telemarketers/tm_telemarketersHooksImpl.php',
        'tm_telemarketersHooksImpl',
        'beforeSave'
    );