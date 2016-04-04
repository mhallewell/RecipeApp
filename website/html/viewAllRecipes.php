<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>
<body>

  <div id="header">
    <!-- <h1>Recipe Calendar</h1> -->
      <a href="main.html"><img class="menu" src="../image/header3.png" width="60" height="100"/></a>
    <div id="menu">
      <ul>
        <div class="dropdown">
          <li><a href="calendarMonth.html">Calendar</a></li>
          <div class="dropdown-content">
            <a href="calendarDay.html">Day View</a>
            <a href="calendarWeek.html">Week View</a>
            <a href="calendarMonth.html">Month View</a>
          </div>
        </div>
        <div class="dropdown">
          <li><a href="recipes.php">Recipes</a></li>
          <div class="dropdown-content">
            <a href="viewAllRecipes.html">View All Recipes</a>
            <a href="TODO">Add Recipe</a>
            <a href="TODO">Edit Recipe</a>
            <a href="TODO">Search Recipes</a>
          </div>
        </div>
        <div class="dropdown">
          <li><a href="shoppinglist.php">Shopping List</a></li>
          <div class="dropdown-content">
            <a href="TODO">Day View</a>
            <a href="TODO">Week View</a>
            <a href="TODO">Two Week View</a>
          </div>
        </div>
        <li><a href="profilepage.php">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>

  <div id="viewAllRecipesBody">
    <ul>
	<?php foreach ($recipes as $recipe)
		{
			echo '<li><a href="/viewRecipe.php?id=';
			echo $recipe->getId();
			echo '">';
			echo $recipe->getName();
			echo '</a></li>';
		}
 		?>
    </ul>
  </div>
