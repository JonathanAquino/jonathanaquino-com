<?php
header('Content-Type: text/plain');
echo floor((strtotime($_GET['end'])-strtotime($_GET['start']))/86400);

