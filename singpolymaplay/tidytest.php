<?php

if (!isset($_REQUEST['url']) || !$_REQUEST['url']) {
    echo "Error: Missing required parameter 'url'";
    exit;
}

if (!class_exists('tidy')) {
    echo "Error: The tidy extension is not available.";
    exit;
}

require('getTidy.php');

header('Content-type: application/xhtml+xml');

echo getTidy($_REQUEST['url']);

?>