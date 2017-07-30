/*
Write a query that shows the name of the director who has directed the most horror films.
*/

SELECT
   	director_id, 
   	first_name, 
    last_name,
    genre, 
    count(director_id) 
FROM
    movies_genres mg INNER JOIN movies_directors md ON md.movie_id = mg.movie_id 
    INNER JOIN directors d ON md.director_id = d.id 
WHERE
    genre = 'horror' 
GROUP BY
    director_id 
ORDER BY count(director_id) DESC 
LIMIT
    1
;