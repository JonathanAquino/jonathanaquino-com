<?php
if (!isset($_GET["n"]) || !$_GET["n"]) {
    echo "Error: Missing required parameter 'n' (cookie name)";
    exit;
}
$cookie_name = $_GET["n"];
$cookie_value = isset($_GET["v"]) ? $_GET["v"] : '';
$cookie_expires = isset($_GET["x"]) ? $_GET["x"] : '';
$send_retval = isset($_GET["r"]) ? $_GET["r"] : '';

$retval = setcookie($cookie_name, $cookie_value, time()+60*60);

  if ($send_retval == 1) {
    return $retval;
  }
  
?>