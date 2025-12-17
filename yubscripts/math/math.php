<?php
// Math commands.
header('Content-Type: text/javascript;charset=utf-8');
if (!isset($_GET['command']) || !$_GET['command']) {
    echo "Error: Missing required parameter 'command'";
    exit;
}
$command = strtoupper($_GET['command']);
$input = isset($_GET['input']) ? $_GET['input'] : '';
// SUM
if ($command == "SUM") {
	$numbers = explode(" ",$input);
	echo array_sum($numbers);
}

// SUBTRACT
if ($command == "SUBTRACT") {
	$numbers = explode(" ",$input);
	echo $numbers[0] - $numbers[1];
}

// MULTIPLY
if ($command == "MULTIPLY") {
	$numbers = explode(" ",$input);
	echo $numbers[0] * $numbers[1];
}

// ROUND
if ($command == "ROUND") {
	$precision = isset($_GET['precision']) ? $_GET['precision'] : 0;
	echo round($input, $precision);
}

// DIVIDE
if ($command == "DIVIDE") {
	$numbers = explode(" ",$input);
	echo $numbers[0] / $numbers[1];
}

?> 