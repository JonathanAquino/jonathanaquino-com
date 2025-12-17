<?php
if (!isset($_REQUEST['url']) || !$_REQUEST['url']) {
    echo "Error: Missing required parameter 'url'";
    exit;
}
//Scrape the page and store the scrape in $data.
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,$_REQUEST['url']);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl_handle,CURLOPT_FOLLOWLOCATION,true); $data = curl_exec($curl_handle);
curl_close($curl_handle);



if (empty($data)){echo 'Error retrieving data';} 

else{
	preg_match_all ("/<\s*a\s+[^>]*href\s*=\s*[\"']?([^\"' >]+jpg)[\"' >]/isU",$data, $out, PREG_PATTERN_ORDER); 
	$baseurl = left($_REQUEST['url'],strrpos($_REQUEST['url'],"/")+1);
	for ($i=0; $i< count($out[0]); $i++) {
		if(strtoupper(left($out[1][$i],4))<>"HTTP"){
			$out[1][$i] = $baseurl.$out[1][$i];
		}
		echo "<img src='".$out[1][$i]."'><br>";  
		//echo $out[1][$i]."\n"; 
	}
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