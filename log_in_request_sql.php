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
	$statement = $conn->query("SELECT Name, User_ID FROM User WHERE Email = '$_POST[email]' AND AES_DECRYPT(Password,'password') = '$_POST[userPassword]'");
	$statement2 = $statement->fetch_assoc();
	$LesseeID = $statement2['User_ID'];
	$OwnerID = $_POST["OwnerID"]; 
	$WarehouseID = $_POST["WID"];
	if ($statement->num_rows > 0) {
		echo "Redirecting to request page. Please wait.";
		?><td><meta http-equiv="refresh" content ="1;url=contracts.php?lesseeID=<?=$LesseeID?>&warehouseID=<?=$WarehouseID?>&ownerID=<?=$OwnerID?>"><?php
		
	} 
	else {
?><meta http-equiv="refresh" content="2;url=log_in_failed.php"> <?php
	}
	//echo "Connected successfully";
		$conn->close();
?>