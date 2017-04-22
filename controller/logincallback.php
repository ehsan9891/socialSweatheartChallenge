<?php
global $db;
var_dump($db);

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
