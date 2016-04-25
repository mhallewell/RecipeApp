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
      		echo '<th class="tg-yw4l">'.$curDate->format('m-d-Y').'</th>';

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
			<td class="tg-yw4l"><a href="chooseRecipe.php?Date=<?php echo $curDate->format('Y-m-d')?>">+Add a recipe</a><br><br>
			<?php $recipes = $calDates[$curDate->format('Y-m-d')]->getRecipes();
			if (isset($recipes))
			{
				foreach ($recipes as $recipe)
				{
        				echo '<a href="viewRecipe.php?id='.$recipe->getId().'">'.strip_tags($recipe->getName()).'</a>';
                echo '<a href="chooseRecipe.php?date=<?php echo $curDate->format('Y-m-d')?>';
                echo '&id='.$recipe->getId().'">-</a><br></td>';
				}
			}
			$curDate->add($interval);
		} ?>
    </tr>
  </table>

</body>
</html>
