<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__.'/vendor/autoload.php';


use Szenis\Router;
use Szenis\RouteResolver;


$router = new Router();

$router->add('/fbapp/', 'GET', function() {
    
    echo "test";
    return; 
});


$resolver = new RouteResolver($router);

try {
    // You have to resolve the route inside the try block
    $resolver->resolve([
        'uri' => $_SERVER['REQUEST_URI'],
        'method' => $_SERVER['REQUEST_METHOD'],
    ]);
} catch (Szenis\Exceptions\RouteNotFoundException $e) {
    // route not found, add a nice 404 page here if you like 
    die($e->getMessage());
} catch (Szenis\Exceptions\InvalidArgumentException $e) {
    // when an arguments of a route is missing an InvalidArgumentException will be thrown 
    // it is not necessary to catch this exception as this exception should never occur in production
    die($e->getMessage());
}