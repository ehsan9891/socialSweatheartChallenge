<?php
if(!isset($_SESSION['user_id'])){
    header("Location:/");
}
global $db;

$userid = $_SESSION['user_id'];
$db->where("userid",$userid);
$user = $db->getOne("user_data");
$token = $user['longToken'];


$helper = $fb->getRedirectLoginHelper();

$logoutUrl = $helper->getLogoutUrl($token, 'http://razmkhah.ir');

echo "User:". $user['name']."<br />";
echo "<img src='".$user['picurl']. "' /><br />";

echo '<a href="' . $logoutUrl . '">Logout of Facebook!</a><br />';