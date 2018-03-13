<?php

    $hook_array['before_save'][] = array(
        1,
        'When the status of the opportunity is changed to Vente, the contact status changes to Client',
        'custom/modules/Opportunities/OpportunitiesHooksImpl.php',
        'OpportunitiesHooksImpl',
        'beforeSave'
    );