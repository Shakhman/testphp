<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 01.11.17
 * Time: 12:23
 */

class Db
{
	protected $pdo;
	
	/**
	 * Db constructor.
	 */
	public function __construct()
	{
		$paramsPath = ROOT . '/config/db.php';
		if (!is_file($paramsPath)) $paramsPath = ROOT . '/config/db.example.php';
		$params = require($paramsPath);
		
		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset={$params['charset']}";
		
		try {
			$this->pdo = new PDO($dsn, $params['user'], $params['password']);
		} catch (PDOException $e) {
			die('Подключение не удалось: ' . $e->getMessage());
		}
	}
}