
<?php 

	// Connecting to the database and changing the corresponding pending to "No"

	$CID = $_GET['contractID'];
	$LID = $_GET['lesseeID'];
	
	$servername = "mydb.ics.purdue.edu";
	$username = "g1090425";
	$password = "group4332";
	$dbname = "g1090425";

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	$lesseeP = $conn->query("UPDATE Contract SET Pending_Lessee = 'No' WHERE Contract_ID = '$CID'");
	
	
	// Redirecting back to the owner portal after choosing to accept the contract
	
	if ($lesseeP === TRUE) {
		?><td><meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$LID?>"><?php
	} 
	else {
		echo "Query unsuccessful.";
	}

?>