<?php
session_start();
unset($_SESSION["user"]);
unset($_SESSION["database"]);
session_destroy();

header("Location: index.php");
die();

?>
