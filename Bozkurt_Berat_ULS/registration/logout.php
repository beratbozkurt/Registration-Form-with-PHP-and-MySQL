<?php

session_start();

if(isset($_SESSION['username']))
{
   unset($_SESSION['username']); //While logging out, unset the username in session not to give permission user to enter again to welcome page.

}
header("Location: login.php");
die;