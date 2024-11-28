<?php 
 include_once 'db.php'; 
 include 'display.php'; 
 echo "<h2> Display the information </h2>"; 
 display("SELECT * FROM meetingbooking;"); 
?> 

<br/> 
<form action="/~bna6/fill_to_update2.php" method="post"> 
<h2>User to Select:</h2>
Meeting ID: <input type="text" name="meetingid"/><br>
<input type="Submit" value="Select"/><input type="Reset"/>
</form>