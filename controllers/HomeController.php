<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 14:54
 */

class HomeController extends Controller
{
	/**
	 * Main Action For Homepage
	 *
	 * @return mixed
	 */
	public function index()
	{
		return $this->view('home');
	}
}