<?php
var_dump(phpversion());
var_dump(1);
if (function_exists('http_parse_cookie')) {
    $cookie = http_parse_cookie('RMID=2dab5fc9296749c2f28ec0b7; expires=Saturday, 20-Mar-2010 01:34:06 GMT; path=/; domain=.nytimes.com');
    var_dump(2);
    var_dump(http_build_cookie($cookie));
} else {
    echo "http_parse_cookie is not available in this PHP version\n";
}
var_dump(3); 
