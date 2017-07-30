/*
Write a query that shows the top 3 most popular genres of films in imdb_small, sorted in
descending order.
*/
SELECT
    genre,
    COUNT(genre)
FROM 
    movies_genres
GROUP BY 
    genre
ORDER BY
    COUNT(genre) DESC
LIMIT
    3
; 

