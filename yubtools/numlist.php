<?php
header("Content-type: text/plain"); 
    
    $num = $_GET["num"];
    $token = $_GET["token"];
    $num = trim($num);
    $numlist = 1;
    for ($i=2;($i<=$num);$i++) {
          $numlist .= $token;
          $numlist .= $i;
    }
    echo $numlist;

?>