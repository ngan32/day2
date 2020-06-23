<?php
function pg_connection_string_from_database_url() {
	extract(parse_url($_ENV["DATABASE_URL"]));
	return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}
	$db = pg_connect(pg_connection_string_from_database_url());
	if(!$db){
		echo "Error: Unable to open database\n";
	} else{
		echo "Opened datbase successfully\n";
	}

	$sql = "CREATE TABLE MyAccounts (
		username CHAR(10) PRIMARY KEY	NOT NULL, 
		password CHAR(50))";

	echo "$sql";
	$ret = pg_query($db,$sql);
	if(!$ret){
		echo pg_last_error($db);
	} else{
		echo "Table create successfully\n";
	}
	pg_close($db);
?>
<html>
<bode> <br> <a href="index.php"> HOME </a> </body>
</html>
