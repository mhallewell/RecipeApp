<?php

class User
{
	private $userId;
	private $username;
	private $picture;
	

	public function __construct($id, $name, $picture)
	{
		$this->userId = $id;
		$this->username = $name;
		$this->picture = $picture;
	}

	public function getName()
	{
		return $this->username;
	}
	public function getUserId()
	{
		return $this->userId;
	}
	public function getPicture()
	{
		return $this->picture;
	}
}
?>
