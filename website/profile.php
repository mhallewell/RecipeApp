<?php
require_once "database/Database.php";
session_start();

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
	$numRecipes = $_SESSION['database']->getNumberOfRecipes($_SESSION['user']->getUserId());
	include "html/profile.php";
}
