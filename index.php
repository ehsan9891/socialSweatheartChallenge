<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require __DIR__ . '/vendor/autoload.php';

use Szenis\Router;
use Szenis\RouteResolver;

$router = new Router();

$AppID = "801110283369302";
$AppSecret = "38764657637be723cdb1bb4d663087d2";

$fb = new \Facebook\Facebook([
    'app_id' => $AppID,
    'app_secret' => $AppSecret,
    'default_graph_version' => 'v2.9',
    'cookie' => true
        ]);

$router->add('/', 'GET', function() {
    global $AppID, $AppSecret, $fb;


    // Get the FacebookRedirectLoginHelper
    $helper = $fb->getRedirectLoginHelper();

    $permissions = ['email', 'public_profile']; // optional
    $loginUrl = $helper->getLoginUrl('https://razmkhah.ir/success', $permissions);

    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    return;
});

$router->add('/success/', 'GET', function() {

    global $fb;
    $helper = $fb->getRedirectLoginHelper();
    $token = $helper->getAccessToken();
    try {
        // Get the \Facebook\GraphNodes\GraphUser object for the current user.
        // If you provided a 'default_access_token', the '{access-token}' is optional.
        $response = $fb->get('/me',$token);
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }

    $me = $response->getGraphUser();
    echo 'Logged in as ' . $me->getName();
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


