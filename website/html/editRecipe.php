<!DOCTYPE html>

<html>
<head>
      <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="../js/header.js"></script>
      <script src="../js/main.js"></script>
</head>
<body>

  <div id="header">
  </div>
<h2>Recipe Name</h2>
<form action="createRecipe.php" method="post">
<input type="text" name="recipeName" value="<?php echo $recipe->getName();?>">

<h3>Ingredients</h3>
<div id="ingredientButtons">
	<a href="javascript:void(0)" onclick="addIngredient()">Add Ingredient</a>
	<a href="javascript:void(0)" onclick="removeIngredient()">Remove Ingredient</a>
</div><br>
<div class="chatForm">
<div id="innerChatForm">
<?php
	$count = 0;
	foreach ($recipe->getIngredients() as $ingredient)
	{
	?>
		<div id="F<?php echo $count; ?>">
			<input type="text" name="ingredients[<?php echo $count; ?>][quantity]" value="<?php echo $ingredient->getQuantity();?>">
			<input type="text" name="ingredients[<?php echo $count; ?>][name]" value="<?php echo $ingredient->getName();?>"><br>
		</div>
	</div>
	<?php
		$count += 1;
	}
	echo '<input type="hidden" id="numRecipes" value="'.($count-1).'">';
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
