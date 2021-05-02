<?php 

session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST"){ //When clicked on login

		$user_name = $_POST['username'];     //Get the values of input texts
		$password = $_POST['password'];

		$hash_pass = md5($password);       //Hash password with md5 since we added hashed version of password to the database.
		

			$query = "select username from users where username =? and password=? "; //Check whether account is in the database or not

			if ($stmt = $con->prepare($query)){      //In this part we are preparing statement as we did every sql statement in this assignment
				                                     //The reason why we are doing this is to block all sql injections

				$stmt->bind_param("ss", $user_name,$hash_pass);

				if($stmt->execute()){
					$stmt->store_result();
					$stmt->bind_result($username);
					$stmt->fetch();
					if ($stmt->num_rows == 1){         // If the account exists then rotate to welcome page

						$_SESSION['username'] = $username; // Take the username in session to write in welcome page
						header("Location:welcome.php");
						die;

					}else{
						echo "wrong password or username";
					}
				}else{
					echo "Problem occured while executing sql statement";
				}
				$stmt->close();
			}else{
				echo "Problem occured while preparing sql statement";
			}


	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	                                                          <!-- Frontend Part--> 
</head>
<body>
	
                                                                 <!-- Styling -->
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
		margin-left:100px;
		padding: 10px;
		width: 100px;
		color: white;
		background-color: red;
		border: none;
		border-radius:40px;
	}

	#box{

        position: fixed;
		top: 50%;
        left: 50%;
		margin-top: -200px;
        margin-left: -225px;
		background-color: black;
		width: 300px;
		padding: 40px;
		border-radius:40px;
	}

	</style>

	<div id="box">                                   <!-- Login Form-->
		
		<form method="post">
			<div  style="font-size: 20px;margin: 10px;color: white;text-align:center;">Login</div>
			<p style="color:white";>Username</p>
			<input id="text" type="text" name="username" required><br><br>
			<p style="color:white";>Password</p>
			<input id="text" type="password" name="password" required><br><br>
            
			<input id="button" type="submit" value="Login"><br><br>

			<a style ="color: white;" href="signup.php">Signup</a><br><br>
		</form>
	</div>
</body>
</html>