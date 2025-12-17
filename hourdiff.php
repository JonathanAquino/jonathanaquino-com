<?php
header('Content-Type: text/plain');
if (!isset($_GET['end']) || !isset($_GET['start'])) {
    echo "Error: Missing required parameters 'start' and 'end'";
    exit;
}
echo round((strtotime($_GET['end'])-strtotime($_GET['start']))/3600, 1);

