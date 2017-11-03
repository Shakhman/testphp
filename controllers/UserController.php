<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 17:47
 */

class UserController
{
	public $name = null;
	public $email = null;
	public $territory = null;
	
	/**
	 * Register User
	 * @return mixed|void
	 */
	public function register ()
	{
		if (!empty($_POST)) {
			$name = htmlspecialchars_decode(mb_convert_case(trim($_POST['name'], ' '), MB_CASE_TITLE, "UTF-8"));
			$email = htmlspecialchars(trim(strtolower($_POST['email'])));
			$state = htmlspecialchars($_POST['state']);
			$city = htmlspecialchars($_POST['city']);
			$district = htmlspecialchars($_POST['district']);
			
			$this->name = $name;
			$this->email = $email;
			!empty($_POST['district']) ? $this->territory = $state . ', ' . $city . ', ' . $district : $this->territory = $state . ', ' . $city;
			
			User::createTableIfNotExists();
			
			// Checking User Email
			if (!User::checkUserViaEmail($this->email)) {
				$user = User::registerUser($this->name, $this->email, $this->territory);
				print_r($user);
			} else {
				$user = User::checkUserViaEmail($this->email);
				print_r($user);
			}
		}
	}
}