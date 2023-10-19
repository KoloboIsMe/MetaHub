<?php

use Router\Router;

require 'vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'gui' . DIRECTORY_SEPARATOR);
define('SCRIPTS', index . phpdirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);
$router->get('/', 'App\Controllers\BlogController@welcome');

$router->get('/posts', 'App\Controllers\BlogController@posts');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');
$router->get('/logout', 'App\Controllers\ConnexionController@logout');
$router->get('/login', 'App\Controllers\ConnexionController@login');
$router->get('/register', 'App\Controllers\ConnexionController@register');






$router->run();