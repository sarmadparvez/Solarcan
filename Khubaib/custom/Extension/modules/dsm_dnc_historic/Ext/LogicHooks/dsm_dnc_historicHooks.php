<?php

    $hook_array['before_save'][] = array(
        1,
        'Set source_details and date_enregistrement',
        'custom/modules/dsm_dnc_historic/dsm_dnc_historicHooksImpl.php',
        'dsm_dnc_historicHooksImpl',
        'beforeSave'
    );