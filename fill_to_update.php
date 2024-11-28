<form action="update.php" method="post"> 
<?php 
include_once 'db.php'; 

$userid = $_POST['userid']; ;

# prepared statement with Unnamed Placeholders 
$query = "select * from user where userid = ?;";
$stmt = $conn->prepare($query);
$stmt->bindValue(1, $userid); # bind by value and assign variables to each placeholder
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_NUM);
$row = $stmt->fetch();


printf("<input type=\"hidden\" name=\"userid\" value=\"%s\"/><br>\n", $row[0]);
printf("User Name: <input type=\"text\" name=\"username\" value=\"%s\"/><br>\n", $row[1]);
printf("User Email: <input type=\"text\" name=\"useremail\" value=\"%s\"/><br>\n", $row[2]);
printf("Phone Number: <input type=\"text\" name=\"phoneNumber\" value=\"%s\"/><br>\n", $row[3]);
printf("User Role ID: <input type=\"text\" name=\"userroleid\" value=\"%s\"/><br>\n", $row[4]);
?>
<br/> 
<input type="Submit" value= "Update"/><input type="Reset"/> 
</form>
