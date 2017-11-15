<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 17:47
 */

class User extends Model
{
	protected $tableName = 'users';
	
	/**
	 * Register New User
	 *
	 * @param $name
	 * @param $email
	 * @param $territory
	 *
	 * @return bool
	 */
	public function registerNewUser(string $name, string $email, string $territory): bool
	{
		$this->createTableIfNotExists($this->tableName);
		
		$sql = "INSERT INTO {$this->tableName} (name, email, territory) VALUES (:name, :email, :territory)";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':territory', $territory, PDO::PARAM_STR);
		
		return $stmt->execute();
	}
	
	/**
	 * Check Email Register User
	 *
	 * @param $email
	 *
	 * @return array|bool
	 */
	public function checkUserViaEmail(string $email)
	{
		$sql = "SELECT * FROM {$this->tableName} WHERE email = :email";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		
		if ($stmt->rowCount() > 0) {
			$user = $stmt->fetchAll();
			
			return json_encode($user);
		}
	}
}