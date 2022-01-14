<?php
	$servername = "mydb.ics.purdue.edu";
	$username = "g1090425";
	$password = "group4332";
	$dbname = "g1090425";
	$userID = $_POST[userID];
	$amount = $_POST[amount];
	$ccn = $_POST[ccn];
	$cvv = $_POST[cvv];
	$date = $_POST[date1];
	$warehouseID = $_POST[warehouseID];
	$contractID = $_POST[contractID];
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// This is a query that will insert credit card information into the database for payment
	
	$sql = "insert into Credit_Card (Credit_Card_Number, User_ID, CVV_Number, Expiration_Date) values (AES_ENCRYPT('$ccn','password'), '$userID', '$cvv', '$date')";
	$statement = $conn->query($sql);
	$sql2 = "update Contract set Amount_Paid = (Amount_Paid + '$amount') where Lessee_ID = '$userID' and Contract_ID = '$contractID' ";
	$statement = $conn->query($sql2);
?>
<td><meta http-equiv="refresh" content ="2;url=owner_portal.php?id=<?=$userID?>">
<br>
Redirecting you back to your portal.