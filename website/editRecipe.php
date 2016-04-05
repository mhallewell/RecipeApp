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
	if (!isset($_POST['recipeId'])
	{
		$recipe = $_SESSION['database']->selectRecipe($_GET['id']);

		include "html/editRecipe.php";
	}
	else
	{
		$recipe = new Recipe();
		$recipe->setId($_POST['recipeId']);
		$recipe->setName($_POST['recipeName']);
		$recipe->setDescription($_POST['description']);
		$recipe->setInstructions($_POST['directions']);
		foreach($_POST['ingredients'] as $ing)
		{
			$ingredient = new Ingredient();
			$ingredient->setName($ing['name']);
			$ingredient->setQuantity($ing['quantity']);
			$recipe->addIngredient($ingredient);
		}
		
		$recipe = $_SESSION['database']->updateRecipe($recipe);

		header("Location: viewRecipe.php?id=" . $recipe->getId());
		die(); // End running this php after the redirect
	}
}
?>
