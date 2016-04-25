<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="js/header.js"></script>
</head>
<body>
  <table class="tg">
    <tr>
      <th class="tg-yw4l">Wednesday</th>
      <th class="tg-yw4l">Thursday</th>
      <th class="tg-yw4l">Friday</th>
      <th class="tg-yw4l">Saturday</th>
      <th class="tg-yw4l">Sunday</th>
      <th class="tg-yw4l">Monday</th>
      <th class="tg-yw4l">Tuesday</th>
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
        				echo '<a href="viewRecipe.php?id='.$recipe->getId().'">'.$recipe->getName().'</a><br></td>';
				}
			}
			$curDate->add($interval);
		} ?>
    </tr>
  </table>

</body>
</html>
