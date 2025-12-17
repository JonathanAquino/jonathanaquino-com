<?php

header('Content-Type: text/plain;charset=utf-8');
if (!isset($_REQUEST['data']) || !isset($_REQUEST['idx'])) {
    echo "Error: Missing required parameters 'data' and 'idx'";
    exit;
}
require('yubnub2phparray.php');
$items = yubnub2phparray($_REQUEST['data']);
echo isset($items[$_REQUEST['idx']]) ? $items[$_REQUEST['idx']] : '';

?>