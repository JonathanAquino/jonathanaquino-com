<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require dirname(__FILE__) . '/facebook.php';
$childApiKey = 'afee832156dc94221e84ac6fef59fc75';
$parentApiKey = '0bd33ffb5d1fd4bd406deaff933571e6';
$parentSecret = '1f1780d3803ebb3c2424f2c74a7499ac';
$facebook = new Facebook($parentApiKey, $parentSecret);
$facebook->api_client->begin_permissions_mode($childApiKey);
$facebook->api_client->stream_publish('Test from PHP B');
$facebook->api_client->end_permissions_mode();
echo 'Done';
