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
<input type="text" name="recipeName" value="Recipe name here">

<h3>Ingredients</h3>
<div id="Amount"></div>
<div id="ingrediendButtons">
	<button onclick="addIngredient()">Add Ingredient</button>
	<button onclick="removeIngredient()">Remove Ingredient</button>
</div><br>
<div class="chatForm">
  <input type="text" name="ingredients[1][quantity]" value="Quantity">
  <input type="text" name="ingredients[1][name]" value="Ingredient"><br>
	<div id="Add"></div>
</div><br><br>

<div id="directions">
<h3>Directions</h3>
<textarea rows="5" cols="80" id="TITLE" name="directions"></textarea>
</div>

<div id="description">
<h3>Description</h3>
<textarea rows="5" cols="80" id="TITLE" name="description"></textarea>
</div>

<input type="submit" value="Submit">
</form>

</body>
</html>
