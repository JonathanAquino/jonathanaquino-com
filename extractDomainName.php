<?php
// Code from fpmuller@gmail.com
$url = $_GET['url'];
$url = preg_match(";^(http://|https://|ftp://|file://);","$url") ? $url : "http://$url";
$parts = parse_url($url);
$domainname = $parts['host'] ? preg_replace(';^(www|seek|query|search)\.;','',$parts['host']) : 'Not a valid URL!';
echo $domainname;
