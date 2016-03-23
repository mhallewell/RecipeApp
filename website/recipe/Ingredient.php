<?php

class Ingredient
{
	private $ingredientId;
	private $name;
	private $quantity;

	public function __construct()
	{
	
	}

	public function getId()
	{
		return $this->ingredientId;
	}

	public function setId($id)
	{
		$this->ingredientId = $id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}
}
?>
