<?php
/**
 * Displays one or more random numbers.
 *
 * Expected GET parameters:
 *     - num - number of random numbers to output
 *     - min - minimum value, defaults to 1
 *     - max - maximum value, defaults to 100
 */
$min = isset($_GET['min']) ? $_GET['min'] : 1;
$max = isset($_GET['max']) ? $_GET['max'] : 100;
$num = isset($_GET['num']) ? $_GET['num'] : 1;
header('Content-Type: text/plain');
for ($i = 0; $i < $num; $i++) {
    echo mt_rand($min, $max) . "\n";
}
