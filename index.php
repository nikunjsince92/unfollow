<?php
// Start the session
session_start();

require ('twitteroauth-master/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', '3Hwjs6CIudrLrUAfdnbgXBS0x');
define('CONSUMER_SECRET', 'jpZql28diOVBamlKUq0CrhVaAPU3izkjxvKudnWGnwx7mPs7Ar');
define('OAUTH_CALLBACK', 'http://nikunj.freakengineers.com/unfollow/main.php');

// Starting Authorization
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
?>
<html>
<head>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link href='http://fonts.googleapis.com/css?family=Muli:400,400italic' rel='stylesheet' type='text/css'>
	<link rel='stylesheet' type='text/css' href='css/style.css'>
</head>
<body>
	
	<a href="<?php echo $url; ?>"> <button class="mybutton">Sign in with Twitter</button></a>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
</body>
</html>