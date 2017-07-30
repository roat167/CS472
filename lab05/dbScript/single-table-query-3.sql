SELECT
    actor_id
FROM
    roles   
    INNER JOIN movies ON movies.id = roles.movie_id
WHERE
    movies.name = 'Fight Club';