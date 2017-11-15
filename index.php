<?php

define('ROOT', dirname(__FILE__));

require_once(ROOT . '/autoloader.php');

// Call Router
$router = new Router();
$router->run();