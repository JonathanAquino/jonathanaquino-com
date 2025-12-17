<?php
// The Ning platform is no longer available
echo "Error: This feature requires the Ning platform which is no longer available.";
exit;
// Original code follows:

require_once 'XNC/ContentManager.php';

if (XN_Profile::current()->isOwner()) {
  $mgr = new XNC_ContentManager();
  $mgr->go();
} else {
  echo '<h1>Whoops!</h1>';
  echo '<p>We\'re sorry, only the owner of this application can access the Content Manager.  If that\'s
        you, please sign in.</p>';
}
?>