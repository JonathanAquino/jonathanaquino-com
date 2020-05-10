<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require dirname(__FILE__) . '/facebook.php';
$childApiKey = '7808e2430cb0ea5bb723816e51ebfdf3';
$parentApiKey = '45a47ce1d9c7cb7a06923cbfad401991';
$parentSecret = '687aa46f3d714e9ebb7d97de7b7771d8';
$facebook = new Facebook($parentApiKey, $parentSecret);
$facebook->api_client->begin_permissions_mode($childApiKey);
$facebook->api_client->admin_setAppProperties(array('tos_url' => 'http://jonathanaquino.com/fbtest/index.html'));
$facebook->api_client->end_permissions_mode();
echo 'Done';
