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

  <div id="viewRecipeBody">
    <h2><?php echo strip_tags($recipe->getName());?></h2>
		<?php
			if($_SESSION["user"]->getUserId() != $recipe->getUserId()){
				echo '<a href="copyRecipe.php?id=';
				echo $recipe->getId(); 
				echo '">+ Add to my Recipe Book</a>';
			}
			else{
				echo '<a href="editRecipe.php?id=';
				echo $recipe->getId(); 
				echo '">+ Edit Recipe</a>';
			}
		?>
    <div id="ingredients"><h3>Ingredients:<ul>
	<?php foreach($recipe->getIngredients() as $ingredient)
		{
		echo '<li>';
		echo strip_tags($ingredient->getQuantity());
		echo ' ';
		echo strip_tags($ingredient->getName());
		echo '</li>';
		}
	?>
	</h3></div>

    <div id="directions"><h3>Directions:<?php echo strip_tags($recipe->getInstructions(), '<p>'); ?></h3></div>
  </div>

</body>
</html>
