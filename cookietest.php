<?php
setcookie('foo', 'a%b');
var_dump($_COOKIE['foo']);