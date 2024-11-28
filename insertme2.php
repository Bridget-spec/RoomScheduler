<!DOCTYPE html>
<html>
<body>

<?php
// form data
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


//connection DSN
$host = "pluto.hood.edu";
$dbname = "bna6db";
$user = "bna6";
$pass = "password";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    #use prepared statement with named placeholders :customer_name, :customer_city, :customer_street, 
    $sql = "insert into meetingbooking (title, date , description, startTime, endTime, bookingid, roomid , userid, status, pattern) values(:title, :date , :description, :startTime, :endTime, :bookingid, :roomid , :userid, :status, :pattern)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':startTime', $startTime);
    $stmt->bindParam(':endTime', $endTime);
    $stmt->bindParam(':bookingid', $bookingid);
    $stmt->bindParam(':roomid', $roomid);
    $stmt->bindParam(':userid', $userid);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':pattern', $pattern);


    if ($stmt->execute()) {
         $rows_affected = $stmt->rowCount();
         echo "<h2>".$rows_affected." row added sucessfully!</h2>";
         $stmt = $conn->query("SELECT * FROM meetingbooking");

         // PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0
         $stmt->setFetchMode(PDO::FETCH_NUM);

         echo "<table border=\"1\">\n";
         echo "<tr><td>Meeting ID</td><td>Title</td><td>Date</td><td>Description</td><td>Start Time</td><td>End Time</td><td>Booking ID</td><td>Room ID</td><td>User ID</td><td>Status</td><td>Pattern</td></tr>\n";
         while ($row = $stmt->fetch()) {
            printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8], $row[9], $row[10]);
         }
         $result->close();
         echo "</table>\n";
    }
    else
    {
         echo "Insertion failed: (" . $conn->errno . ") " . $conn->error;
    }

    $conn = null;
}
catch(PDOException $e) {
    die("Could not connect to the database $dbname: " . $e->getMessage());
}

?>

</body>
</html>