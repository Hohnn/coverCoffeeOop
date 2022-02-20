<?php

require '../vendor/autoload.php';

use Router\Router;

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\ProductController@welcome');
$router->get('/product', 'App\Controllers\ProductController@index');
$router->get('/product/:id', 'App\Controllers\ProductController@show');

$router->run();
