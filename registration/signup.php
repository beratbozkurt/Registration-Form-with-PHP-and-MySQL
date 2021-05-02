<?php 
session_start();

	include("connection.php");


	if($_SERVER['REQUEST_METHOD'] == "POST"){  // when clicked on signup

		
		$user_name = $_POST['username'];            // Get the values of input texts
		$password = $_POST['password'];
		$confirm_pass = $_POST['confirm_password'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$count = 0 ;
		                                           //Necessary checkings of input texts whether they are proper or not.
		if(strpos($email,"@") == false){
			echo "Email must contain '@' ", "<br>";
			$count++;
		}

		if(!is_numeric($phone)){
			echo "Phone needs to be numeric", "<br>";
			$count++;
		}
		if(strlen($phone)!=11){
			echo "Phone must contain 11 digits", "<br>";
			$count++;
		}
	
		if(strlen($password)<8){
			echo "Password must contain at least 8 characters", "<br>";
			$count++;
		}
		
		if($confirm_pass != $password ) {
			echo "Passwords are not maching!!!", "<br>";
			$count++;
			} 

		$query = "SELECT `username` FROM users WHERE username=?";

		if ($stmt = $con->prepare($query)){                      //Check the username exists or not

				$stmt->bind_param("s", $user_name);

				if($stmt->execute()){

					$stmt->store_result();
					$stmt->bind_result($username_check);
					$stmt->fetch();

					if ($stmt->num_rows == 1){

					echo "That Username already exists.", "<br>";
					$count++;
					}
				}
			}
		$query = "SELECT `email` FROM users WHERE email=?";

		if ($stmt = $con->prepare($query)){             //Check the email exists or not

				$stmt->bind_param("s", $email);

				if($stmt->execute()){

					$stmt->store_result();
					$stmt->bind_result($email_check);
					$stmt->fetch();

					if ($stmt->num_rows == 1){

					echo "That Email already exists.", "<br>";
					$count++;
					}
				}
			}
	
		$query = " SELECT `phone` FROM users WHERE phone=? ";

		if ($stmt = $con->prepare($query)){              //Check the phone exists or not

				$stmt->bind_param("s", $phone);

				if($stmt->execute()){

					$stmt->store_result();
					$stmt->bind_result($phone_check);
					$stmt->fetch();

					if ($stmt->num_rows == 1){

					echo "That Phone already exists.", "<br>";
					$count++;
					}
				}
			}	
		if($count==0) // if every control is okey then signup the person and add to database. In order to make more secure the system, numerous controls can be added.
		{
			$query = "INSERT INTO users (username,password,email,phone) VALUES ( ? , ? , ? , ? )";
			if ($stmt = $con->prepare($query)){

				$hash_pass = md5($password); // hashing password with md5 to protect 
				$stmt->bind_param("ssss", $user_name, $hash_pass, $email,$phone);
				
				if($stmt->execute()){
					header("Location: login.php");
					die;
				}else{
					echo "Account has not been created!!!";
				}
			}
			
		}else
		{
			echo "Please enter some valid information!";
		}
		$stmt->close();
	}
	
?>
<!DOCTYPE html>
<html>
                                                   <!-- Frontend Part--> 
<head>
	<title>Signup</title>
</head>
<body>												<!-- Styling --> 
	<style type="text/css">
	
	#text{
		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
		border-radius:40px;
	}

	#button{
		margin-left: 100px;
		padding: 10px;
		width: 100px;
		color: white;
		background-color: red;
		border-radius:40px;
		border:none;
	}

	#box{

        position: fixed;
		top: 50%;
        left: 50%;
		margin-top: -325px;
        margin-left: -225px;
		background-color: black;
		width: 300px;
		padding: 40px;
		border-radius:40px;
	}

	</style>

	<div id="box">                            <!-- Registration Form--> 
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white; text-align:center;">Signup</div>
			<p style="color:white";>Username</p>
			<input id="text" type="text" name="username" required><br>
			<p style="color:white";>Email</p>
			<input id="text" type="text" name="email" required><br>
			<p style="color:white";>Phone</p>
			<input id="text" type="text" name="phone" required><br>
			<p style="color:white";>Password</p>
			<input id="text" type="password" name="password" required><br>
			<p style="color:white";>Confirm Password</p>
			<input id="text" type="password" name="confirm_password" required><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a style= " color:white;"href="login.php">Login</a><br><br>
		</form>
	</div>
</body>
</html>