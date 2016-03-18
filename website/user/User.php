<?php

class User
{
	private $userId;
	private $username;
	private $accessToken;
	
	public __constructor($id, $name, $access)
	{
		$userId = $id;
		$username = $name;
		$accessToken = $access;
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
