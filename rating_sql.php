<?php
	$UserID = $_GET["UserID"]; 
	
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
	$sql = "INSERT INTO Owner_Rating (Contract_ID, Courtesy, Adherence_To_Contract, Timeliness) VALUES('$_GET[CID]','$_GET[OC]', '$_GET[OATC]', 
	'$_GET[OT]')";
	$query = $conn->query($sql);
	$average = (($_GET[OC] + $_GET[OATC]+ $_GET[OT])/3);
	$contract = $_GET[CID];
	$sql2 = "UPDATE Contract SET Average_Owner_Rating = '$average' WHERE Contract_ID = '$contract'";
	$query2 = $conn->query($sql2);
	$sql3 = "INSERT INTO Warehouse_Rating (Contract_ID, Cleanliness, Safety_And_Repair) VALUES('$_GET[CID]','$_GET[WC]', '$_GET[WSAR]')";
	$query = $conn->query($sql3);
	$average2 = (($_GET[WC]+ $_GET[WSAR])/2);
	$sql4 = "UPDATE Contract SET Average_Warehouse_Rating = '$average2' WHERE Contract_ID = '$contract'";
	$query2 = $conn->query($sql4);
	
	if ($conn->query($sql4) === TRUE) {
		echo "Returning to your portal. Please wait.";
		?><td><meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$UserID?>"><?php

	} 
	else {
		echo "SQL Query not executed";
	}
	//echo "Connected successfully";
		$conn->close();
?>