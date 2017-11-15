<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 01.11.17
 * Time: 12:41
 */

class Territory extends Model
{
	protected $tableName = 't_koatuu_tree';
	
	/**
	 * Get All States
	 *
	 * @return string
	 */
	public function getAllStates(): string
	{
		$sql = "SELECT `ter_name`, `reg_id`, `ter_id` FROM {$this->tableName} WHERE `ter_type_id` = 0 ORDER BY `ter_name`";
		$states = $this->query($sql);
		
		return $states;
	}
	
	/**
	 * Get Cities By Selected State
	 *
	 * @return string
	 */
	public function getCities(): string
	{
		if (isset($_POST['regId'])) {
			$regId = $_POST['regId'];
			
			$sql = "SELECT `ter_name`, `ter_id` FROM {$this->tableName} WHERE `reg_id` = {$regId} AND (`ter_type_id` = 1 OR `ter_type_id` = 6 OR `ter_type_id` = 5 OR `ter_type_id` = 4) ORDER BY `ter_name`";
			$cities = $this->query($sql);
			
			return $cities;
		}
	}
	
	/**
	 * Get Districts By Selected City
	 *
	 * @return string
	 */
	public function getDistricts(): string
	{
		if (isset($_POST['ter_id'])) {
			$terId = $_POST['ter_id'];
			
			$sql = "SELECT `ter_name` FROM {$this->tableName} WHERE `ter_pid` = {$terId} AND (`ter_type_id` = 2 OR `ter_type_id` = 3) ORDER BY `ter_name`";
			$districts = $this->query($sql);
			
			return $districts;
		}
	}
}