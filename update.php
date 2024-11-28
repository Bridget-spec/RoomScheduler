<?php 

include_once 'db.php'; 

# form data 
$userid = $_POST['userid'];
$username = $_POST['username'];
$useremail = $_POST['useremail'];
$phoneNumber = $_POST['phoneNumber'];
$userroleid = $_POST['userroleid'];

$query = "update user set username = :username, useremail = :useremail, phoneNumber = :phoneNumber, userroleid = :userroleid WHERE userid = :userid"; 
$data = array( 'username' => $username, 'useremail' => $useremail,'phoneNumber' => $phoneNumber,'userroleid' => $userroleid, 'userid' => $userid);
$stmt = $conn->prepare($query); 

if($stmt -> execute($data)) 
{ 
	$rows_affected = $stmt->rowCount(); 
	echo "<h2>".$rows_affected." row updated sucessfully!</h2>";
	include 'display.php'; 
	display("SELECT * FROM user;"); 
}
else 
{ 
	echo "update failed: (" . $conn->errno . ") " . $conn->error; 
}
$conn->close(); 
?>
