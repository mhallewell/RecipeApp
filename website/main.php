<?php
require_once "database/Database.php";
//require_once "user/User.php";
// Code to override login mechanism for testing.
session_start();

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

// Code to override login mechanism for testing
//$_SESSION["user"] = new User(0, "TestUser", "");

// Check if the user is logged in
if (!isset($_SESSION["user"]))
{
	// If there is no user logged in, show the login
	include "html/login.php";
}
else
{
	// TODO Change to the correct main page
	include "html/main.php";
}
?>
