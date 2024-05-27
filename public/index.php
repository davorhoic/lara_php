<?php

use Core\Router;
use Core\Session;
use Core\ValidationException;

session_start();

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . 'vendor/autoload.php'; // composer autoload file

require BASE_PATH . "Core/functions.php";  // za ovo ne možemo koristiti base_path funkciju 
// jer se sama nalazi u functions.php


require base_path('bootstrap.php');

$router = new Core\Router();
$routes = require base_path('routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

//$method = $_SERVER['REQUEST_METHOD'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {

    $router->route($uri, $method);

} catch (ValidationException $e) {

    Session::flash('errors', $e->errors);
    Session::flash('old', $e->old);


    return redirect($router->previousUrl());
}

// routeToController($uri, $routes);


Session::unflash();

