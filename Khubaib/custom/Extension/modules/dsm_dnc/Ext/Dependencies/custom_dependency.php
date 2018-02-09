<?php

$dependencies['dsm_dnc']['custom_dependency'] = array(
    'hooks' => array("edit"), // this is where you want it to fire
    'trigger' => 'true', // to fire when fields change
    'triggerFields' => array('source'), // field that will trigger this when changed
    'onload' => true, // fire when page is loaded
    'actions' => array( // actions we want to run, you can set multiple dependency action here
        array(
        'name' => 'SetRequired', // function to trigger
        'params' => array( // the params for the set required action
            'target' => 'source_details', // the field id
            'label' => 'LBL_SOURCE_DETAILS', // the field label id
            'value' => 'equal($source, "agent")', // the SugarLogic for it to trigger if the field is required or not
            ),
        ),
    ),
);
