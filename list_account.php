<!DOCTYPE HTML>
<html>
	<head>
		<style>
			.ERROR {color: #FF0000;}
		</style>
	</head>
	<body>
		<?php
			function pg_connection_string_from_database_url(){
				extract(parse_url($_ENV["DATABASE_URL"]));
				return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require ther too
			}
			
			$db = pg_connect(pg_connection_string_from_database_url());
			if(!$db){
				echo "Error: Unable to open database\n";
			} else{
				echo "Opened database successfully\n";
			}

			$sql = "SELECT * FROM MyAccounts";
			echo "<br>"; echo "$sql"; echo "<br>";
			$ret = pg_query($db, $sql);
			if(!$ret){
				echo pg_last_error($db);
				exit ();
			}
		?>
		<table border="1" cellspacing="2" cellpading="2">
			<tr><td> Username </td><td> Password </td></tr>
			<?php
				while($myrow = pg_fetch_assoc($ret)){
					echo '<tr>';
					echo '<td>';
					echo $myrow['username'];
					echo '</td>';
					echo '<td>';
					echo $myrow['password'];
					echo '</td>';
					echo '</tr>';
				}
				pg_close($db);
			?>
		</table>
		<br> <a href="index.php"> HOME </a>
	</body>
</html>

