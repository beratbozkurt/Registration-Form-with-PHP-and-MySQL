<?php 
session_start();

	include("connection.php");

	if(!isset($_SESSION['username'])){ // If the username was not set in session then no permission to enter welcome page

		echo "No Permission";

	}else{

	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>Welcome</h1>

	<br>
	<strong> Hello, <?php   //If username was set in sesssion that means enterance happened succesfully, HELLOOOO
	echo $_SESSION['username']; 
	?> </strong>
	<br> 
	
	<center> ALL USERS IN DATABASE </center>
	 
	 <br> 
	
	<?php 
	$query = "select * from users";                    // Get all users from database
	$result = mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result) ){
		echo  "<strong>User Id: </strong>" , $row['user_id'],
		 "  -  <strong>Username: </strong>",$row['username'],
		 "  -  <strong>Email: </strong>", $row['email'],
		 "  -  <strong>Phone: </strong>", $row['phone'],
		 "<br>";
	}
	?>
</body>
</html>
<?php

	}
	
?>
