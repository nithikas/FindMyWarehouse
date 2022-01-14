<?php
	$servername = "mydb.ics.purdue.edu";
	$username = "g1090425";
	$password = "group4332";
	$dbname = "g1090425";
	$UserID = $_GET[id];
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	
	// This query checks whether there is a contract that is not completed for the respective user 	
	
	$query1 = "SELECT MAX(End_Date_of_Lease) FROM Contract WHERE Owner_ID = '$UserID'";
	$query2 = "SELECT MAX(End_Date_of_Lease) FROM Contract WHERE Lessee_ID = '$UserID'";
	
	$result1 = $conn->query($query1);
	$result2 = $conn->query($query2);
	
	$owner1 = $result1->fetch_assoc();
	$lesse1 = $result2->fetch_assoc();
	
	$owner1 = $owner1["End_Date_of_Lease"];
	$lessee1 = $lessee1["End_Date_of_Lease"];
	
	echo $UserID;
	
	$today = date("Y-m-d");
	
	// this if/else statement checks if the contract is still active and if it is, it will push you back to the owner portal
	// if there is not active contract, it will successfully delete the account from the database and take you to the main page 
							
	if ($owner1 or $lessee1 > $today) {
		?><td><meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$UserID?>"><?php
	}
	else {
		$deleteQuery = "DELETE FROM User WHERE User_ID = '$UserID'";
		$conn->query($deleteQuery);
		
		?><td><meta http-equiv="refresh" content ="1;url=main_page.php"><?php
	} 
	
?>
