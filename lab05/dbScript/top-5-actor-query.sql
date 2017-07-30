/*
Write a query that shows the top 5 actors in imdb_small who have appeared in the most
films, in descending order.
Write a query that shows the name of the director who has directed the most horror films.
(Use imdb_small at first.)

*/

SELECT    
    actor_id, first_name, last_name, count(actor_id)
FROM
    roles inner join actors on roles.actor_id = actors.id

GROUP BY 
    actor_id
ORDER BY 
    count(actor_id) DESC
LIMIT 5    
;