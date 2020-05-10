<?php
// Math commands.
header('Content-Type: text/javascript;charset=utf-8');
// SUM
if (strtoupper($_GET[command]) == "SUM") {
	$numbers = explode(" ",$_GET[input]);
	echo array_sum($numbers);
}

// SUBTRACT
if (strtoupper($_GET[command]) == "SUBTRACT") {
	$numbers = explode(" ",$_GET[input]);
	echo $numbers[0] - $numbers[1];
}

// MULTIPLY
if (strtoupper($_GET[command]) == "MULTIPLY") {
	$numbers = explode(" ",$_GET[input]);
	echo $numbers[0] * $numbers[1];
}

// ROUND
if (strtoupper($_GET[command]) == "ROUND") {
	$number = $_GET[input];
	echo round($number, $_GET[precision]);
}

// DIVIDE
if (strtoupper($_GET[command]) == "DIVIDE") {
	$numbers = explode(" ",$_GET[input]);
	echo $numbers[0] / $numbers[1];
}

?> 