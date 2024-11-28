<?php 
include_once 'db.php';
 
#form data 
$meetingid = $_POST['meetingid']; 
$sql = "delete from meetingbooking where meetingid = :meetingid; ";
$stmt = $conn->prepare($sql); 

# data stored in an associative array 
$data = array('meetingid' => $meetingid); 

if($stmt->execute($data)){ 
	$rows_affected = $stmt->rowCount(); 
	echo "<h2>".$rows_affected." row deleted sucessfully!</h2>"; 
	$stmt = $conn->query("SELECT * FROM meetingbooking"); 

	//PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0 
	$stmt->setFetchMode(PDO::FETCH_NUM); 
	echo "<table border=\"1\">\n"; 
	echo "<tr><td>Meeting ID</td><td>Title</td><td>Date</td><td>Description</td><td>Start Time</td><td>End Time</td><td>Booking ID</td><td>Room ID</td><td>User ID</td><td>Status</td><td>Pattern</td></tr>\n";
	while ($row = $stmt->fetch()) { 
		printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]); 
	} 
	echo "</table>\n"; 
}
else 
{ 
	echo "\nPDOStatement::errorInfo():\n"; 
	print_r($stmt->errorInfo()); 
}
$stmt = null; 
$conn = null; 
?>
