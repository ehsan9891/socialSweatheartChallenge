<?php

// DB 
$db = new MysqliDb(DB_HOST, DB_USER, DB_PASS, DB_NAME);


// Facebook

$AppID = "801110283369302";
$AppSecret = "38764657637be723cdb1bb4d663087d2";

$fb = new \Facebook\Facebook([
    'app_id' => $AppID,
    'app_secret' => $AppSecret,
    'default_graph_version' => 'v2.9',
    'cookie' => true
        ]);
