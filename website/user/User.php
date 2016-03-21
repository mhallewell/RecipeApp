<?php

class User
{
	private $userId;
	private $username;
	private $accessToken;
	

	public function __construct($id, $name, $access)
	{
		$this->userId = $id;
		$this->username = $name;
		$this->accessToken = $access;
	}

	public function getName()
	{
		return $this->username;
	}
	public function getAccessToken()
	{
		return $this->accessToken;
	}
	public function getUserId()
	{
		return $this->userId;
	}
}
?>
