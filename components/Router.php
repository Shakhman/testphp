<?php

/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 31.10.17
 * Time: 13:39
 */

class Router
{
	private $routesArr = [];
	
	/**
	 * Include All Routes From Config File.
	 */
	public function __construct ()
	{
		$routesPath = ROOT . '/config/routes.php';
		$this->routesArr = include($routesPath);
	}
	
	/**
	 * Get Request URI
	 * @return string
	 */
	private function getURI (): string
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}
	
	public function run ()
	{
		$uri = $this->getURI();
		foreach ($this->routesArr as $uriPattern => $path) {
			if ($uri === $uriPattern) {
				$segments = explode('/', $path);
				$controllerName = ucfirst(array_shift($segments)) . 'Controller';
				$actionName = array_shift($segments);
				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
				if (file_exists($controllerFile)) {
					include_once($controllerFile);
				}
				$controllerObj = new $controllerName;
				$result = call_user_func_array([$controllerObj, $actionName], $segments);
				if ($result !== null) {
					break;
				}
				
				return $result;
			}
		}
	}
	
}