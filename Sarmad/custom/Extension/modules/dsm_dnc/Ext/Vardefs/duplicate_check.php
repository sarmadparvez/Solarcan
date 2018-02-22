<?php

$dictionary['dsm_dnc']['duplicate_check']['FilterDuplicateCheck'] = array(
    'filter_template' => 
    array (
    0 => 
        array (
          'telephone' => 
          array (
            '$equals' => '$telephone',
          ),
        ),
    ),
    'ranking_fields' => 
    array (
        0 => 
        array (
          'in_field_name' => 'telephone',
          'dupe_field_name' => 'telephone',
        ),
    ),
);

$dictionary['dsm_dnc']['indices'][] = array(
    'name' => 'idx_telephone',
    'type' => 'index',
    'fields' => array(
        0 => 'telephone',
    ),
    'source' => 'non-db',
);
