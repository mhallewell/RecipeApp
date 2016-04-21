<!DOCTYPE html>

<html>
<head>
      <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="../js/header.js"></script>
</head>
<body>

  <div id="header">
  </div>
<h2>Recipe Name</h2>
<form action="createRecipe.php" method="post">
<input type="text" name="recipeName" value="<?php echo $recipe->getName();?>">

<h3>Ingredients</h3>
<div class="chatForm">
<?php
	$count = 1;
	foreach ($recipe->getIngredients() as $ingredient)
	{
	?>
  <input type="text" name="ingredients[<?php echo $count; ?>][quantity]" value="<?php echo $ingredient->getQuantity();?>">
  <input type="text" name="ingredients[<?php echo $count; ?>][name]" value="<?php echo $ingredient->getName();?>"><br>
	<?php
		$count += 1;
	}
	?>
</div><br><br>

<div id="directions">
<h3>Directions</h3>
<textarea rows="5" cols="80" id="TITLE" name="directions"><?php echo $recipe->getInstructions(); ?></textarea>
</div>

<div id="description">
<h3>Description</h3>
<textarea rows="5" cols="80" id="TITLE" name="description"><?php echo $recipe->getDescription();?></textarea>
</div>

<input type="submit" value="Submit">
</form>

</body>
</html>
