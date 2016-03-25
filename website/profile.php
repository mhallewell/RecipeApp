<?php
require_once "database/Database.php";

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

// Check if the user is logged in
if (!isset($_SESSION['user']))
{
	// If there is no user logged in, redirect to the index 
	header("Location: index.php");
	die(); // End running this php after the redirect
}
else
{
	// TODO Add in the profile generation
	include "html/profilepage.php";
}
