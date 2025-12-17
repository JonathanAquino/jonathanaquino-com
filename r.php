<?php
if (!isset($_GET['sleep'])) {
    echo "Error: Missing required parameter 'sleep'";
    exit;
}
sleep($_GET['sleep']);
readfile('http://jonaquino.blogspot.com/atom.xml');
