<?php
header("Content-type: text/plain");

if (!isset($_GET["string"]) || !isset($_GET["length"])) {
    echo "Error: Missing required parameters 'string' and 'length'";
    exit;
}
$string = $_GET["string"];
$length = $_GET["length"];

if ($length == 0) {
    echo "";
} else {
echo substr($string, -$length);
}

?>