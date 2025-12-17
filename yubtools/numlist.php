<?php
header("Content-type: text/plain");

if (!isset($_GET["num"]) || !$_GET["num"]) {
    echo "Error: Missing required parameter 'num'";
    exit;
}
    $num = $_GET["num"];
    $token = isset($_GET["token"]) ? $_GET["token"] : ',';
    $num = trim($num);
    $numlist = 1;
    for ($i=2;($i<=$num);$i++) {
          $numlist .= $token;
          $numlist .= $i;
    }
    echo $numlist;

?>