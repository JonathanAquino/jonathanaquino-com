<?php
header("Content-type: text/plain"); 

	function is_value($string) {
		if (is_numeric($string) && $string>0) return true;
		return false;
	}

	function is_beginning($string) {
		if (is_numeric($string) && $string<0) return true;
		return false;
	}

	function is_end($string) {
		global $range2;
		$size=$last=strlen($string)-1;
		$range2=substr($string,0,$size);
		if ($string[$last] == '-' && is_value($range2)) return true;
		return false;
	}

	function is_mid($string) {
		$index = explode('-', $string);
		if (count($index) == 2 && is_value($index[0]) && is_value($index[1])) return true;
		return false;
	}

$silentmode = $_GET["silentmode"];
$phrase = $_GET["phrase"];

	$phrase = trim($phrase);
	$words = explode(' ', $phrase);
	$range = $words[0];
	$range2;


	// 4
	if ( is_value($range) ){
		echo $words[$range];
		return true;
	}
	// -4
	if (is_beginning($range)){
		for($i=1;($i<=abs($range) && $i<=count($words));$i++){
			echo $words[$i].' ';
		}
		return true;
	}
	// 4-
	if (is_end($range)){
		for($i=$range2;$i<=count($words);$i++){
			echo $words[$i].' ';
		}
		return true;
	}
	// 2-4
	if (is_mid($range)){
		$range = explode('-', $range);
		for($i=$range[0];($i<=$range[1] && $i<=count($words));$i++){
			echo $words[$i].' ';
		}
		return true;
	}

	if (!$silentmode) echo 'Error!, or you are using incorrectly a YubNub command';
	return false;

?>