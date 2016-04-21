<?php

class CalDate
{
	private $calDate;
	private $recipes;

	public function __constructor()
	{
		
	}

	public function getDate()
	{
		return $this->calDate;
	}	

	// Used by database to insert the new id into the recipe
	public function setDate($newDate)
	{
		$this->calDate = $newDate;
	}

	public function getRecipes()
	{
		return $this->recipes;
	}

	public function setRecipes($recipes)
	{
		$this->recipes = $recipes;
	}
}
?>
