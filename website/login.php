<?php
require "database/Database.php";
require "user/User.php";

session_start();

// Get a connection to the database
if (!isset($_SESSION['database']))
{
	$_SESSION['database'] = new Database();
}

$user = $_SESSION['database']->createUser($_POST['userId'], $_POST['username']);

$_SESSION['user'] = new User($user['userId'], $user['userName'], $_POST['accessToken']);

// TODO Redirect to profile.php
header("Location: profile.php");
die(); // End running this php after the redirect
?>
