<?php

header('Content-Type: text/plain;charset=utf-8');
if (!isset($_REQUEST['data'])) {
    echo "Error: Missing required parameter 'data'";
    exit;
}
require('yubnub2phparray.php');
$items = yubnub2phparray($_REQUEST['data']);
echo count($items);

?>