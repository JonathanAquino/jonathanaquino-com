<?php
// Abbreviate

if (!isset($_GET['input']) || !$_GET['input']) {
    echo "Error: Missing required parameter 'input'";
    exit;
}

//$commandname = $_GET['commandname'];
//$inputs = $_GET['input'];

$stuff = $_GET['input'];
$commandname = left($stuff, strpos($stuff,' '));
$inputs = right($stuff, strlen($stuff)-strpos($stuff,' '));

$input = explode(';', $inputs);

//Retrieve the url of the command ($commandname) using the scrape command.
$commandurl = file_get_contents('http://www.eigology.com/yubnub/parse.php?ynp_tokens=muted%2522%3E+%3C%2Fspan%3E&ynp_dirs=0+0&yndesturl=http%3A%2F%2Fwww.yubnub.org%2Fkernel%2Fman%3Fargs%3D'.$commandname.'&ynp_debug=0&ynp_http=get&ynp_scrape=1');

//Break up $commandurl and remove excess text.
$commandurl = str_replace('${','@@',$commandurl);
$params = explode('@@',$commandurl);
$j = 0;
while ($j < count($params)){
	$params[$j] = left($params[$j], strpos($params[$j],'}'));
	if (strpos($params[$j],'=') <> FALSE) {
		$params[$j] = left($params[$j], strpos($params[$j],'='));
	}
	$j++;
}

//Check if there is a %s parameter in the command.
if (strpos(strtoupper($commandurl), "%S") <> FALSE){
	$output = $commandname." ".$input[0];
	$i = 1;
	while ($i < count($input)){
		$output = $output." -".$params[$i]." ".$input[$i];
		$i++;
	}
	//echo $output;
	header("Location: http://www.yubnub.org/parser/parse?command=".$output);
}
else {
	$output = $commandname;
	$i = 0;
	while ($i < count($input)){
		$paramKey = isset($params[$i+1]) ? $params[$i+1] : '';
		$output = $output." -".$paramKey." ".$input[$i];
		$i++;
	}
	//echo $output;
	header("Location: http://www.yubnub.org/parser/parse?command=".$output);
}



//returns $length characters from the left of $string
function left($string, $length) {
   return substr($string, 0, $length);
}

//returns $length characters from the right of $string
function right($string, $length) {
   return substr($string, -$length, $length);
}

?> 