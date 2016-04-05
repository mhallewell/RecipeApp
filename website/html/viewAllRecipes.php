<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="../js/header.js"></script>
</head>
<body>

  <div id="header">
    <!-- <h1>Recipe Calendar</h1> -->

  </div>

  <div id="viewAllRecipesBody">
    <ul>
	<?php foreach ($recipes as $recipe)
		{
			echo '<li><a href="/viewRecipe.php?id=';
			echo $recipe->getId();
			echo '">';
			echo strip_tags($recipe->getName());
			echo '</a></li>';
		}
 		?>
    </ul>
  </div>
