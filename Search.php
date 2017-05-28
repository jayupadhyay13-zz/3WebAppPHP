<?php
 $con = mysqli_connect("localhost", "root", "") or die("Error connecting to database: ".mysqli_error());
 mysqli_select_db($con, "company") or die(mysqli_error());
?>
<html>
<head>
	<title>Search results</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body> 
	<br>
	<h1>Search Result</h1>

	<?php
		if(isset($_POST['name']))
		{
			$queryStr = $_POST['name'];
			$query = "SELECT * FROM employee WHERE (UPPER(`LName`) LIKE '%". strtoupper($queryStr)."%' OR UPPER(`FName`) LIKE '%". strtoupper($queryStr)."%')" ;
			$sql = mysqli_query($con, $query) or die(mysqli_error($con));
			if(mysqli_num_rows($sql) > 0)
			{
				// if one or more rows are returned do following
				?>
				<table border="1" cellpadding="5" cellspacing="1">
					<tr bgcolor="yellow">
						<th>FNAME</th>
						<th>LNAME</th>
						<th>SEX</th>
						<th>DNO</th>
					</tr>
				<?php while($row = mysqli_fetch_array($sql, MYSQL_ASSOC))
				{	?>
					<tr>
						<td><?php echo $row['FNAME'] ;?></td>
						<td><?php echo $row['LNAME'] ;?></td>
						<td><?php echo $row['SEX'] ;?></td>
						<td><?php echo $row['DNO'] ;?></td>
					</tr>
				<?php } 
				echo "</table>" ;
			}
			else
			{
				// if there is no matching rows do following
				echo "No results";
			}
		}
		else
		{
			echo 'Enter search conditions';
		}
	?>
</body>
</html> 