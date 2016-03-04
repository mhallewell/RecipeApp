<?php
class Database
{
	private $host = "localhost";
	private $database = "MenuCalendarApp";
	private $user = "MenuApp";
	private $password = "6SCVQpDmPc3p8rhf";
	static private $db;

	/*
	Handles closing the database
	*/
	function __destruct()
	{
		if (isset($db))
			$this->db->close();
	}
	
	/*
	Purpose: To handle connections to the database
	*/
	private function connect()
	{
		if(!isset($db))
		{
			$this->db = new mysqli($this->host, $this->user, $this->password, $this->database);
		}
		if ($this->db->connect_error)
		{
			// If we fail to connect then end the server
			die("Failed to connect to database: ". $db->connect_errno . "<br />");
		}
		return $this->db;
	}

	/*
	Purpose: To log a user in. Creates a new user if one does not exist
	Returns: An array containing the users information
	*/
	public function login($userId)
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Users` WHERE `UserId` = ";
		$query .= $db->escape_string($userId);
			
		$result = $db->query($query);
			
		if (!$result)
		{
			echo ('There was an error accessing the database <br />');
		}
		
		// Lets us know if there was more than one retrieved result
		if ($result->num_rows > 1)
			die ('There was more than one result');
		else if ($result->num_rows == 0)
		{	
			// Error reporting for testing
			//echo ("There was no user with that id <br />");
		}
		
		// Get the row we want
		$row = $result->fetch_assoc();
		$result->free();
		return $row;		
	}

	/*
	Purpose: Creates a user in the database
	Returns: An array with the users data
	Parameters: $userId The user's id, gotten from facebook
			$name The user's username, gotten from facebook
	*/
	public function createUser($userId, $name)
	{
		$db = $this->connect();
		
		$query = "INSERT INTO `Users` (userId, username) VALUES(";
		$query .= $db->escape_string($userId);
		$query .= ",";
		$query .= "'" . $db->escape_string($name) . "'";
		$query .= ");";
		//echo $query;
		
		$result = $db->query($query);
		
		// Testing code
		/*
		if ($result)
		{
			echo ('Inserted user into database <br />');
		}
		else
			echo ("User already exists <br />");
		*/

		return $this->login($userId);		
	}

	/*
	Purpose: To allow the updating of a user in the database
	Parameters: $userId The user's id
			$name The user's name
	*/
	public function updateUser($userId, $name)
	{
		$db = $this->connect();
		
		$query = "UPDATE `Users` ";
		$query .= "SET username=";
		$query .= "'" . $db->escape_string($name) . "'";
		$query .= "\nWHERE userId = " . $db->escape_string($userId);

		$result = $db->query($query);

		return $this->login($userId);
	}

	/*
	Purpose: To allow the deletion of a user in the database
	Parameters: $userId The user's id
	Returns: The number of affected rows
	*/
	public function deleteUser($userId)
	{
		// TODO setup admin check
		
		$db = $this->connect();
		
		$query = "DELETE FROM `Users` ";
		$query .= " WHERE userId = " . $db->escape_string($userId);
		
		$result = $db->query($query);
		
		return $db->affected_rows;
	}

}
?>
