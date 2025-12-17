<?php

header('Content-type: text/javascript');
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
echo 'document.writeln("'.$referer.'");';

?>