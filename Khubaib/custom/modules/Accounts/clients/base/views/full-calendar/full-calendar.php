<?php
$module_name = 'Accounts';
$viewdefs['Accounts']['base']['view']['full-calendar'] = array(
    'buttons' => array(
        array(
            'name'    => 'selection_btn',
            'type'    => 'button',
            'label'   => 'LBL_SELECTION',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'events' => 
            array (
              'click' => 'placement:select_all:fire',
            ),
        ),
        array(
            'name'    => 'hold_btn',
            'type'    => 'button',
            'label'   => 'LBL_HOLD',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'events' => 
            array (
              'click' => 'placement:holdReservation:fire',
            ),
        ),
        array(
            'name'    => 'reserve_btn',
            'type'    => 'button',
            'label'   => 'LBL_RESERVE',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'events' => 
            array (
              'click' => 'placement:reserveReservation:fire',
            ),
        ),
        array(
            'name'    => 'save_draft_btn',
            'type'    => 'button',
            'label'   => 'LBL_SAVE_DRAFT',
            'css_class' => 'btn-primary',
            'acl_action' => 'create',
            'events' => 
            array (
              'click' => 'placement:saveDraftReservation:fire',
            )
        ),
    ),
);