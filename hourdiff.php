<?php
header('Content-Type: text/plain');
echo round((strtotime($_GET['end'])-strtotime($_GET['start']))/3600, 1);

