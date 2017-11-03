<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 01.11.17
 * Time: 12:41
 */

class Territory
{
	/**
	 * Get All Unique States
	 *
	 * @return string
	 */
	public static function getAllStates (): string
	{
		$result = [];
		$db = DB::getConnection();
		$query = "SELECT DISTINCT TRIM(SUBSTRING_INDEX(`ter_address`, ',', -1)) FROM `t_koatuu_tree` WHERE (`ter_address` LIKE '%область%' OR `ter_address` LIKE 'Автономна Республіка Крим')";
		
		foreach ($db->query($query) as $row) {
			$result[] = $row[0];
		}
		
		return json_encode($result);
	}
	
	/**
	 * Get Unique Cities By Selected State
	 *
	 * @return string
	 */
	public static function getCities (): string
	{
		$result = [];
		
		if (isset($_POST['state'])) {
			
			$state = $_POST['state'];
			$db = DB::getConnection();
			$sql = "SELECT DISTINCT TRIM(SUBSTRING_INDEX(SUBSTRING_INDEX(`ter_address`, ',', 1), ',', 2)) as city FROM `t_koatuu_tree` WHERE (`ter_address` LIKE '%{$state}%' AND `ter_address` LIKE '%м.%' AND `ter_address` NOT LIKE '%район%') ORDER BY `city`";
			
			foreach ($db->query($sql) as $row) {
				$result[] = $row[0];
			}
		}
		
		return json_encode($result);
	}
	
	/**
	 * Get Unique Districts By Selected City
	 *
	 * @return string
	 */
	public static function getDistricts (): string
	{
		$result = [];
		
		if (isset($_POST['city'])) {
			
			$city = $_POST['city'];
			$db = DB::getConnection();
			$sql = "SELECT DISTINCT TRIM(SUBSTRING_INDEX(`ter_address`, ',', 1)) FROM `t_koatuu_tree` WHERE (`ter_address` LIKE '%{$city}%' AND SUBSTRING_INDEX(`ter_address`, ',', 1) LIKE '%район%')";
			
			foreach ($db->query($sql) as $row) {
				$result[] = $row[0];
			}
		}
		
		return json_encode($result);
	}
}