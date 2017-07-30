SELECT
    first_name, last_name
FROM
    actors
    INNER JOIN roles r1 on r1.actor_id = actors.id       
    INNER JOIN roles r2 on r2.actor_id = actors.id
    INNER JOIN movies m1 on m1.id = r1.movie_id
    INNER JOIN movies m2 on m2.id = r2.movie_id    
WHERE
    m1.name = "Kill Bill: Vol. 1" 
    AND
    m2.name = "Kill Bill: Vol. 2" 
;
    