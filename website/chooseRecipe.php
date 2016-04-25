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
	//if (!isset($_GET['q']) && !isset($_GET['viewMine']))
	//{
		// TODO Change to the correct main page
	//	$recipes = $_SESSION['database']->getAllRecipes();
	//}
	//else if (isset($_GET['viewMine']))
	//{
	$recipes = $_SESSION['database']->getRecipesByUserId($_SESSION['user']->getUserId());
	//}
	//else if (isset($_GET['q']))
	//{
	//	$recipes = $_SESSION['database']->searchRecipes($_GET['q']);
	//}
	$date = new DateTime($_GET['Date']);
	include "html/chooseRecipe.php";
}
?>
