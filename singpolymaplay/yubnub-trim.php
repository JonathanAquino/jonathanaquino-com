<?php

header('Content-Type: text/plain;charset=utf-8');
if (!isset($_REQUEST['str'])) {
    echo "Error: Missing required parameter 'str'";
    exit;
}
echo trim($_REQUEST['str']);

?>