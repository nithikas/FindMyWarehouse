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
	$WarehouseID = $_GET[WarehouseID];
	$LesseeID = $_GET[LesseeID]; 
// This query gets the listed rental price from the database
// This value will be used as the agreed rental price when we insert this new contract into the database 
	$defaultPrice = "SELECT Listed_Rental_Price FROM Listing WHERE Warehouse_ID = '$WarehouseID'";
	$res = $conn->query($defaultPrice);
	$res9 = $res->fetch_assoc();
	$res9 = $res9['Listed_Rental_Price'];
	//inserts required information for a non-existing contract from user input form
	$sql = "INSERT INTO Contract (Owner_ID, Lessee_ID, Warehouse_ID, Start_Date_of_Lease, End_Date_of_Lease, Space_Rented, Agreed_Rental_Price) VALUES ('$_GET[OwnerID]', '$_GET[LesseeID]', '$_GET[WarehouseID]', '$_GET[startdate]', '$_GET[enddate]', '$_GET[spacerented]', '$res9')";
	$res2 = $conn->query($sql);
// If the insertion worked, then the page will refresh back to owner portal
	if ($res2 === TRUE) {
		echo "Returning to you portal. Please wait.";
		?><td><meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$LesseeID?>"><?php
	} 
	else {
		echo "Query unsuccessful.";
	}

?>

