<?php
  $cookie_name = $_GET["n"];
  $cookie_value = $_GET["v"];
  $cookie_expires = $_GET["x"];
  $send_retval = $_GET["r"];

  $retval = setcookie($cookie_name, $cookie_value, time()+60*60);

  if ($send_retval == 1) {
    return $retval;
  }
  
?>