<?php
// String manipulation commands.
header('Content-Type: text/javascript;charset=utf-8');
if (!isset($_GET['command']) || !$_GET['command']) {
    echo "Error: Missing required parameter 'command'";
    exit;
}
$command = strtoupper($_GET['command']);
$input = isset($_GET['input']) ? $_GET['input'] : '';
// wordcount
if ($command == "WORDCOUNT") {
        $delimit = isset($_GET['delimit']) ? $_GET['delimit'] : ' ';
	$string = isset($_GET['string']) ? $_GET['string'] : '';

	echo count(explode($delimit, $string));
}

// strleft - returns a certain amount of characters from the beginning of a string.
if ($command == "STRLEFT") {
        $length = substr($input, strrpos($input, " ") + 1);
	$string = substr($input, 0, strrpos($input, " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) {
		echo substr($string, 0, $length);
	}
	else {
		echo $input;
	}
}

// strright - returns a certain amount of characters from the end of a string.
if ($command == "STRRIGHT") {
        $length = substr($input, strrpos($input, " ") + 1);
	$string = substr($input, 0, strrpos($input, " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) {
		echo substr($string, -$length);
	}
	else {
		echo $input;
	}
}

// strleftrev - returns a certain amount of characters from the beginning of a string. Counts from the end.
if ($command == "STRLEFTREV") {
	$length = substr($input, strrpos($input, " ") + 1);
	$string = substr($input, 0, strrpos($input, " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) {
		echo substr($string, 0, 0-$length);
	}
	else {
		echo $input;
	}
}

// strrightrev - returns a certain amount of characters from the end of a string. Counts from the beginning.
if ($command == "STRRIGHTREV") {
	$length = substr($input, strrpos($input, " ") + 1);
	$string = substr($input, 0, strrpos($input, " "));

	// Check if $length is an integer.
	if (preg_match("/^[0-9]+$/", $length)) {
		echo substr($string, $length);
	}
	else {
		echo $input;
	}
}

// strlength - returns the length of a string.
if ($command == "STRLENGTH") {
	echo strlen($input);
}

// strJoin - joins strings together.
// This command has not been added to YubNub because it seems mostly useless.
if ($command == "STRJOIN") {
        $delimiter = "|";
	$string = $input;

	echo str_replace($delimiter, "", $string);
}

// strReplace - Replace all instances of a string within another string.
if ($command == "STRREPLACE") {
        $find = isset($_GET['find']) ? $_GET['find'] : '';
	$replace = isset($_GET['replace']) ? $_GET['replace'] : '';
	$string = isset($_GET['string']) ? $_GET['string'] : '';
	if ($replace == "%20" || $replace == "\" \""){
		$replace = " ";
	}
	if ($find == "%20" || $find == "\" \""){
		$find = " ";
	}

	echo str_replace($find, $replace, $string);
}

// strFind - Find the first occurrence of a string within another.
if ($command == "STRFIND") {
        $find = isset($_GET['find']) ? $_GET['find'] : '';
	$reverse = isset($_GET['reverse']) ? $_GET['reverse'] : '';
	$string = isset($_GET['string']) ? $_GET['string'] : '';

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