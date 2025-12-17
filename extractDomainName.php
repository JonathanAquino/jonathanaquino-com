<?php
// Code from fpmuller@gmail.com
if (!isset($_GET['url']) || !$_GET['url']) {
    echo "Error: Missing required parameter 'url'";
    exit;
}
$url = $_GET['url'];
$url = preg_match(";^(http://|https://|ftp://|file://);","$url") ? $url : "http://$url";
$parts = parse_url($url);
$domainname = isset($parts['host']) && $parts['host'] ? preg_replace(';^(www|seek|query|search)\.;','',$parts['host']) : 'Not a valid URL!';
echo $domainname;
