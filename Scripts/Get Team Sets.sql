---------------GET TEAM SETS---------------

select * from team_sets t
inner join
(
SELECT team_set_id FROM `users` group by team_set_id
) st

on t.id = st.team_set_id;