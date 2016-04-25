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

  <table class="tg">
    <tr>
	<?php
	$curDate = clone $startDate;
	for($i = 0; $i < 7; ++$i)
	{
      if(i==1){
        echo '<div class="navigateLeft"><a href="navigateLeft.php"><</a></div>';
        echo '<th class="tg-yw4l">'.$curDate->format('m-d-Y').'</th>';
      }
      else if(i==7){
        echo '<th class="tg-yw4l">'.$curDate->format('m-d-Y').'</th>';
        echo '<div class="navigateRight"><a href="navigateRight.php">></a></div>';
      }
      else{
      	echo '<th class="tg-yw4l">'.$curDate->format('m-d-Y').'</th>';
      }

		$curDate->modify('+1 day');
	}?>
    </tr>
    <tr>
	<?php
		$interval = date_interval_create_from_date_string("1 day");
		$curDate = $startDate;
		for($i = 0; $i < 7; ++$i)
		{
      			?>
			<td class="tg-yw4l">
			<div class="weekCalFixed"><a href="chooseRecipe.php?Date=<?php echo $curDate->format('Y-m-d')?>">+Add a recipe</a><br><br>
			<?php $recipes = $calDates[$curDate->format('Y-m-d')]->getRecipes();
			if (isset($recipes))
			{
				foreach ($recipes as $recipe)
				{
        				echo '<a href="viewRecipe.php?id='.$recipe->getId().'">'.strip_tags($recipe->getName()).'</a>';
                echo '<a class="removeButton" href="removeRecipeFromDate.php?date='.$curDate->format('Y-m-d');
                echo '&id='.$recipe->getId().'">';
		echo '<img class="removeButtonImage" src="../image/minus-circle.jpg"/></a><br>';
				}
			}
			$curDate->add($interval);
			echo '</div></td>';
		} ?>
    </tr>
  </table>

</body>
</html>
