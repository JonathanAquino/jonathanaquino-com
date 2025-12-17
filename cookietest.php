<?php
setcookie('foo', 'a%b');
var_dump(isset($_COOKIE['foo']) ? $_COOKIE['foo'] : '(cookie not set yet - refresh page)');