<?php

require '../vendor/autoload.php';

session_start();



use Router\Router;

define('BASEURL', 'http://covercoffeeoop/');
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPT', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);
if (isset($_SESSION['user'])) {
    $router->get('/', 'App\Controllers\HomeController@index');
} else {
    $router->get('/', 'App\Controllers\HomeController@indexNoLogin');
}
$router->get('/products', 'App\Controllers\ProductController@index');
$router->get('/product/:id', 'App\Controllers\ProductController@show');
$router->get('/product/:id/orders', 'App\Controllers\ProductController@showOrders');
$router->get('/product/:id/cover', 'App\Controllers\ProductController@showCover');
$router->get('/login', 'App\Controllers\AuthController@login');
$router->get('/order/cart', 'App\Controllers\OrderController@viewCart');

$router->get('/fetch/contract/:id', 'App\Controllers\ContractController@fetchContractById');

$router->post('/logout', 'App\Controllers\AuthController@logout');
$router->post('/login', 'App\Controllers\AuthController@loginAuth');
$router->post('/product/:id', 'App\Controllers\ContractController@postContract');
$router->post('/order/delete/:id', 'App\Controllers\OrderController@deleteOrder');
/* $router->post('/product/:id/addToCart', 'App\Controllers\CartController@addToCart'); */

$router->run();

