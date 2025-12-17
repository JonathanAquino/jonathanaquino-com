<?php
if (!isset($_REQUEST['input']) || !$_REQUEST['input']) {
    echo "Error: Missing required parameter 'input'";
    exit;
}
//Scrape the man page and store the scrape in $data.
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://thesaurus.reference.com/search?q='.$_REQUEST['input']);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl_handle,CURLOPT_FOLLOWLOCATION,true); $data = curl_exec($curl_handle);
curl_close($curl_handle);

header('Content-Type: text/javascript;charset=utf-8');

if (empty($data)){echo 'Error retrieving data';}

else{
	$stuff = preg_match_between('Synonyms:<\/b>&nbsp;&nbsp;','Copyright',$data);//Get article text.
	$stuff = strip_tags($stuff); //Strip tags.
	$stuff = trim($stuff); //Trim outer whitespace.
	$stuff = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $stuff);//Remove blank lines.
	if ($_REQUEST['length']){
		$stuff = left($stuff,$_REQUEST['length']);
	}
	echo $stuff;//Show result.
}

//Returns value between two tokens.
function preg_match_between($a_sStart, $a_sEnd, $a_sSubject){
	$pattern = '/'. $a_sStart .'([^`]*?)'. $a_sEnd .'/';
	preg_match($pattern, $a_sSubject, $result);
	return $result[1];
}
//returns $length characters from the left of $string
function left($string, $length) {
	return substr($string, 0, $length);
}
?>