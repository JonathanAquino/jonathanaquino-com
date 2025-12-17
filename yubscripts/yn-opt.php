<?php
header('Content-Type: text/javascript;charset=utf-8');

if (!isset($_REQUEST['url']) || !$_REQUEST['url']) {
    echo "Error: Missing required parameter 'url'";
    exit;
}

require_once('JSON.php');
$json = new Services_JSON();

$inputarray = isset($_REQUEST['input']) ? explode(".",$_REQUEST['input']) : array(); //Split up the input.

$theobject = file_get_contents('http://armknecht.com/xoxotools/outlineconvert.php?output=json&classes=items&url='.$_REQUEST['url'],10000);

$cmd = $json->decode($theobject); //Decode data with JSON-PHP, store in $cmd

if($_REQUEST['input']){ //If query elements are provided...
   $az = "";
   $j = 0;
   while ($j < count($inputarray)){ //Build eval string '->created->time'
       $az = $az.'->'.$inputarray[$j];
       $j++;
   }
   eval("\$az=\$cmd".$az.";"); //Evaluate string.
   echo $az;
}
else{ //Otherwise, just print the array.
   print_r($cmd);
}

?>
