<?php
require_once "database/Database.php";
include_once "recipe/Recipe.php";
include_once "user/User.php";
// Code to override login mechanism for testing.
session_start();

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

// Check if the user is logged in
if (!isset($_SESSION["user"]))
{
	// If there is no user logged in, show the login
	include "html/login.php";
}
else
{
	$startDate = new DateTime();
	$endDate = new DateTime();
	$endDate->modify('+7 days');
	$calDates = $_SESSION['database']->getDateRange($_SESSION["user"]->getUserId(), $startDate->format("Y-m-d"), $endDate->format("Y-m-d"));
	include "html/calendar.php";
}
?>
