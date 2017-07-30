/*
CS143 Grades
List all of the grades given in the course Computer Science 143. Do this as a single query and do
not hard-code 143's ID number in the query
*/

SELECT 
    *
FROM
    grades g INNER JOIN courses c ON c.id = g.course_id
WHERE
    c.name = 'Computer Science 143'
;

/*
Modify your previous query to list the names and grades of all students that took Computer Science
143 and got a B- or better. Do this as a single query and do not hard-code 143's ID number in the
query
*/

SELECT 
    s.name
FROM 
    grades g INNER JOIN courses c ON c.id = g.course_id 
    INNER JOIN students s ON s.id = g.student_id 
WHERE 
    c.name = 'Computer Science 143' 
    AND 
    g.grade IN ('B-', 'B', 'B+', 'A-', 'A', 'A+')
;
/* All Grades
List all names of all students who were given a B- or better in any class, along with the name of the
class(es) and the (B- or better) grade(s) they got. Arrange them by the student's name in ABC order.
*/ 
SELECT
    s.name, 
    c.name, 
    g.grade  
FROM 
    grades g INNER JOIN courses c ON c.id = g.course_id 
    INNER JOIN students s ON s.id = g.student_id 
WHERE 
    g.grade in ('B-', 'B', 'B+', 'A-', 'A', 'A+') 
ORDER BY 
    s.name
;

/*
List the names of all courses that have been taken by 2 or more students. Do this as a single query
and do not hard-code any ID numbers in the query. Don't show duplicates
*/

SELECT 
    name 
FROM 
    courses c INNER JOIN grades g ON g.course_id = c.id 
GROUP BY 
    course_id 
HAVING 
    COUNT(course_id) >= 2;