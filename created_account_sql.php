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
	
	// This will take all of the information: email, name, password (encrypted), and phone number
	// and insert it into the database as a new user 
	$sql = "INSERT INTO User (Email, Name, Password, Phone_Number) VALUES('$_POST[EM]',
	'$_POST[Name]', AES_ENCRYPT('$_POST[PW]', 'password'), '$_POST[PN]')";
	$statement = $conn->query($sql);
	$sql2 = "select User_ID from User where Email = '$_POST[EM]'";
	$statement2 = $conn->query($sql2);
	$statement3 = $statement2->fetch_assoc();
	$statement3 = $statement3['User_ID'];
	$sql3 = "insert into Lessee (User_ID) values ('$statement3')";
	$statement4 = $conn->query($sql3);
	$sql4 = "insert into Owner (User_ID) values ('$statement3')";
	$statement5 = $conn->query($sql4);
	
	// if successful, it will take you to the login page, otherwise it will echo the server is down 
	if ( ($conn->query($sql3))=== TRUE) {
		echo "Please log in.";
		?><meta http-equiv="refresh" content="2;url=log_in.php"><?php
	} 
	else {
		echo "Server is down. Try again later!";
	}
	
		$conn->close();
?>