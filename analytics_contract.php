<?php
$servername = "mydb.ics.purdue.edu";
$username = "g1090425";
$password = "group4332";
$dbname = "g1090425";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
	echo ("db error");
} 
$ret = array();
for ($i = 2018; $i <= 2030 ; $i++){
	$user_count = 0; //initial user count is zero.
	$sql = "SELECT count(DISTINCT Contract_ID) as count FROM Contract WHERE (Start_Date_of_Lease LIKE '$i%')"; // Get Contract count which is started in $i year. 
	$row = $conn->query($sql);
	$result = $row->fetch_assoc(); 
	$user_count += $result["count"];
	$ret[$i] = $user_count;
}
echo json_encode($ret);
?>