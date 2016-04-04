<?php
require_once "database/Database.php";
include_once "recipe/Recipe.php";
include_once "recipe/Ingredient.php";

// Code to override login mechanism for testing.
session_start();

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

$recipe = new Recipe();
$recipe->setName("Test Recipe");
$recipe->setDescription("This is a test of the database!");
$recipe->setInstructions("Testing the database requires time and effort!");

$ingredient1 = new Ingredient();
$ingredient1->setName("Test1");
$ingredient1->setQuantity("5 cups");

$ingredient2 = new Ingredient();
$ingredient2->setName("Paprika");
$ingredient2->setQuantity("4 pinches");

$recipe->addIngredient($ingredient1);
$recipe->addIngredient($ingredient2);

var_dump($recipe);

$id = $_SESSION['database']->createRecipe(0, $recipe);
var_dump($recipe);

$recipe2 = $_SESSION['database']->selectRecipe($id);
var_dump($recipe2);

$recipeList = $_SESSION['database']->searchRecipes('rice');
var_dump($recipeList);
