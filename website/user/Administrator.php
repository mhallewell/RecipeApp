<?php
require "user/User.php"
require "database/Database.php"

class Administrator extends User
{
	public function deleteUser($userId)
	{
		$result = $_SESSION['Database']->deleteUser($userId);
		if ($result > 0)
			echo "Deleted ".$result." users from the database.";
		else
			echo "No user was found.";
	}

	



}
