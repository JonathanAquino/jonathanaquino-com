<form method="post">
<textarea name="duh"></textarea>
<input type="submit" />
</form>
<?php

$duh = isset($_REQUEST['duh']) ? $_REQUEST['duh'] : '';
if($duh) header('Content-type: text/plain');

$blah = explode("\n",$duh);

foreach($blah as $it) {
   echo trim(preg_replace('/^[\d]+(.*)$/','$1',$it))."\n";
}//end foreach

?>