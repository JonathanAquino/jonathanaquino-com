<?php
//This script simply removes PHP and HTML tags from a string.

header('Content-Type: text/javascript;charset=utf-8');
$input = isset($_REQUEST['input']) ? $_REQUEST['input'] : '';
echo strip_tags($input);
?>