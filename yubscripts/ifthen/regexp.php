<?php
// ifMatch. Check for a match using regular expressions.

if (!isset($_GET['pattern']) || !$_GET['pattern']) {
    echo "Error: Missing required parameter 'pattern'";
    exit;
}
$pattern = $_GET['pattern'];
$string = isset($_GET['string']) ? $_GET['string'] : '';
$then = isset($_GET['then']) ? $_GET['then'] : '';
$else = isset($_GET['els']) ? $_GET['els'] : '';
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';

if (preg_match($pattern, $string)) {
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