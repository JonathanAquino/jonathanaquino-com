<?php

header("Content-type: text/plain");

if (!isset($_GET["arg"])) {
    echo "Error: Missing required parameter 'arg'";
    exit;
}
$arg = $_GET["arg"];
	if (is_numeric($arg)) {
            echo "1"; }
      else {
            echo "0"; }
?>