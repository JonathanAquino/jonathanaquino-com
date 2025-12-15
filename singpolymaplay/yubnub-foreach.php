<?php

function yubnubcmd($cmd) {
   if($cmd[0] == '"')
      return substr($cmd,1,strlen($cmd)-2);
   return file_get_contents('http://yubnub.org/parser/parse?command='.urlencode($cmd));
}//end function yubnubcmd

require('yubnub2phparray.php');
require('php2yubnubarray.php');

$items = yubnub2phparray(isset($_REQUEST['data']) ? $_REQUEST['data'] : '');

$_REQUEST['cmd'] = str_replace('%25s','%s',$_REQUEST['cmd']);
$as = isset($_REQUEST['as']) ? $_REQUEST['as'] : '';
$cmdsep = $as == '<space>' ? ' ' : "\n";
if($as == 'null') $cmdsep = '';
$data = '';

foreach($items as $item) {
   $cmd = stristr($_REQUEST['cmd'],'%s') ? str_replace('%s',$item,$_REQUEST['cmd']) : $_REQUEST['cmd'].' '.$item;
   $cmd = str_replace('[|','{',$cmd);
   $cmd = str_replace('|]','}',$cmd);
   if($as != 'array')
      $data .= yubnubcmd($cmd).$cmdsep;
   else
      $data[] = yubnubcmd($cmd);
}//end foreach items

$type = isset($_REQUEST['type']) && $_REQUEST['type'] ? $_REQUEST['type'] : 'xml';

if($as != 'array') {
   header('Content-Type: text/plain;charset=utf-8');
   echo $data;
} else
   echo php2yubnubarray($data,$type,isset($_REQUEST['callback']) ? $_REQUEST['callback'] : '');

?>