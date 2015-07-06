<?php
session_start();
header('Content-Type: application/json');
require ('twitteroauth-master/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;
$response = array();
if(!isset($_GET["id"]))
{
	$response["status"] = false;
	echo json_encode($response, true);
	die();
}
$id = $_GET["id"];

define('CONSUMER_KEY', '3Hwjs6CIudrLrUAfdnbgXBS0x');
define('CONSUMER_SECRET', 'jpZql28diOVBamlKUq0CrhVaAPU3izkjxvKudnWGnwx7mPs7Ar');
define('OAUTH_CALLBACK', 'http://localhost/unfollow/main.php');
$request_token = array();
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    echo ("Error : Something is wrong (Try again) or you are an intruder. ");
}
$access_token = $_SESSION['access_token'];
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$details = $connection->post("friendships/destroy", array("user_id" => $id));
if($details->id==$id)
{
	$response["status"] = true;
	$responsep["_id"] = $id;
}
else
	$response["status"] = false;
echo json_encode($response, true);
?>