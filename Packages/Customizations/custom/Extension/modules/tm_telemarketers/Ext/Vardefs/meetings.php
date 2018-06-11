<?php
// created: 2018-05-03 10:49:25
$dictionary["tm_telemarketers"]["fields"]["telemarketers_meetings"] = array (
  'name' => 'telemarketers_meetings',
  'type' => 'link',
  'relationship' => 'meeting_telemarketer',
  'source' => 'non-db',
  'module' => 'Meetings',
  'bean_name' => 'Meeting',
  'vname' => 'LBL_MEETINGS',
  'id_name' => 'telemarketer_id',
  'link-type' => 'many',
  'side' => 'left',
);
