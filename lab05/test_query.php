<!DOCTYPE html>
<html>
	<!-- This is a test page that you can use to make sure you're able to
	     perform queries in MySQL properly on the server. -->
	
	<head>
		<title>CS472 Database Query Test</title>
	</head>

	<body>
	<h2>Test Query imdb_small</h2>
		<ul>
			<?php
			# connect to the imdb_small database
			#$db = new PDO("mysql:dbname=simpsons", "homer", "d0ughnut");
			$db = new PDO("mysql:dbname=simpsons", "root", "root");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			# query the database to see the movie names           
            //$rows = $db->prepare(file_get_contents("dbScript/director-most-horro-film-query.sql"));			
            $rows = $db->prepare("SELECT s.name, c.name, g.grade FROM grades g
				INNER JOIN courses c ON c.id = g.course_id 
				INNER JOIN students s ON s.id = g.student_id 
				WHERE g.grade in ('B-', 'B', 'B+', 'A-', 'A', 'A+') 
				ORDER BY s.name");
           
			$rows->execute();
            ?>
            <p>List all names of all students who were given a B- or better in any class, along with the name of the
			class(es) and the (B- or better) grade(s) they got. Arrange them by the student's name in ABC order</p>
            <p><?=$rows->rowCount()?> rows in set</p>
            <table border="1">
            <tr>
                <th>Student name</th>
                <th>Course name</th>
				<th>Grade</th>
                <!--<th></th>-->
            </tr>            
            <?php
			foreach ($rows as $row) {
				?>
                <tr>
				<td> <?= $row[0] ?> </td>
                <td> <?= $row[1] ?> </td>            
				<td> <?= $row[2] ?> </td>            
                </tr>            
				<?php
			}
			?>
            </table>           
		</ul>
	</body>
</html>