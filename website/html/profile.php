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
  <div id="profileMainBody">
    <img class="profilePicture" src="<?php echo $_SESSION['user']->getPicture();?>"/>
    <h1><?php echo $_SESSION["user"]->getName()?></h1>
    <h3>Number of Recipes: <?php echo $numRecipes?></h3>
    <h3><a href="recipeList.php?viewMine=true">View Recipe Book</a></h3>
  </div>

</body>
</html>
