<?php
// Implementation of YubNub's switch command [Jon Aquino 2007-10-20]
header('Content-Type: text/plain');
if (!isset($_GET['q']) || !$_GET['q']) {
    echo "Error: Missing required parameter 'q'";
    exit;
}
$q = mb_substr($_GET['q'], 0, 10000);
$x = trim(mb_substr($q, 0, mb_strpos($q, '|')));
$cases = array();
foreach(explode(',', mb_substr($q, mb_strpos($q, '|') + 1)) as $pair) {
    $parts = explode('=>', $pair);
    $cases[strtolower(trim($parts[0]))] = isset($parts[1]) ? trim($parts[1]) : '';
}
if (isset($cases[$x]) && mb_strlen(strtolower($cases[$x]))) { echo $cases[$x]; }
elseif (isset($cases['*']) && mb_strlen($cases['*'])) { echo $cases['*']; }
else { echo end($cases); }

