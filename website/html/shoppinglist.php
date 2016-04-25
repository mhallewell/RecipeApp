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
  <!-- script for toggle functionality-->
  <script>
  $(function(){

    $('[data-toggle]').on('click', function(){
      var id = $(this).data("toggle"),
      $object = $(id),
      className = "open";

      if ($object) {
        console.log('Object exists');
        if ($object.hasClass(className)) {
          console.log('Removing open class');
          $object.removeClass(className)
          // $(this).text("Shopping List:");
        } else {
          console.log('Adding open class');
          $object.addClass(className)
          // $(this).text("Shopping List:");
        }
      }
    });
  });
  </script>
    <!-- print button and functionality-->
  <style type="text/css" media="print">
  .printbutton {
    visibility: hidden;
    display: none;
  }
  @media print{
  #header{ display:none; }
}
  </style>

  <!--Shopping list list-->
  <p>Shopping List Dates</p>
  <div>
    <a href="#" class="hide" data-toggle="#listDay">1 Day List</a>
    <ol id="listDay">
	<?php
		foreach ($dayIngredients as $ingredient)
		{
			echo '<li>'.strip_tags($ingredient->getName()).'&nbsp;';
			echo strip_tags($ingredient->getQuantity()).'</li>';
		}
	?>
    </ol>
    <script>
    document.write("<input type='button' " +
    "onClick='window.print()' " +
    "class='printbutton' " +
    "value='Print This Page'/>");
    </script>
  </div>
  <div>
    <a href="#" class="hide" data-toggle="#listWeek">1 Week List</a>
    <ol id="listWeek">
	<?php
		foreach ($weekIngredients as $ingredient)
		{
			echo '<li>'.strip_tags($ingredient->getName()).'&nbsp;';
			echo strip_tags($ingredient->getQuantity()).'</li>';
		}
	?>
    </ol>

    <script>
    document.write("<input type='button' " +
    "onClick='window.print()' " +
    "class='printbutton' " +
    "value='Print This Page'/>");
    </script>

  </div>
  <div>
    <a href="#" class="hide" data-toggle="#listMonth">1 Month List</a>
    <ol id="listMonth">
	<?php
		foreach ($monthIngredients as $ingredient)
		{
			echo '<li>'.strip_tags($ingredient->getName()).'&nbsp;';
			echo strip_tags($ingredient->getQuantity()).'</li>';
		}
	?>
    </ol>

    <script>
    document.write("<input type='button' " +
    "onClick='window.print()' " +
    "class='printbutton' " +
    "value='Print This Page'/>");
    </script>

  </div>


</body>
</html>
