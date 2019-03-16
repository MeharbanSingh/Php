<?php
error_reporting(E_ALL);
//This page logs a user out
session_start();

//Unset all session variables and destroy the session file
$_SESSION = array();
session_destroy();

//Redirect the user to the login page
header('Location: public_section.php');
?>