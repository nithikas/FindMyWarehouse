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
	//allows for user to upload a contract as a pdf
	if(!empty($_FILES['pdf_contracts'])){
		$path = "uploads/";
		$path = $path . basename($_FILES['pdf_contracts']['name']);
		
		if(move_uploaded_file($_FILES['pdf_contracts']['tmp_name'], $path)){
			echo "The file ". basename( $_FILES['pdf_contracts']['name'] ). " has been uploaded";
		} else { 
			echo "There was an error uploading the file, please try again!";
		}
	}
	
	$pdf_contracts = $_GET[pic];
	$UserID = $_GET[UserID];
	$ContractID = $_GET[CID];
	$WarehouseID = $_GET[WID];
	$Terms = $_GET[Terms];
	$NewPrice = $_GET[NewPrice];

	//if a new price value was entered, the agreed rental price in the database is updated to that 
	if (strlen ($NewPrice) > 0) {
		$query1 = "UPDATE Contract SET Agreed_Rental_Price = '$NewPrice' WHERE Contract_ID = '$ContractID'"; 
		$res = $conn->query($query1);
	}
	//same process as above but for terms
	if (strlen ($Terms) > 0) {
		$query2 = "UPDATE Contract SET Terms = '$Terms', Pending_Owner = 'No' WHERE Contract_ID = '$ContractID'"; 
		$res2 = $conn->query($query2);
	}
	//same process as above but for contract pdfs
	if (strlen ($pdf_contracts) > 0) {
		$query3 = "UPDATE Contract SET pdf_contracts = '$pdf_contracts' WHERE Contract_ID = '$ContractID'"; 
		$res3 = $conn->query($query3);
	}
	//refreshes the page
		?><td><meta http-equiv="refresh" content ="1;url=owner_portal.php?id=<?=$UserID?>"><?php
	
?>

