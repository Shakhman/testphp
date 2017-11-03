<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 14:54
 */

class HomeController
{
	/**
	 * Main Action For Homepage
	 *
	 * @return mixed
	 */
	public function index ()
	{
		return require_once(ROOT . '/views/home.view.php');
	}
}