<?php
	$servername = "mydb.ics.purdue.edu";
	$username = "g1090425";
	$password = "group4332";
	$dbname = "g1090425";
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "INSERT INTO Contract (Average_Warehouse_Rating, Average_Owner_Rating, Average_Lessee_Rating)";
	if ($conn->query($sql) === TRUE) {
		echo "Query Successful";
		?><meta http-equiv="refresh" content="2;url=owner_portal.php"><?php
	} 
	else {
		echo "Query UnSuccessful";
	}
	echo "Connected successfully";
		$conn->close();
?>