<?php

header("Content-type: text/plain"); 

$arg = $_GET["arg"];
	if (is_numeric($arg)) {
            echo "1"; }
      else {
            echo "0"; }
?>