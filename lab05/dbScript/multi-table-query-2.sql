SELECT
    first_name, last_name, role
FROM
    roles
    INNER JOIN movies on movies.id = roles.movie_id
    INNER JOIN actors on actors.id = roles.actor_id
WHERE
    movies.name = "Pi";
    