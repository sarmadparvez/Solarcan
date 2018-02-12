------------------GET TEAM_SET_TEAMS------------------

SELECT * 
FROM team_sets_teams tst
INNER JOIN (

SELECT * 
FROM team_sets t
INNER JOIN (

SELECT team_set_id
FROM  `users` 
GROUP BY team_set_id
)st ON t.id = st.team_set_id
)st ON tst.team_set_id = st.id
