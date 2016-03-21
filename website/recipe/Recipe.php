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

	public function getName()
	{
		return $this->name;
	}

	public function getDescription()
	{
		return $this->description;
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
		}
	}
}
