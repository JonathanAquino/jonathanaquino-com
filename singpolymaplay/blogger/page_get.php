<?php

header('Content-type: text/javascript;');

if (!isset($_REQUEST['url']) || !$_REQUEST['url']) {
    echo '{"error":"Missing required parameter url"}';
    exit;
}

if(isset($_REQUEST['callback']) && $_REQUEST['callback'])
   echo $_REQUEST['callback'].'(';

   $curl = curl_init($_REQUEST['url']);
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
   $rtrn = curl_exec($curl);
   curl_close($curl);

echo '{"html":"'.str_replace("\n",'\n',str_replace("\r",'',addslashes($rtrn))).'"}';

if($_REQUEST['callback'])
   echo ')';

?>