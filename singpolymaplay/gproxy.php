<?php

if (!isset($_REQUEST['url']) || !$_REQUEST['url']) {
    echo "Error: Missing required parameter 'url'";
    exit;
}
header('Content-Type: application/x-shockwave-flash');
echo file_get_contents($_REQUEST['url']);

?>