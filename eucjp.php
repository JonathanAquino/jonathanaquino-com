<?php
// Used by YubNub eucjp command [Jon Aquino 2007-10-17]
header('Content-Type: text/plain');
$urlParts = parse_url($_GET['url']);
header('Location: ' . str_replace($urlParts['query'], convert($urlParts['query']), $_GET['url']));
exit;

function convert($query) {
    if (! $query) { return $query; }
    $variables = array();
    parse_str($query, $variables);
    $convertedVariables = array();
    foreach ($variables as $key => $value) {
        $convertedVariables[$key] = mb_convert_encoding($value, 'eucjp', 'UTF-8');
    }
    return http_build_query($convertedVariables);
}

