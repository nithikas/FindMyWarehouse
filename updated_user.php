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
	// This stores the values inputed by the user
	$name = $_POST[name];
	$email = $_POST[email];
	$UserID = $_POST[userID];
	$password1 = $_POST[password];
	$phoneNumber = $_POST[phoneNumber];
	
	//This checks to see if the user actually inputed a value in for name.
	//If yes, their name in the database will be changed. If no, the value will remain the same in the database.
	if (strlen($name)> 0) {
	echo "New name is " . $name;
	$intoSQL = "UPDATE User SET Name = '$name' WHERE User_ID = '$_POST[userID]'";
	$statement = $conn->query($intoSQL);
	} 
	//Repeats same process as above but for email
	if (strlen($email) > 0) {
	echo "<br> New email is " .$email;
	$intoSQL = "UPDATE User SET Email = '$email' WHERE User_ID = '$_POST[userID]'";
	$statement = $conn->query($intoSQL);
	} 
	//Repeats same process as above but for phone number
	if (strlen($phoneNumber) > 0) {
	echo "<br> New phone number is " . $phoneNumber;
	$intoSQL = "UPDATE User SET Phone_Number = '$phoneNumber' WHERE User_ID = '$_POST[userID]'";
	$statement = $conn->query($intoSQL);
	}
	//Repeats same process as above but for password (the new password is encrypted when uploaded to the database)
	if (strlen($password1) > 0) {
	echo "Password changed.";
	$intoSQL = "UPDATE User SET Password = AES_ENCRYPT('$password1', 'password') WHERE User_ID = '$_POST[userID]'";
	$statement = $conn->query($intoSQL);
	}
?>
<!-- Refreshes back to owner portal -->
<td><meta http-equiv="refresh" content ="2;url=owner_portal.php?id=<?=$UserID?>">
<br>
Redirecting you back to your portal.
