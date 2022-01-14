<?php
$servername = "mydb.ics.purdue.edu";
$username = "g1090425";
$password = "group4332";
$dbname = "g1090425";

function reduce($array){
	$ret = array();
	foreach($array as $key=>$value){
		$ret[$key] = $value[0];
	}
	return $ret;
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection

if ($conn->connect_error) {
	echo ("db error");
} 
$ret = array();
$users = [];
for ($i = 2018; $i <= 2030 ; $i++){
	$user_count = 0;
	$ids = join("','", $users);
	//echo $ids;
	$sql = "SELECT DISTINCT(Owner_ID) FROM Contract WHERE Start_Date_of_Lease LIKE '$i%' AND Owner_ID NOT IN ('$ids')"; // Select the OwnerID in specific year without overlapping from past years owners
	$row = $conn->query($sql);
	$owners = $row->fetch_all();
	$sql = "SELECT DISTINCT(Lessee_ID) FROM Contract WHERE Start_Date_of_Lease LIKE '$i%' AND Lessee_ID NOT IN ('$ids')"; //// Select the Lessee_ID in specific year without overlapping from past years owners
	$row = $conn->query($sql);
	$lessees = $row->fetch_all();
	//$result = array_diff_assoc($lessees, $owners);
	$result = array_merge($owners, $lessees); // Merge Owners & Lessees
	//$result = array_intersect($owners, $lessees);
	$result = reduce($result); // Make all the elements of the array to string from array value. currently the result is gotten as an array of array
	$result = array_unique($result); // Reduce those which are overlapping
	//echo "Owners : " . count($owners) . " Lessees :  " . count($lessees) . " Total : " . count($result) . "<br>";
	$user_count += count($result); // New User Count will be the length of this array
	$ret[$i] = $user_count;
	$users = array_merge($users, $result);
}
echo json_encode($ret);
?>