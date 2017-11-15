<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 15.11.2017
 * Time: 12:27
 */

abstract class Model extends DB
{
	protected $tableName;
	
	/**
	 * Create Table If Not Exists
	 *
	 * @param string $tableName
	 *
	 * @return bool
	 */
	public function createTableIfNotExists(string $tableName): bool
	{
		try {
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
        	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        	`name` VARCHAR(50) NOT NULL,
        	`email` VARCHAR(50) NOT NULL,
        	`territory` VARCHAR(128) NOT NULL
        	) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci";
			$this->pdo->exec($sql);
		} catch (PDOException $e) {
			echo $e->getMessage();
			die;
		}
		
		return true;
	}
	
	/**
	 * Make Simple Query To DB
	 *
	 * @param string $query
	 *
	 * @return string
	 */
	protected function query(string $query)
	{
		$result = [];
		
		foreach ($this->pdo->query($query) as $row) {
			$result[] = $row;
		}
		
		return json_encode($result);
	}
}