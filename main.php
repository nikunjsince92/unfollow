<?php
// Start the session
session_start();

require ('twitteroauth-master/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', '3Hwjs6CIudrLrUAfdnbgXBS0x');
define('CONSUMER_SECRET', 'jpZql28diOVBamlKUq0CrhVaAPU3izkjxvKudnWGnwx7mPs7Ar');
define('OAUTH_CALLBACK', 'http://nikunj.freakengineers.com/unfollow/main.php');

// Finish authorization
$request_token = array();
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    echo ("Error : Something is wrong (Try again) or you are an intruder. ");
	}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
$_SESSION['access_token'] = $access_token;
header('location:show.php');
?>