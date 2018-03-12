<?php

    $hook_array['before_save'][] = array(
        1,
        'Set status to Import if DNC record is being create via importing process',
        'custom/modules/dsm_dnc/dsm_dncHooksImpl.php',
        'dsm_dncHooksImpl',
        'beforeSave'
    );