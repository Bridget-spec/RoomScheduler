<?php 
 include_once 'db.php'; 
 include 'display.php'; 
 echo "<h2> Display the information </h2>"; 
 display("SELECT * FROM user;"); 
?> 

<br/> 
<form action="/~bna6/fill_to_update.php" method="post"> 
<h2>User to Select:</h2>
User ID: <input type="text" name="userid"/><br>
<input type="Submit" value="Select"/><input type="Reset"/>
</form>