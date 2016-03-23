<?php

class Recipe
{
	private $recipeId;
	private $name;
	private $description;
	private $instructions;
	private $ingredients;

	public function __constructor()
	{
		
	}

	public function getId()
	{
		return $this->recipeId;
	}	

	// Used by database to insert the new id into the recipe
	public function setId($id)
	{
		$this->recipeId = $id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setDescription($description)
	{
		$this->description = $description;
	}

	public function getDescription()
	{
		return $this->description;
	}
	
	public function setInstructions($instructions)
	{
		return $this->instructions = $instructions;
	}

	public function getInstructions()
	{
		return $this->instructions;
	}

	public function getIngredients()
	{
		return $this->ingredients;
	}

	public function addIngredient($ingredient)
	{
		if (get_class($ingredient) == "Ingredient")
		{
			$this->ingredients[] = $ingredient;
		}
	}

	/*public function removeIngredient($ingredientId)
	{
		foreach ($this->ingredients as $key=>$ingredient)
		{
			if ($ingredient->getId() == $ingredientId)
			{
				$_SESSION['database']->removeIngredient($ingredientId);
				unset($this->ingredients[$key]);
				break;
			}
		}
	}*/

	// This function is used by the database class to fill the recipe with 
	// its ingredients
	public function fillIngredients($ingredients)
	{
		$this->ingredients = $ingredients;
	}
}
