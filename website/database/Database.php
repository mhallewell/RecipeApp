<?php
require_once("recipe/Recipe.php");
require_once("recipe/Ingredient.php");
require_once("user/User.php");
require_once("recipe/Date.php");

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
		// Create a calendar if the user was successfully created
		if ($result)
		{
			$this->createCalendar($userId);
		}

		if ($result != null)
		{
			$result->free();
		}

		return $this->login($userId);		
	}

	/*
	Purpose: To create a calendar for the user
	Parameters: The userId to create the calendar for
	*/
	public function createCalendar($userId)
	{
		$db = $this->connect();
		
		$query = "CREATE TABLE IF NOT EXISTS `";
		$query .= $db->escape_string($userId);
		$query .= "Calendar` (";
		$query .= "`itemId` int(11) NOT NULL AUTO_INCREMENT,";
  		$query .= "`recipeId` int(11) NOT NULL,";
  		$query .= "`date` date NOT NULL,";
  		$query .= "PRIMARY KEY (`itemId`)";
		$query .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

		$result = $db->query($query);
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
	Purpose: To allow for getting the total number of recipes a user has
	*/
	public function getNumberOfRecipes($userId)
	{
		$db = $this->connect();
	
		$query = "SELECT COUNT(*) AS `Count` FROM Recipes WHERE";
		$query .= " userId=";
		$query .= $db->escape_string($userId);
		$query .= ";";

		$result = $db->query($query);
		$count = $result->fetch_assoc()['Count'];
		$result->free;
		
		return $count;
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
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$index] = new Recipe();
				$recipes[$index]->setId($row['recipeId']);
				$recipes[$index]->setUserId($row['userId']);
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
	Purpose: To allow listing all recipes owned by a user
	*/
	public function getRecipesByUserId($userId)
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Recipes` WHERE ";
		$query .= "userId = ";
		$query .= $db->escape_string($userId);
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$index] = new Recipe();
				$recipes[$index]->setId($row['recipeId']);
				$recipes[$index]->setUserId($row['userId']);
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
	Purpose: To allow listing all recipes
	*/
	public function getAllRecipes()
	{
		$db = $this->connect();
		
		$query = "SELECT * FROM `Recipes`;";
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$index] = new Recipe();
				$recipes[$index]->setId($row['recipeId']);
				$recipes[$index]->setUserId($row['userId']);
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
		$recipe->setUserId($row['userId']);
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

			$this->insertIngredients($recipe);
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
	public function insertIngredients($recipe)
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
				$query .= $db->escape_string($recipe->getId());
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

		$this->updateIngredients($recipe);

		return $this->selectRecipe($recipe->getId());
	}
	
	public function updateIngredients($recipe)
	{
		$db = $this->connect();
		
		$query = "DELETE FROM `Ingredients` ";
		$query .= "\nWHERE recipeId = " . $db->escape_string($recipe->getId());
		$result = $db->query($query);
		$result->free();

		return $this->insertIngredients($recipe);
	}	

	public function copyRecipe($userId, $recipe)
	{
		return $this->createRecipe($userId, $recipe);
	}
		

	/*
	Purpose: To get the recipes associated with a given date
	Parameters: The userId to check
			The date in the format YYYY-MM-DD
	*/
	public function getDate($userId, $date)
	{
		$db = $this->connect();
		
		$calDate = new CalDate();
		$calDate->setDate($date);
		
		$query = "SELECT * FROM ";
		$query .= $db->escape_string($userId);
		$query .= "Calendar ";
		$query .= "LEFT JOIN (Recipes) ON (";
		$query .= $db->escape_string($userId);
		$query .= "Calendar.recipeId=";
		$query .= "Recipes.recipeId)";
		$query .= " WHERE `date` = '";
		$query .= $db->escape_string($date);
		$query .= "';";
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			$recipes = null;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$index] = new Recipe();
				$recipes[$index]->setId($row['recipeId']);
				$recipes[$index]->setUserId($row['userId']);
				$recipes[$index]->setName($row['recipename']);
				$recipes[$index]->setDescription($row['description']);
				$recipes[$index]->setInstructions($row['instructions']);
				$this->getIngredients($recipes[$index]);
				$index += 1;
			}
			$calDate->setRecipes($recipes);
			$result->free();
		}
		return $calDate;
	}

	/*
	Purpose: To get the recipes associated with a given date
	Parameters: The userId to check
			The date in the format YYYY-MM-DD
	*/
	public function addRecipeToDate($userId, $date, $recipeId)
	{
		$db = $this->connect();
		
		$query = "INSERT INTO ";
		$query .= $db->escape_string($userId);
		$query .= "Calendar ";
		$query .= " (recipeId, date) VALUES ('";
		$query .= $db->escape_string($recipeId);
		$query .= "',";
		$query .= "'" . $db->escape_string($date) . "'";
		$query .= ");";
		
		$result = $db->query($query);
	}

	/*
	Purpose: To get the recipes associated with a given date
	Parameters: The userId to check
			The date in the format YYYY-MM-DD
			The recipeId of the recipe to remove
	*/
	public function removeRecipeFromDate($userId, $date, $recipeId)
	{
		$db = $this->connect();
		
		$query = "DELETE FROM ";
		$query .= $db->escape_string($userId);
		$query .= "Calendar ";
		$query .= " WHERE recipeId = '";
		$query .= $db->escape_string($recipeId);
		$query .= "'";
		$query .= " AND date = '" . $db->escape_string($date) . "'";
		$query .= " LIMIT 1;";
		
		$result = $db->query($query);
	}

	/*
	Purpose: To get the recipes associated with a given date
	Parameters: The userId to check
			The date in the format YYYY-MM-DD
			The end date in the format YYYY-MM-DD
	*/
	public function getDateRange($userId, $startDate, $endDate)
	{
		$db = $this->connect();

		// Create an array of all the dates in the date range
		$begin = new DateTime($startDate);
		$end = new DateTime($endDate);
		$end = $end->modify('+1 day');

		$interval = DateInterval::createFromDateString('1 day');
		$period = new DatePeriod($begin, $interval, $end);
		foreach ($period as $date)
		{
			$dates[$date->format("Y-m-d")] = new CalDate();
			$dates[$date->format("Y-m-d")]->setDate($date->format("Y-m-d"));
		}
		
		$query = "SELECT * FROM ";
		$query .= $db->escape_string($userId);
		$query .= "Calendar ";
		$query .= "LEFT JOIN (Recipes) ON (";
		$query .= $db->escape_string($userId);
		$query .= "Calendar.recipeId=";
		$query .= "Recipes.recipeId)";
		$query .= " WHERE `date` between '";
		$query .= $db->escape_string($startDate);
		$query .= "' AND '";
		$query .= $db->escape_string($endDate);
		$query .= "' ORDER BY `date` DESC";
		$query .= ";";
		
		$result = $db->query($query);
		if ($result != null)
		{
			$index = 0;
			while ($row = $result->fetch_assoc())
			{
				$recipes[$row['date']][$index] = new Recipe();
				$recipes[$row['date']][$index]->setId($row['recipeId']);
				$recipes[$row['date']][$index]->setUserId($row['userId']);
				$recipes[$row['date']][$index]->setName($row['recipename']);
				$recipes[$row['date']][$index]->setDescription($row['description']);
				$recipes[$row['date']][$index]->setInstructions($row['instructions']);
				$this->getIngredients($recipes[$row['date']][$index]);
				$index += 1;
			}
			$result->free();
			
			foreach ($period as $date)
			{
				if (isset($recipes[$date->format("Y-m-d")]))
				{
					$dates[$date->format("Y-m-d")]->setRecipes($recipes[$date->format("Y-m-d")]);
				}
			}
		}
		return $dates;
	}

	public function copyTimeFrame($userId, $fromStartDate, $toStartDate, $numDays)
	{
		$curFromDate = new DateTime($fromStartDate);
		$curToDate = new DateTime($toStartDate);
		$interval = date_interval_create_from_date_string("1 day");
		for ($i = 0; $i < $numDays; $i += 1)
		{
			
			$curFromDate->add($interval);
			$fromDate = $this->getDate($userId, $curFromDate->format("Y-m-d"));
			$curToDate->add($interval);
			if ($fromDate != null && $fromDate->getRecipes() != null)
			{
				foreach ($fromDate->getRecipes() as $recipe)
				{
					$this->addRecipeToDate($userId, $curToDate->format("Y-m-d"), $recipe->getId());	
				}
			}
		}
	} 

	public function selectIngredients($recipeIds)
	{
		$db = $this->connect();
		$ingredients = null;
		// TODO Write function that gets the ingredients for a list of recipe ids
		$query = "SELECT * FROM `Ingredients`";
		$query .= " WHERE ";
		foreach ($recipeIds as $id)
		{
			$query .= "RecipeId = ";
			$query .= $db->escape_string($id);
			$query .= " OR ";
		}
		// Added so the query can end with an extra or
		$query .= " RecipeId = -1;";

		$result = $db->query($query);
		
		if ($result != null)
		{
			while ($row = $result->fetch_assoc())
			{
				$ingredient = new Ingredient();
				$ingredient->setId($row['ingredientId']);
				$ingredient->setName($row['name']);
				$ingredient->setQuantity($row['quantity']);
				$ingredients[] = $ingredient;
			}
		}
		return $ingredients;
	}

	public function selectTimeFrame($userId, $startDate, $endDate)
	{
		$db = $this->connect();
		$recipeIds = null;

		$query = "SELECT `recipeId` FROM ";
		$query .= $db->escape_string($userId);
		$query .= "Calendar ";
		$query .= " WHERE `date` between '";
		$query .= $db->escape_string($startDate);
		$query .= "' AND '";
		$query .= $db->escape_string($endDate);
		$query .= "' ORDER BY `date` DESC";
		$query .= ";";
		
		$result = $db->query($query);
		
		if ($result != null)
		{
			while ($row = $result->fetch_assoc())
			{
				$recipeIds[] = $row['recipeId'];
			}
		} 
		
		return $this->selectIngredients($recipeIds);
	}
}
?>
