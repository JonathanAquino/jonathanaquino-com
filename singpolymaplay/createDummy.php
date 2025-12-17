<?php
// The Ning platform is no longer available
echo "Error: This feature requires the Ning platform which is no longer available.";
exit;
// Original code follows:


$dummy = XN_Content::create('Dummy',$_REQUEST['title'],$_REQUEST['description']);
$dummy->save();
echo 'Dummy ID# '.$dummy->id.' Created!';

?>