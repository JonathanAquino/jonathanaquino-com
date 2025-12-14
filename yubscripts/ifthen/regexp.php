<?php
// ifMatch. Check for a match using regular expressions.

$pattern = $_GET['pattern'];
$string = $_GET['string'];
$then = $_GET['then'];
$else = $_GET['els'];
$redirect = $_GET['redirect'];

if (preg_match ($pattern,$string)) {
	$result = $then;
} 
else {
	$result = $else;
}

// Send the result.
// If $redirect is true and $result is a web site, then redirect to the site.
if (strtoupper($redirect) == "TRUE" and strtoupper(substr($result, 0, 4)) == "HTTP"){
	header("Location: $result");
}
// Else just echo $result.
else{
	header('Content-Type: text/javascript;charset=utf-8');
	echo $result;
}

?> 