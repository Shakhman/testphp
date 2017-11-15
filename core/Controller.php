<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 15.11.2017
 * Time: 11:18
 */

abstract class Controller
{
	protected $modelName;
	
	/**
	 * Get Model By Name
	 *
	 * @param string $model
	 *
	 * @return mixed
	 */
	protected function model(string $model)
	{
		return new $model();
	}
	
	/**
	 * Get View By Name
	 *
	 * @param string $view
	 * @param array  $data
	 *
	 * @return mixed
	 */
	protected function view(string $view, array $data = [])
	{
		return require_once ROOT . '/views/' . $view . '.php';
	}
}