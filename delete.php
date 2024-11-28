<?php 
include_once 'db.php';
 
#form data 
$username = $_POST['username']; 
$sql = "delete from user where username = :username; ";
$stmt = $conn->prepare($sql); 

# data stored in an associative array 
$data = array('username' => $username); 

if($stmt->execute($data)){ 
	$rows_affected = $stmt->rowCount(); 
	echo "<h2>".$rows_affected." row deleted sucessfully!</h2>"; 
	$stmt = $conn->query("SELECT * FROM user"); 

	//PDO::FETCH_NUM: returns an array indexed by column number as returned in your result set, starting at column 0 
	$stmt->setFetchMode(PDO::FETCH_NUM); 
	echo "<table border=\"1\">\n"; 
	echo "<tr><td>User ID</td><td>Name</td><td>Email</td><td>Phone Number</td><td>User Role id</td></tr>\n"; 
	while ($row = $stmt->fetch()) { 
		printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $row[0], $row[1], $row[2], $row[3], $row[4]); 
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
