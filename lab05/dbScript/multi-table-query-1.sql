SELECT
    role
FROM
    roles 
    INNER JOIN movies on movies.id = roles.movie_id
WHERE
    movies.name = "Pi";
    