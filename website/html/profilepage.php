<!DOCTYPE html>

<html>
<head>
      <link rel="stylesheet" type="text/css" href="../css/stylesheet.css">
</head>
<body>
  <div id="header">

    <a class="logout" href="logout.php"><img src="http://dabuttonfactory.com/button.png?t=Logout&f=Caviar-Bold&ts=20&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a>
    <!-- <h1>Recipe Calendar</h1> -->
    <div id="menu">
      <ul>
        <li><a href="main.html"><img src="../image/Utensil.png" width="60" height="100"/></a></li>
        <li><a href="calendar.html"><img src="http://dabuttonfactory.com/button.png?t=Calendar&f=Caviar-Bold&ts=28&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a></li>
        <li><a href="recipes.html"><img src="http://dabuttonfactory.com/button.png?t=Recipes&f=Caviar-Bold&ts=28&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a></li>
        <li><a href="shoppinglist.html"><img src="http://dabuttonfactory.com/button.png?t=Shopping+List&f=Caviar-Bold&ts=28&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a></li>
        <li><a href="pantry.html"><img src="http://dabuttonfactory.com/button.png?t=Pantry&f=Caviar-Bold&ts=28&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a></li>
        <li><a href="profilepage.html"><img src="http://dabuttonfactory.com/button.png?t=Profile&f=Caviar-Bold&ts=28&tc=eef5db&hp=20&vp=8&c=1&bgt=gradient&bgc=fe5f55&ebgc=fe5f55"/></a></li>
      </ul>
    </div>
  </div>
  <div class="mainbody" >This is the main body.
	<div> Username: <?php echo ($_SESSION["user"]->getName()); ?> </div>
</body>
</html>