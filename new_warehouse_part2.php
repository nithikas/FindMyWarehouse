<html>
<body>
<?php
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
	
	$sql2 = "INSERT INTO Listing (Listed_Rental_Price) VALUES('$_POST[PPSF]')";
	$conn->query($sql2);
	?>
<meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$N5?>">
</body>
</html>