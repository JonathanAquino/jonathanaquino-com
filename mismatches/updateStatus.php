<?php
$key = $_POST['key'];
$status = $_POST['status'];
if (!$key) {
    header('HTTP/1.0 400 Bad request');
    exit;
}
if (!preg_match('/^app:6571683:Cannes:obj-\d{0,100}$/', $key)) {
    header('HTTP/1.0 400 Bad request');
    exit;
}
if ($status !== 'leave-alone' && $status !== 'remove-video' && $status !== 'hydra-image') {
    header('HTTP/1.0 400 Bad request');
    exit;
}
$json = file_get_contents(__DIR__ . '/mismatches.json');
$data = json_decode($json, true);
$data[$key]['status'] = $status;
file_put_contents(__DIR__ . '/mismatches.json', json_encode($data));
echo 'ok';