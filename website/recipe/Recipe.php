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

	public function setId($id)
	{
		return $this->recipeId = $id;
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
		}
	}
}
