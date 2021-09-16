<?php

// autoload
require_once dirname(__DIR__) . '/../vendor/autoload.php';

use App\Controller\BlogController;
use App\Router;

//Debug mode
$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// var_dump(dirname(__DIR__));
// die;

$controller = new BlogController();

//Router
$router = new Router($_GET['url']);


$router->get('/', 'App\Controller\BlogController@index');
$router->get('/posts/:id', 'App\Controller\BlogController@show');


//verify matching routes
$router->run();
