<?php
//This script scrapes a YubNub man page and returns a JSON object with all the info.

//Scrape the man page and store the scrape in $data.
$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,'http://yubnub.org/kernel/man?args='.$_REQUEST['cmd']);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
$data = curl_exec($curl_handle);
curl_close($curl_handle);

header('Content-Type: text/javascript;charset=utf-8');

if (empty($data)){echo '{error:"Error retrieving data."}';} //Return error message if scrape is unsuccessful.

else if (preg_match_between('<h1>','<\/h1>',$data)=="man ".$_REQUEST['cmd']){echo '{error:"Command does not exist."}';} //Return error message if command doesn't exist.

else{
    //Parse $data and save values into appropriate variables.
    $cmdurl = preg_match_between('class=\"muted\">','<\/span>',$data); //URL
    $cmddesc = preg_match_between('<pre>\n','\n<\/pre>',$data); //Description
    if (preg_match ("/awarded([^`]*?)yubnub golden egg/i", $data)) {   //Golden Egg
        $cmdge = True;
    } else {
        $cmdge = False;
    }
    $cmduses = preg_match_between('<div class=\"hint\" style=\"padding-top: 30px\">\n',' uses',$data); //Number of uses.
    $temp_ay = explode(" ",preg_match_between('-\nCreated ','\n-\nLast used',$data));
    $cmdcreated = array("date"=>$temp_ay[0],"time"=>$temp_ay[1],"timestamp"=>strtotime($temp_ay[0].' '.$temp_ay[1]));    //Date/time created.
    $temp_ay = explode(" ",preg_match_between('-\nLast used ','\n<\/div>',$data));
    $cmdlastused = array("date"=>$temp_ay[0],"time"=>$temp_ay[1],"timestamp"=>strtotime($temp_ay[0].' '.$temp_ay[1])); //Date/time last used.

    //Parse URL for parameter names and default values.
    $temp_ay = explode("$\{",$cmdurl);
    $prm_ay = array();
    $j = 1;
    while ($j < count($temp_ay)){
        $temp_ay[$j] = left($temp_ay[$j], strpos($temp_ay[$j],'}'));
        if (strpos($temp_ay[$j],'=') <> FALSE) {
		    $default[$j] = right($temp_ay[$j], strlen($temp_ay[$j])-strpos($temp_ay[$j],'=')-1);
		    $name[$j] = left($temp_ay[$j], strpos($temp_ay[$j],'='));
        }
        else{
            $name[$j] = $temp_ay[$j];
            $default[$j] = "";
        }
        $prm_ay[$name[$j]] = $default[$j];
        $j++;
    }
    if (strpos(strtoupper($cmdurl), "%S") == TRUE){ //Check for %s parameter.
        $params[0] = array("name"=>"%s","defaultvalue"=>"");
        $j=1;
    }
    else {
        $j=0;
    }
    foreach( $prm_ay as $name => $default){ //Build array of parameters and defaults.
        $params[$j] = array("name"=>$name,"defaultvalue"=>$default);
        $j++;
    }

    require_once('JSON.php');
    $json = new Services_JSON();

    //Build main array, including parameter array.
    $value = array("name"=>$_REQUEST['cmd'], "url"=>$cmdurl, "description"=>$cmddesc, "golden"=>$cmdge, "uses"=>$cmduses, "created"=>$cmdcreated, "lastused"=>$cmdlastused, "parameters"=>$params);

    $output = $json->encode($value); //Encode in JSON.
    if($_REQUEST['callback']) echo $_REQUEST['callback'].'(';
    echo str_replace('\r','',$output); //Echo result with '\r' stripped out.
    if($_REQUEST['callback']) echo ')';
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
//returns $length characters from the right of $string
function right($string, $length) {
   return substr($string, -$length, $length);
}
?>