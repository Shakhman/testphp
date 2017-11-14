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
	public static function getAllStates(): string
	{
		$result = [];
		$db = DB::getConnection();
		$query = "SELECT `ter_name`, `reg_id`, `ter_id` FROM `t_koatuu_tree` WHERE `ter_type_id` = 0 ORDER BY `ter_name`";
		
		foreach ($db->query($query) as $row) {
			$result[] = $row;
		}
		
		return json_encode($result);
	}
	
	/**
	 * Get Unique Cities By Selected State
	 *
	 * @return string
	 */
	public static function getCities(): string
	{
		$result = [];
		
		if (isset($_POST['regId'])) {
			
			$regId = $_POST['regId'];
			$db = DB::getConnection();
			$sql = "SELECT `ter_name`, `ter_id` FROM `t_koatuu_tree` WHERE `reg_id` = {$regId} AND (`ter_type_id` = 1 OR `ter_type_id` = 6 OR `ter_type_id` = 5 OR `ter_type_id` = 4) ORDER BY `ter_name`";
			
			foreach ($db->query($sql) as $row) {
				$result[] = $row;
			}
		}
		
		return json_encode($result);
	}
	
	/**
	 * Get Unique Districts By Selected City
	 *
	 * @return string
	 */
	public static function getDistricts(): string
	{
		$result = [];
		
		if (isset($_POST['ter_id'])) {
			
			$terId = $_POST['ter_id'];
			$db = DB::getConnection();
			$sql = "SELECT `ter_name` FROM `t_koatuu_tree` WHERE `ter_pid` = {$terId} AND (`ter_type_id` = 2 OR `ter_type_id` = 3) ORDER BY `ter_name`";
			
			foreach ($db->query($sql) as $row) {
				$result[] = $row[0];
			}
		}
		
		return json_encode($result);
	}
}