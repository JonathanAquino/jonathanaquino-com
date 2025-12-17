<?php

if (!isset($_GET["n"]) || !$_GET["n"]) {
    echo "Error: Missing required parameter 'n' (cookie name)";
    exit;
}
$cookie_name = $_GET["n"];

//  header('Content-type: text/plain');
echo isset($_COOKIE[$cookie_name]) ? $_COOKIE[$cookie_name] : '';

?>