<?php

function post_install()
{
    // execute post install queries
    $db = DBManagerFactory::getInstance();
    $sqls = array(
        0 => "update contacts c 
            INNER join rt_postal_codes p on c.primary_address_postalcode = p.name
            OR (p.name like SUBSTRING(c.primary_address_postalcode, 1, 3) AND LENGTH(p.name) = 3 )
            set c.postalcode_id = p.id, c.strate = p.nostrate_legacy, c.date_modified_pronto = UTC_TIMESTAMP()",
        
        1 => "update contacts c
            inner join accounts_contacts ac on c.id = ac.contact_id
            AND c.postalcode_id IS NOT NULL AND c.deleted = 0 AND ac.deleted = 0
            inner join accounts a on ac.account_id = a.id
            AND a.deleted = 0 set a.postalcode_id = c.postalcode_id"
    );

    foreach ($sqls as $sql) {
        $db->query($sql);
    }
}
