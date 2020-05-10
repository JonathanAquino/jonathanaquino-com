<?php

// IF...THEN...ELSE...

$value1 = $_GET[value1];
$value2 = $_GET[value2];
$test = $_GET[test];
$then = $_GET[then];
$else = $_GET[els];
$redirect = $_GET[redirect];
$input = $_GET[input];
$delimit = $_GET[delimit];

if ($input==""){ //Use original syntax: -value1, -value2, -test, etc
	// Greater Than
	if (strtoupper($test) == "GREATER"){
		if ($value1 > $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// Less Than
	elseif (strtoupper($test) == "LESS"){
		if ($value1 < $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// GreaterEqual Than
	elseif (strtoupper($test) == "GREATEREQUAL"){
		if ($value1 >= $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// LessEqual Than
	elseif (strtoupper($test) == "LESSEQUAL"){
		if ($value1 <= $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// Equal To
	elseif (strtoupper($test) == "EQUAL"){
		if ($value1 == $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// Not Equal To
	elseif (strtoupper($test) == "NOTEQUAL"){
		if ($value1 <> $value2) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	// Go to the IfThen information page if $test is incorrect or missing.
	else {
		header("Location: http://www.yubnub.org/kernel/man?args=ifthen");
	}
}

elseif (strpos($input, "(")==0 and strpos($input, ")")<>False){ //Use new syntax: (v1>v2)then,else
	$input = right($input,strlen($input)-1); //Remove the leading "(".
	$exploded = explode(")",$input); //Split string around ")".
	$thenelse = explode($delimit,$exploded[1]); //Split up then,else.
	$then = trim($thenelse[0]);
	$else = trim($thenelse[1]);
	
	$result = $else;
	
	if (strpos($exploded[0],"<>")==True){
		$strings = explode("<>",$exploded[0]);
		if (trim($strings[0]) <> trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"==")==True){
		$strings = explode("==",$exploded[0]);
		if (trim($strings[0]) == trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"<=")==True){
		$strings = explode("<=",$exploded[0]);
		if (trim($strings[0]) <= trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],">=")==True){
		$strings = explode(">=",$exploded[0]);
		if (trim($strings[0]) >= trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"=")==True){
		$strings = explode("=",$exploded[0]);
		if (trim($strings[0]) == trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],">")==True){
		$strings = explode(">",$exploded[0]);
		if (trim($strings[0]) > trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (strpos($exploded[0],"<")==True){
		$strings = explode("<",$exploded[0]);
		if (trim($strings[0]) < trim($strings[1])) {
			$result = $then;
		}
		else {
			$result = $else;
		}
	}
	
	elseif (trim(strtoupper($exploded[0]))=="TRUE"){
		$result = $then;
	}
	
	elseif (trim(strtoupper($exploded[0]))=="YES"){
		$result = $then;
	}
	
	elseif (trim($exploded[0])=="1"){
		$result = $then;
	}
}
else {
	header("Location: http://www.yubnub.org/kernel/man?args=ifthen");
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



//returns $length characters from the right of $string
function right($string, $length) {
   return substr($string, -$length, $length);
}
?> 