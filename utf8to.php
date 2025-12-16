<?php
// Used by YubNub encode command [Jon Aquino 2007-10-17]
header('Content-Type: text/plain');
if (!isset($_GET['inputs'])) {
    echo "Error: Missing required parameter 'inputs'";
    exit;
}
list($encoding, $url) = explode(' ', $_GET['inputs'], 2);
$urlParts = parse_url($url);
header('Location: ' . str_replace($urlParts['query'], convert($urlParts['query'], $encoding), $url));
exit;

function convert($query, $encoding) {
    if (! $query) { return $query; }
    $variables = array();
    parse_str($query, $variables);
    $convertedVariables = array();
    foreach ($variables as $key => $value) {
        $convertedVariables[$key] = mb_convert_encoding($value, $encoding, 'UTF-8');
    }
    return http_build_query($convertedVariables, '', '&');
}

