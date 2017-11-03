<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 17:47
 */

class User
{
	/**
	 * Create Users Table
	 */
	public static function createTableIfNotExists ()
	{
		try {
			$db = DB::getConnection();
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "CREATE TABLE IF NOT EXISTS `users` (
        	`id` BIGINT NOT NULL AUTO_INCREMENT,
        	`name` CHAR(100) NOT NULL,
        	`email` CHAR(100) NOT NULL,
        	`territory` CHAR(200) NOT NULL,
        	PRIMARY KEY(`id`)
    		)";
			$db->exec($sql);
		} catch (PDOException $e) {
			echo $e->getMessage();
			die;
		}
	}
	
	/**
	 * Register New User
	 *
	 * @param $name
	 * @param $email
	 * @param $territory
	 *
	 * @return bool
	 */
	public static function registerUser ($name, $email, $territory): bool
	{
		$db = Db::getConnection();
		
		$sql = "INSERT INTO `users` (name, email, territory) VALUES (:name, :email, :territory)";
		$stmt = $db->prepare($sql);
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
	public static function checkUserViaEmail ($email)
	{
		$db = Db::getConnection();
		
		$stmt = $db->prepare("SELECT * FROM `users` WHERE email = :email");
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			$user = $stmt->fetchAll();
			
			return json_encode($user);
		}
	}
}