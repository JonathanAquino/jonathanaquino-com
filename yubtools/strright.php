<?php
header("Content-type: text/plain"); 

$string = $_GET["string"];
$length = $_GET["length"];

if ($length == 0) {
    echo "";
} else {
echo substr($string, -$length);
}

?>