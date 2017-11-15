<?php
/**
 * Created by PhpStorm.
 * User: Shakhman
 * Date: 01.11.17
 *Time: 12:56

 * @param $className
 */
spl_autoload_register(function($className) {
	$array_path = [
		'/models/',
		'/components/',
		'/controllers/',
		'/core/',
	];
	
	foreach ($array_path as $path) {
		$path = ROOT . $path . $className . '.php';
		
		if (is_file($path)) include_once $path;
	}
});