<?php

header('Content-Type: text/plain');
if (!isset($_REQUEST['time']) || !$_REQUEST['time']) {
    echo "Error: Missing required parameter 'time'";
    exit;
}
echo strtotime($_REQUEST['time']);
echo "\n\n";
echo date('r',strtotime($_REQUEST['time']));

?>