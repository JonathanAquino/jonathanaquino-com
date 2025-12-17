<?php
header('Content-Type: text/javascript;charset=utf-8');

if (!isset($_REQUEST['input']) || !$_REQUEST['input']) {
    echo "Error: Missing required parameter 'input'";
    exit;
}

require_once('JSON.php');
$json = new Services_JSON();

$inputarray = explode(".",$_REQUEST['input']); //Split up the input.
$cmdname = $inputarray[0]; //First item in array is the command name.

$commanddata = file_get_contents('http://yubscripts.ning.com/yn-commandscrape.php?xn_auth=no&cmd='.$cmdname,10000); //Fetch data from command scrape script.
$cmd = $json->decode($commanddata); //Decode data with JSON-PHP, store in $cmd

$az = "";
$j = 1;
while ($j < count($inputarray)){ //Build eval string '->created->time'
    $az = $az.'->'.$inputarray[$j];
    $j++;
}

if($cmd->golden){ //Set 'golden' value to either 0 or 1.
    $cmd->golden = 1;
}
else{
    $cmd->golden = 0;
}

eval("\$az=\$cmd".$az.";"); //Evaluate string.
echo $az;
?>