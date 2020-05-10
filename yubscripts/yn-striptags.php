<?php
//This script simply removes PHP and HTML tags from a string.

header('Content-Type: text/javascript;charset=utf-8');
echo strip_tags($_REQUEST['input']);
?>