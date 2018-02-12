--------------GET TEAM MEMBERSHIPS--------------

SELECT tm. * 
FROM  `team_memberships` tm
INNER JOIN users u ON tm.user_id = u.id
WHERE u.id != 1