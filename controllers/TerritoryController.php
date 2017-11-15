<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 03.11.17
 * Time: 00:14
 */

class TerritoryController extends Controller
{
	protected $modelName = 'Territory';
	
	/**
	 * Display All States
	 *
	 * @return boolean
	 */
	public function listStates(): bool
	{
		$territoryModel = $this->model($this->modelName);
		$states = $territoryModel->getAllStates();
		print_r($states);
		
		return true;
	}
	
	/**
	 * Display All Cities By Selected State
	 *
	 * @return boolean
	 */
	public function listCities(): bool
	{
		$territoryModel = $this->model($this->modelName);
		$cities = $territoryModel->getCities();
		print_r($cities);
		
		return true;
	}
	
	/**
	 * Display All Districts By Selected City
	 *
	 * @return boolean
	 */
	public function listDistricts(): bool
	{
		$territoryModel = $this->model($this->modelName);
		$districts = $territoryModel->getDistricts();
		print_r($districts);
		
		return true;
	}
}