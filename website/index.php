<?php
require "database/Database.php";

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

// Check if the user is logged in
if (!isset($_SESSION['user']))
{
	// If there is no user logged in, redirect to the login 
	include "html/login.html";
}
else
{
	// TODO Change to the correct main page
	include "profile.php";
}
?>
