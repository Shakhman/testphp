<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 01.11.17
 * Time: 12:23
 */

class Db
{
	public static function getConnection ()
	{
		$paramsPath = ROOT . '/config/db.php';
		$params = require($paramsPath);
		
		try {
			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
			$db = new PDO($dsn, $params['user'], $params['password']);
			$db->exec("set names {$params['charset']}");
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
		
		return $db;
	}
}