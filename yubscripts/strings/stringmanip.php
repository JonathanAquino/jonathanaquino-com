<?php
// String manipulation commands.
header('Content-Type: text/javascript;charset=utf-8');
// wordcount
if (strtoupper($_GET['command']) == "WORDCOUNT") {
        $delimit = $_GET['delimit'];
	$string = $_GET['string'];

	echo count(explode($delimit, $string));
}

// strleft - returns a certain amount of characters from the beginning of a string.
if (strtoupper($_GET['command']) == "STRLEFT") {
        $length = substr($_GET['input'], strrpos($_GET['input'], " ") + 1);
	$string = substr($_GET['input'], 0, strrpos($_GET['input'], " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) {
		echo substr($string, 0, $length);
	} 
	else {
		echo $_GET['input'];
	}
}

// strright - returns a certain amount of characters from the end of a string.
if (strtoupper($_GET['command']) == "STRRIGHT") {
        $length = substr($_GET['input'], strrpos($_GET['input'], " ") + 1);
	$string = substr($_GET['input'], 0, strrpos($_GET['input'], " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) { 
		echo substr($string, -$length);
	} 
	else {
		echo $_GET['input'];
	}
}

// strleftrev - returns a certain amount of characters from the beginning of a string. Counts from the end.
if (strtoupper($_GET['command']) == "STRLEFTREV") {
	$length = substr($_GET['input'], strrpos($_GET['input'], " ") + 1);
	$string = substr($_GET['input'], 0, strrpos($_GET['input'], " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) { 
		echo substr($string, 0, 0-$length);
	} 
	else {
		echo $_GET['input'];
	}
}

// strrightrev - returns a certain amount of characters from the end of a string. Counts from the beginning.
if (strtoupper($_GET['command']) == "STRRIGHTREV") {
	$length = substr($_GET['input'], strrpos($_GET['input'], " ") + 1);
	$string = substr($_GET['input'], 0, strrpos($_GET['input'], " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) { 
		echo substr($string, $length);
	} 
	else {
		echo $_GET['input'];
	}
}

// strlength - returns the length of a string.
if (strtoupper($_GET['command']) == "STRLENGTH") {
	echo strlen($_GET['input']);
}

// strJoin - joins strings together.
// This command has not been added to YubNub because it seems mostly useless.
if (strtoupper($_GET['command']) == "STRJOIN") {
        $delimiter = "|";
	$string = $_GET['input'];

	echo str_replace($delimiter, "", $string);
}

// strReplace - Replace all instances of a string within another string.
if (strtoupper($_GET['command']) == "STRREPLACE") {
        $find = $_GET['find'];
	$replace = $_GET['replace'];
	$string = $_GET['string'];
	if ($replace == "%20" || $replace == "\" \""){
		$replace = " ";
	}
	if ($find == "%20" || $find == "\" \""){
		$find = " ";
	}

	echo str_replace($find, $replace, $string);
}

// strFind - Find the first occurrence of a string within another.
if (strtoupper($_GET['command']) == "STRFIND") {
        $find = $_GET['find'];
	$reverse = $_GET['reverse'];
	$string = $_GET['string'];
	
	if ($find == "%20" || $find == "\" \""){
		$find = " ";
	}

	if (strtoupper($reverse)=="TRUE"){
		if(strrpos($string, $find)===FALSE) {echo 0;}
		else {echo strrpos($string, $find) + 1;}
	}
	else {
		if(strpos($string, $find)===FALSE) {echo 0;}
		else {echo strpos($string, $find) + 1;}
	}
}

?> 