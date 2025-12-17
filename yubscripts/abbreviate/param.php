<?php
// PARAM - Constructs a parameter string for a yubnub command.
// Input should be in the form param1;param2;param3 value1;value2;value3

if (!isset($_GET['input']) || !$_GET['input']) {
    echo "Error: Missing required parameter 'input'";
    exit;
}
$input = $_GET['input'];

$p = left($input, strpos($input," "));
$v = right($input, strlen($input)-strpos($input," ")-1);

$params = explode(';', strtolower($p));
$values = explode(';', $v);

$output = "";
$i = 0;
while ($i < count($params)){
	if ($params[$i] <> "s"){
		$output = $output."-".$params[$i]." ".$values[$i]." ";
	}
	else {
		$output = $output.$values[$i]." ";
	}
	++$i;
}
$output = trim($output);

header('Content-Type: text/javascript;charset=utf-8');

echo $output;

//returns $length characters from the left of $string
function left($string, $length) {
   return substr($string, 0, $length);
}

//returns $length characters from the right of $string
function right($string, $length) {
   return substr($string, -$length, $length);
}

?> 