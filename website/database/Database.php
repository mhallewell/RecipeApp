<?php
require_once("recipe/Recipe.php");
require_once("recipe/Ingredient.php");
require_once("user/User.php");

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
		var_dump($userId);
		
		$query = "SELECT * FROM `Users` WHERE `UserId` = ";
		$query .= $db->escape_string($userId);
			
		$result = $db->query($query);
				
		echo $query;
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
		echo $query;
		
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

		$result->free();
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

		$result->free();

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
		if (get_class($_SESSION['User']) == "Administrator") 
		{
			$db = $this->connect();
		
			$query = "DELETE FROM `Users` ";
			$query .= " WHERE userId = " . $db->escape_string($userId);
		
			$result = $db->query($query);

			$result->free();
		
			return $db->affected_rows;
		}
		else
		{
			return 0;
		}
	}

	/*
	Purpose: To allow searching for recipes
	*/
	public function searchRecipes($search)
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Recipes` WHERE ";
		$query .= "LOCATE('";
		$query .= $db->escape_string($search);
		$query .= "', recipename) != 0";
		echo $query;
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$index] = new Recipe();
				$recipes[$index]->setId($row['recipeId']);
				$recipes[$index]->setName($row['recipename']);
				$recipes[$index]->setDescription($row['description']);
				$recipes[$index]->setInstructions($row['instructions']);
				$this->getIngredients($recipes[$index]);
				$index += 1;
			}
			$result->free();
		}

		return $recipes;
	}

	/*
	Purpose: To allow the selection of a recipe
	*/
	public function selectRecipe($recipeId)
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Recipes` WHERE ";
		$query .= "recipeId = ";
		$query .= $db->escape_string($recipeId);
		$query .= " LIMIT 1";
		
		$result = $db->query($query);

		$row = $result->fetch_assoc();
		$result->free();
		
		// Fill in the recipe with its information
		$recipe = new Recipe();

		$recipe->setId($row['recipeId']);
		$recipe->setName($row['recipename']);
		$recipe->setDescription($row['description']);
		$recipe->setInstructions($row['instructions']);
		
		$this->getIngredients($recipe);

		return $recipe;
	}

	/*
	Purpose: To get the ingredients for a recipe
	Note: Modifies the recipe passed in to get the ingredients
	*/
	public function getIngredients($recipe)
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Ingredients` WHERE ";
		$query .= "recipeId = ";
		$query .= $db->escape_string($recipe->getId());
		
		$result = $db->query($query);
		
		if ($result != null)
		{

			while ($row = $result->fetch_assoc())
			{
				$ingredient = new Ingredient();
				$ingredient->setId($row['ingredientId']);
				$ingredient->setName($row['name']);
				$ingredient->setQuantity($row['quantity']);
				$recipe->addIngredient($ingredient);
			}
			$result->free();
		}
	}


	/*
	Purpose: To allow the creation of a recipe
	Parameters: $userId The user's id
			$recipe The recipe to create
	Returns: The recipeId that was inserted, or -1 if it was not inserted
	*/
	public function createRecipe($userId, $recipe)
	{
		if (get_class($recipe) == "Recipe")
		{
			$db = $this->connect();
			
			$query = "INSERT INTO `Recipes` ";
			$query .= " (recipename, description, instructions, userId) VALUES ('";
			$query .= $db->escape_string($recipe->getName());
			$query .= "',";
			$query .= "'" . $db->escape_string($recipe->getDescription()) . "'";
			$query .= ",";
			$query .= "'" . $db->escape_string($recipe->getInstructions()) . "'";
			$query .= ",";
			$query .= "'" . $db->escape_string($userId) . "'";
			$query .= ");";

			$result = $db->query($query);
			
			$recipe->setId($db->insert_id);

			$this->insertIngredients($result, $recipe);
			$result->free;
	
			return $db->insert_id;
		}
		else
			// We can't insert a non recipe
			return -1;
	}
		

	/*
	Purpose: To insert all the ingredients of a recipe into the database
	Parameters: $recipeId The id of the recipe to attach the ingredient to
			$recipe The recipe to insert into the database
	*/
	public function insertIngredients($recipeId, $recipe)
	{
		if (get_class($recipe) == "Recipe")
		{
			$db = $this->connect();
			foreach ($recipe->getIngredients() as $ingredient)
			{

				$query = "INSERT INTO `Ingredients` (name, quantity, recipeId) VALUES ";
				$query .= "('";
				$query .= $db->escape_string($ingredient->getName());
				$query .= "','";
				$query .= $db->escape_string($ingredient->getQuantity());
				$query .= "',";
				$query .= $db->escape_string($recipeId);
				$query .= ")";
				$query .= ";";
	
				$result = $db->query($query);
				
				$ingredient->setId($db->insert_id);
			}
		}
	}

	public function updateRecipe($recipe)
	{
		$db = $this->connect();
		
		$query = "UPDATE `Recipes` ";
		$query .= "SET recipename=";
		$query .= "'" . $db->escape_string($recipe->getName()) . "',";
		$query .= "description=";
		$query .= "'" . $db->escape_string($recipe->getDescription()) . "',";
		$query .= "instructions=";
		$query .= "'" . $db->escape_string($recipe->getInstructions()) . "'";
		$query .= "\nWHERE recipeId = " . $db->escape_string($recipe->getId());

		$result = $db->query($query);
		$result->free();

		return $this->selectRecipe($recipe->getId());
	}
	

	public function copyRecipe($userId, $recipe)
	{
		return $this->createRecipe($userId, $recipe);
	}
			
}
?>
