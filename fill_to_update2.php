<form action="update2.php" method="post"> 
<?php 
include_once 'db.php'; 

$meetingid = $_POST['meetingid']; ;

# prepared statement with Unnamed Placeholders 
$query = "select * from meetingbooking where meetingid = ?;";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $meetingid); # bind by value and assign variables to each placeholder
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_NUM);
$row = $stmt->fetch();


printf("<input type=\"hidden\" name=\"meetingid\" value=\"%s\"/><br>\n", $row[0]);
printf("Title: <input type=\"text\" name=\"title\" value=\"%s\"/><br>\n", $row[1]);
printf("Date: <input type=\"text\" name=\"date\" value=\"%s\"/><br>\n", $row[2]);
printf("Description: <input type=\"text\" name=\"description\" value=\"%s\"/><br>\n", $row[3]);
printf(":Start Time <input type=\"text\" name=\"startTime\" value=\"%s\"/><br>\n", $row[4]);
printf("End Time: <input type=\"text\" name=\"endTime\" value=\"%s\"/><br>\n", $row[5]);
printf("Booking Id: <input type=\"text\" name=\"bookingid\" value=\"%s\"/><br>\n", $row[6]);
printf("Room ID: <input type=\"text\" name=\"roomid\" value=\"%s\"/><br>\n", $row[7]);
printf("User ID: <input type=\"text\" name=\"userid\" value=\"%s\"/><br>\n", $row[8]);
printf("Status: <input type=\"text\" name=\"status\" value=\"%s\"/><br>\n", $row[9]);
printf("Pattern: <input type=\"text\" name=\"pattern\" value=\"%s\"/><br>\n", $row[10]);
?>
<br/> 
<input type="Submit" value= "Update"/><input type="Reset"/> 
</form>
