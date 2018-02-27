<?php

class rt_ClassificationHookImpl
{
	public function beforeSave($bean, $event, $arguments)
	{
		// The classifications should be unique	
		if ($bean->name != $bean->fetched_row['name']) {
			$sugar_query = new SugarQuery();
			$sugar_query->from(BeanFactory::newBean($bean->module_name), array('team_security' => false));
			$sugar_query->select(array('id'));
			$sugar_query->where()->equals('name', $bean->name);
			$result = $sugar_query->getOne();
			if (!empty($result)) {
                throw new SugarApiExceptionInvalidParameter(
                    translate('LBL_DUPLICATE_CLASSIFICATION', $bean->module_name)
                );
			}
		}
	}
}
