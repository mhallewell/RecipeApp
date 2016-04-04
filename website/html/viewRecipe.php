<?php
var_dump($recipe);


echo $recipe->getName();

echo $recipe->getDescription();

echo $recipe->getInstructions();

$ingredients = $recipe->getIngredients();
foreach ($ingredients as $ingredient)
{
	echo $ingredient->getName();
	?>

	<?php
	echo 'html goes here';
	echo $ingredient->getQuantity();
}
?>
