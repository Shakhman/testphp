<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 17:47
 */

class UserController extends Controller
{
	public $name;
	public $email;
	public $territory;
	protected $modelName = 'User';
	
	/**
	 * Register New User
	 *
	 * @return mixed|void
	 */
	public function register()
	{
		if (!empty($_POST)) {
			$name = htmlspecialchars_decode(mb_convert_case(trim($_POST['name'], ' '), MB_CASE_TITLE, "UTF-8"));
			$email = htmlspecialchars(trim(strtolower($_POST['email'])));
			$state = htmlspecialchars($_POST['state']);
			$city = htmlspecialchars($_POST['city']);
			$district = htmlspecialchars($_POST['district']);
			
			$this->name = $name;
			$this->email = $email;
			
			if (empty($_POST['district'])) {
				$this->territory = $city . ', ' . $state;
			} elseif (empty($_POST['city'])) {
				$this->territory = $district . ', ' . $state;
			} else {
				$this->territory = $district . ', ' . $city . ', ' . $state;
			}
			
			$this->checkUser();
		}
	}
	
	/**
	 * Checking New User
	 *
	 * @return mixed
	 */
	public function checkUser()
	{
		$model = $this->model($this->modelName);
		$checkingUser = $model->checkUserViaEmail($this->email);
		
		if (!$checkingUser) {
			$user = $model->registerNewUser($this->name, $this->email, $this->territory);
			print_r($user);
			
			return $user;
		} else {
			print_r($checkingUser);
			
			return $checkingUser;
		}
	}
}