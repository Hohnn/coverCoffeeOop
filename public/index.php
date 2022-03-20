<?php

require '../vendor/autoload.php';

use Router\Router;

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/product', 'App\Controllers\ProductController@index');
$router->get('/product/:id', 'App\Controllers\ProductController@show');
$router->get('/product/:id/orders', 'App\Controllers\ProductController@showOrders');
$router->get('/product/:id/cover', 'App\Controllers\ProductController@showCover');

$router->run();
