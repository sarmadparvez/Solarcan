------------GET TEAMS------------

SELECT t . * 
FROM teams t
INNER JOIN (
	SELECT tm. * 
	FROM  `team_memberships` tm
	INNER JOIN users u ON tm.user_id = u.id
	WHERE u.id != 1
	GROUP BY team_id
)st ON t.id = st.team_id
