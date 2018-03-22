<?php

$hook_version = 1;
if (!isset($hook_array)) {
    $hook_array = array();
}

if (!isset($hook_array['before_save'])) {
    $hook_array['before_save'] = array();
}

$hook_array['before_save'][] = array(
    count($hook_array['before_save']),
    'before_save contacts',
    'custom/modules/Contacts/ContactsHookImpl.php',
    'ContactsHookImpl',
    'beforeSave'
);
