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
  <div class="mainbody" >This is the main body.
	<div> Username: <?php echo ($_SESSION["user"]->getName()); ?> </div>
</body>
</html>
