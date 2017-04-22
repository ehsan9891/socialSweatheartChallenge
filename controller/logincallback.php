<?php

global $db;


$helper = $fb->getRedirectLoginHelper();
$token = $helper->getAccessToken();
$tokenAsString = (string) $token;
$longLivedToken = getLongLiveIDToken($tokenAsString)->access_token;

$picinfo = FB_Request("/me/picture?type=normal",$token);
$nameinfo = FB_Request("/me",$token);


$me = $nameinfo->getGraphUser();
echo $me->getName();
echo $me->getID();
$pic = $picinfo->getHeaders()['Location'];
var_dump($pic);

function getLongLiveIDToken($tokenAsString) {
    global $AppID, $AppSecret, $curl;

    $url = "https://graph.facebook.com/oauth/access_token?"
            . "client_id=$AppID&"
            . "client_secret=$AppSecret&"
            . "grant_type=fb_exchange_token&"
            . "fb_exchange_token=$tokenAsString";

    $curl->get($url);

    if ($curl->error) {
        echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
    } else {
        return $curl->response;
    }
}

function FB_Request($type,$token) {
    global $fb;
    try {
        // Get the \Facebook\GraphNodes\GraphUser object for the current user.
        // If you provided a 'default_access_token', the '{access-token}' is optional.
        $response = $fb->get($type, $token);
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    return $response;
}
