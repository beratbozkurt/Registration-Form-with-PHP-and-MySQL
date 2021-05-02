<?php
// This page helps to connect frontend and datbase


$dbhost = "localhost";    ////!!!Your MySQL enterance data!!!////
$dbuser = "root";
$dbpass = "1798";

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass))
{
	die("Connection Failed To Database Service!!!");
}else{

	// After the connection succesfully created, This part is creating necessary database and table if not exists before.

	$query = "CREATE DATABASE IF NOT EXISTS berat_bozkurt_login_db";
	$result = mysqli_query($con,$query);

	if($result){
	
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,"berat_bozkurt_login_db");

	if($con){
		
		$query = "CREATE TABLE IF NOT EXISTS `users` (
			`user_id` int(8) NOT NULL AUTO_INCREMENT,
			`username` varchar(100) NOT NULL ,
			`password` varchar(100) NOT NULL,
			`email` varchar(250) NOT NULL,
			`phone` varchar(11) NOT NULL,
			PRIMARY KEY (`user_id`)
		)";
		$result = mysqli_query($con,$query);

		
		}else{
			die("Connection Failed To Database Service!!!");
		}

	}else{

		die("login_db has not been created");

	}
}