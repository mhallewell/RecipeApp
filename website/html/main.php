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

  <div id="mainBody">
    <img class="mainBody" src="../image/chicken.jpg"/>
    <h1>Suggested Recipe of the Day</h1>
    <h2><?php echo strip_tags($recipe->getName());?></h2>
    <a href="copyRecipe.php?id=<?php echo $recipe->getId(); ?>">+ Add to my Recipe Book</a>
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
