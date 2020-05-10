<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
$status = $_GET['status'];
$json = file_get_contents(__DIR__ . '/mismatches.json');
$data = json_decode($json, true);
foreach ($data as $key => $properties) {
    if (isset($properties['status']) && $properties['status'] === $status) {
        echo "'" . $properties['id'] . "',";
    }
}