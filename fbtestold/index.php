<?php
echo '<pre>' . var_export($_COOKIE, TRUE) . '</pre>';

error_reporting(E_ALL);
ini_set('display_errors', '1');
require dirname(__FILE__) . '/facebook.php';
$parentApiKey = 'a39dec000ada2e6aebbb6777f3403442';
$parentSecret = 'e8e51067c93e5bf501d5d915882dbb96';
$childApiKey = '62e0b418da1820adf1438b2796e618fd';
$childSecret = 'ccfe4c61a6c4bf97df21026849671030';
$grandchildAppId = 331402313967;
$grandchildApiKey = 'e2ebfb383af11801896d70989991bfae';
$sessionKey = $_COOKIE[$childApiKey . '_session_key'];
$sessionSecret = $_COOKIE[$childApiKey . '_ss'];
/*
$facebook = new Facebook($parentApiKey, $parentSecret);
$facebook->api_client->begin_permissions_mode($childApiKey);
$facebook->api_client->auth_getSession('Test2');
// $facebook->api_client->stream_publish('Test2');
$facebook->api_client->end_permissions_mode();
echo 'Done 2';
*/
/*
$facebook = new Facebook($childApiKey, $sessionSecret);
//$facebook->api_client->session_key = $sessionKey;
$facebook->api_client->stream_publish('Test using session secret');
echo 'Done test using session secret';
*/
/*
$facebook = new Facebook($childApiKey, $sessionSecret);
$facebook->api_client->session_key=$sessionKey;
$facebook->api_client->use_session_secret($sessionSecret);
$facebook->api_client->begin_permissions_mode($childApiKey);
$facebook->api_client->stream_publish('Hello 2');
$facebook->api_client->end_permissions_mode();
*/
/*
$facebook = new Facebook($parentApiKey, $parentSecret);
$facebook->api_client->session_key=$sessionKey;
$facebook->api_client->use_session_secret($sessionSecret);
$facebook->api_client->begin_permissions_mode($childApiKey);
$facebook->api_client->stream_publish('Hello 3');
$facebook->api_client->end_permissions_mode();
*/
/*
$facebook = new Facebook($childApiKey, $sessionSecret);
$facebook->api_client->session_key = $sessionKey;
$facebook->api_client->use_session_secret($sessionSecret);
$facebook->api_client->stream_publish('Hello 8!');
*/
$facebook = new Facebook($childApiKey, $childSecret);
$facebook->api_client->stream_publish('Hello 10!');
