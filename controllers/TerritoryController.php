<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 03.11.17
 * Time: 00:14
 */

class TerritoryController
{
	/**
	 * Display All States
	 * @return string
	 */
	public function listStates (): string
	{
		$states = Territory::getAllStates();
		print_r($states);
		
		return $states;
	}
	
	/**
	 * Display All Cities By Selected State
	 * @return string
	 */
	public function listCities(): string
	{
		$cities = Territory::getCities();
		print_r($cities);
		
		return $cities;
	}
	
	/**
	 * Display All Districts By Selected City
	 * @return string
	 */
	public function listDistricts(): string
	{
		$districts = Territory::getDistricts();
		print_r($districts);
		
		return $districts;
	}
}