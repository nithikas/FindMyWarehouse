<?php
	$servername = "mydb.ics.purdue.edu";
	$username = "g1090425";
	$password = "group4332";
	$dbname = "g1090425";
	$UserID = $_POST[userID];
	$price = $_POST[price];
	$yearBuilt = $_POST[yearBuilt];
	$warehouseID = $_POST[warehouseID];
	$spaceAvail = $_POST[spaceAvail];
	$typeP = $_POST[typeP];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//checks to see if user entered a new price in. if yes, it updates listed rental price
	//on the database. if not, the value is stayed the same
	if (strlen($price)> 0) {
	echo "New price is " . $price;
	$intoSQL = "UPDATE Listing SET Listed_Rental_Price = '$price' WHERE Warehouse_ID = '$warehouseID'";
	$statement = $conn->query($intoSQL);
	}
//same process as above but for year built	
	if (strlen($yearBuilt) > 0) {
	echo "<br> This warehouse was built in " .$yearBuilt;
	$intoSQL = "UPDATE Warehouse SET Year_Built = '$yearBuilt' WHERE Warehouse_ID = '$warehouseID'";
	$statement = $conn->query($intoSQL);
	} 
	//same process as above but for space available	
	if (strlen($spaceAvail) > 0) {
	echo "<br> New space available for rent is " . $spaceAvail;
	$intoSQL = "UPDATE Warehouse SET Total_Space_Available_for_Rent = '$spaceAvail' WHERE Warehouse_ID = '$warehouseID'";
	$statement = $conn->query($intoSQL);
	}
	//same process as above but for type of property	
	if (strlen($typeP) > 0) {
	echo "<br> New property type added.";
	$intoSQL = "UPDATE Warehouse SET Property_Type = '$typeP' WHERE Warehouse_ID = '$warehouseID'";
	$statement = $conn->query($intoSQL);
	}
?>
<!-- refreshes back to owner portal -->
<td><meta http-equiv="refresh" content ="2;url=owner_portal.php?id=<?=$UserID?>">
<br>
Redirecting you back to your portal.