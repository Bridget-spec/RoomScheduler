<?php 

include_once 'db.php'; 

# form data 
$meetingid = $_POST['meetingid'];
$title = $_POST['title'];
$date = $_POST['date'];
$description = $_POST['description'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$bookingid = $_POST['bookingid'];
$roomid = $_POST['roomid'];
$userid = $_POST['userid'];
$status = $_POST['status'];
$pattern = $_POST['pattern'];

$query = "update meetingbooking set title = :title, date = :date, description = :description, startTime = :startTime, endTime = :endTime, bookingid = :bookingid, roomid = :roomid, userid = :userid, status = :status, pattern = :pattern WHERE meetingid = :meetingid"; 
$data = array( 'title' => $title, 'date' => $date, 'description' => $description,'startTime' => $startTime, 'endTime' => $endTime, 'bookingid' => $bookingid, 'roomid' => $roomid, 'userid' => $userid,'status' => $status,'pattern' => $pattern, 'meetingid' => $meetingid);
$stmt = $conn->prepare($query); 

if($stmt -> execute($data)) 
{ 
	$rows_affected = $stmt->rowCount(); 
	echo "<h2>".$rows_affected." row updated sucessfully!</h2>";
	include 'display.php'; 
	display("SELECT * FROM meetingbooking;"); 
}
else 
{ 
	echo "update failed: (" . $conn->errno . ") " . $conn->error; 
}
$conn->close(); 
?>
