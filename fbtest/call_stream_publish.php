<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require dirname(__FILE__) . '/facebook.php';
$childApiKey = 'afee832156dc94221e84ac6fef59fc75';
$sessionKey = $_COOKIE[$childApiKey . '_session_key'];
$sessionSecret = $_COOKIE[$childApiKey . '_ss'];
$facebook = new Facebook($childApiKey, $sessionSecret);
$facebook->api_client->session_key = $sessionKey;
$facebook->api_client->use_session_secret($sessionSecret);
$facebook->api_client->stream_publish('Test from PHP A');
echo 'Done';
