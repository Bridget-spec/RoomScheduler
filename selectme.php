<!DOCTYPE html>
<html>
<head>
 <title>Display1</title>
</head>
<body>
<?php
 echo "The Names and Phone Numbers of all  Managers";
/* database connection info. Replace * with your information */
$host = "pluto.hood.edu";
$dbname = "bna6db";
$user = "bna6";
$pass = "password";
try {
 // create the connection
 $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
 // set the PDO error mode to exception
 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
 // execute the query
 $stmt = $conn->query("SELECT u.username, u.phoneNumber
 FROM user u
 JOIN user_role r ON u.userroleid = r.userroleid
 WHERE r.userRoleName = 'Manager'
 ");
 //returns each row in result as an array indexed by column name
 $stmt->setFetchMode(PDO::FETCH_ASSOC);
}
catch(PDOException $e) {
 die("Could not connect to the database $dbname :" . $e->getMessage());
}
//Construct a table with two columns (Name and Salary) to store query result.
echo "<table border=1>\n";
echo "<tr><th>Username</th><th>Phone Number</th></tr>\n";
//Fetch rows in the query result using a loop.
while ($row = $stmt->fetch()) {
 printf("<tr><td> %s</td><td>%s</td></tr>\n", $row['username'], $row['phoneNumber']);
}
echo "</table>\n";
// disconnect from the database
$conn = null;
?>
</body>
</html>