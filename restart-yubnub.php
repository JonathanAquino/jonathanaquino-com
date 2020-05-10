<?php
echo date('c') . '<br>';

$output = restart();
$clearPids = strpos($output, 'clear the .pid') !== false;
echo 'Clearing pids? ' . ($clearPids ? 'Y' : 'N') . '<br>';
if ($clearPids) {
    clearPids();
    restart();
}
echo 'done';

function restart() {
    return run('cd /users/home/jonathanaquino/domains/yubnub.org/sites/yubnub && mongrel_rails cluster::start 2>&1');
}

function clearPids() {
    run('rm /users/home/jonathanaquino/domains/yubnub.org/sites/yubnub/tmp/mongrel.3900.pid');
    run('rm /users/home/jonathanaquino/domains/yubnub.org/sites/yubnub/tmp/mongrel.3901.pid');
}

function run($command) {
    ob_start(); 
    system($command);
    $output = trim(ob_get_clean());
    return $output;
}

