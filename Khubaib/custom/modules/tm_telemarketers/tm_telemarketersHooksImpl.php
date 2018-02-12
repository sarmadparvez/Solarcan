<?php

class tm_telemarketersHooksImpl
{

    function beforeSave($bean, $event, $arguments)
    {
        $this->checkDuplicateNoagent($bean, $event, $arguments);
    }

    function checkDuplicateNoagent(&$bean, &$event, &$arguments)
    {
        if ($bean->id != $bean->fetched_row['id']) {
            $tm = BeanFactory::newBean('tm_telemarketers')->retrieve_by_string_fields(
                array('noagent' => $bean->noagent)
            );
            if (!empty($tm)) {
                throw new SugarApiExceptionInvalidParameter("Agent $bean->noagent already exists");
            }
        }
    }
}
