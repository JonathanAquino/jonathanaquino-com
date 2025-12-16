<?php
// normalizeDate takes a date and a date format, and outputs the date
// in the given format. For the date format specification, see
// https://www.php.net/manual/en/datetime.format.php
//
// Example: http://jonathanaquino.com/normalizeDate.php?date=4/5/2007&format=Y-m-d
// 2007-04-05
header('Content-Type: text/plain');
if (!isset($_GET['format']) || !isset($_GET['date'])) {
    echo "Error: Missing required parameters 'format' and/or 'date'";
    exit;
}
echo date($_GET['format'], strtotime($_GET['date']));