<?php
session_start();
header('Content-Type: application/json');
require ('twitteroauth-master/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

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

$friends_list = $connection->get("friends/list", array("cursor" => -1, "screen_name" => $access_token['screen_name'], "skip_status" => true, "include_user_entities" => false, "count" => 200));

$response = array();
for($i=0; $i<count($friends_list->users); $i++)
{
	$response[$i]["_id"] = $friends_list->users[$i]->id ;
	$response[$i]["screen_name"] = $friends_list->users[$i]->screen_name ;
	$response[$i]["full_name"] = $friends_list->users[$i]->name ;
	$response[$i]["profile_pic"] = str_replace("normal", "400x400", $friends_list->users[$i]->profile_image_url) ;
	
}

echo json_encode($response, true);
?>