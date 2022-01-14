<html>
<body>
<?php

$submit_type = $_POST['submitbutton'];
//If the user wants to check the price, initiate the machine learning algorithm
if ($submit_type == "Check Price"){
	
	$N1 = $_POST['St'];
	$N2 = $_POST['TSAfR'];
	$N3 = $_POST['PPSF'];
	$N4 = $_POST['YB'];
	$N5 = $_POST['OID'];

	//Get the double value of the price per square foot to see if it falls in to a category above the lowest price category in the ML algorithm
	$check = (double) $N3;
	//If the price is greater than the upper bound of the lowest price category
	//We check for this because a user cannot lower their price any more after the reach $0.40 because it will not make a difference in our algorithm
	if ($N3 >= 0.4){
		$newString = shell_exec("Rscript naive_bayes_popularity.R $N1 $N2 $N3 $N4");
		$subString = substr($newString,4,-29);
		//If the ML algorithm says that the warehouse described will be popular among users, insert the value in to the database
		if (strlen($subString) < 10){
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
			$sql = "INSERT INTO Warehouse (Owner_ID, Street_Address, City, State, Zip_Code, Total_Space_Available_for_Rent, Year_Built, Property_Type) VALUES('$_POST[OID]', '$_POST[SA]', 
			'$_POST[Ci]', '$_POST[St]', '$_POST[ZC]', '$_POST[TSAfR]', '$_POST[YB]', '$_POST[PT]')";
			$conn->query($sql);
			$sql2 = "SELECT Warehouse_ID FROM Warehouse WHERE Owner_ID = '$_POST[OID]' AND Street_Address = '$_POST[SA]' AND City = '$_POST[Ci]' AND State = '$_POST[St]' AND Zip_Code = '$_POST[ZC]' AND Total_Space_Available_for_Rent = '$_POST[TSAfR]' AND Year_Built = '$_POST[YB]' AND Property_Type = '$_POST[PT]'";
			$statement = $conn->query($sql2);
			$statement2 = $statement->fetch_assoc();
			$WID = $statement2['Warehouse_ID'];
			$sql3 = "INSERT INTO Listing (Warehouse_ID, Owner_ID, Listed_Rental_Price) VALUES($WID, '$_POST[OID]', '$_POST[PPSF]')";
			$conn->query($sql3);
			echo "Your price is a good price for the warehouse described. The listing has been created!";
			$urlEnd = "owner_portal.php?id=" . $N5;

		}else{
			$urlEnd = "new_warehouse_form_part2.php?OID=" . $N5 . "&SA=" . urlencode($_POST['SA']) . "&Ci=" . urlencode($_POST['Ci']) . "&St=" . urlencode($N1) . "&ZC=" . $_POST['ZC'] . "&TSAfR=" . $N2 . "&PPSF=" . $N3 . "&YB=" . $N4 . "&PT=" . $_POST['PT'] . "?>";

		}
	}else{
	$N5 = $_POST['OID'];

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
	$sql = "INSERT INTO Warehouse (Owner_ID, Street_Address, City, State, Zip_Code, Total_Space_Available_for_Rent, Year_Built, Property_Type) VALUES('$_POST[OID]', '$_POST[SA]', 
	'$_POST[Ci]', '$_POST[St]', '$_POST[ZC]', '$_POST[TSAfR]', '$_POST[YB]', '$_POST[PT]')";
	$conn->query($sql);
	$sql2 = "SELECT Warehouse_ID FROM Warehouse WHERE Owner_ID = '$_POST[OID]' AND Street_Address = '$_POST[SA]' AND City = '$_POST[Ci]' AND State = '$_POST[St]' AND Zip_Code = '$_POST[ZC]' AND Total_Space_Available_for_Rent = '$_POST[TSAfR]' AND Year_Built = '$_POST[YB]' AND Property_Type = '$_POST[PT]'";
	$statement = $conn->query($sql2);
	$statement2 = $statement->fetch_assoc();
	$WID = $statement2['Warehouse_ID'];
	$sql3 = "INSERT INTO Listing (Warehouse_ID, Owner_ID, Listed_Rental_Price) VALUES($WID, '$_POST[OID]', '$_POST[PPSF]')";
	$conn->query($sql3);
	echo "Your price is a good price for the warehouse described. The listing has been created!";
	$urlEnd = "owner_portal.php?id=" . $N5;
	}
}else{
	$N5 = $_POST['OID'];

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
	$sql = "INSERT INTO Warehouse (Owner_ID, Street_Address, City, State, Zip_Code, Total_Space_Available_for_Rent, Year_Built, Property_Type) VALUES('$_POST[OID]', '$_POST[SA]', 
	'$_POST[Ci]', '$_POST[St]', '$_POST[ZC]', '$_POST[TSAfR]', '$_POST[YB]', '$_POST[PT]')";
	$conn->query($sql);
	$sql2 = "SELECT Warehouse_ID FROM Warehouse WHERE Owner_ID = '$_POST[OID]' AND Street_Address = '$_POST[SA]' AND City = '$_POST[Ci]' AND State = '$_POST[St]' AND Zip_Code = '$_POST[ZC]' AND Total_Space_Available_for_Rent = '$_POST[TSAfR]' AND Year_Built = '$_POST[YB]' AND Property_Type = '$_POST[PT]'";
	$statement = $conn->query($sql2);
	$statement2 = $statement->fetch_assoc();
	$WID = $statement2['Warehouse_ID'];
	$sql3 = "INSERT INTO Listing (Warehouse_ID, Owner_ID, Listed_Rental_Price) VALUES($WID, '$_POST[OID]', '$_POST[PPSF]')";
	$conn->query($sql3);
	echo "Your price is a good price for the warehouse described. The listing has been created!";
	$urlEnd = "owner_portal.php?id=" . $N5;
}
?>
<meta http-equiv="refresh" content ="1;url=<?=$urlEnd?>">
</body>
</html>