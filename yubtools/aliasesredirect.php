<html>
  <body>
    <script language="javascript">

<?php

header("Content-type: text/plain"); 


$phrase = $_GET["command"];
	$phrase = trim($phrase);
	$words = explode(' ', $phrase);
        echo $word[0];
        echo 'location.href="http://www.jjefferydesign.com/aliases/jobactions.cfm?action=search&cmd='+$words[0]+'&s='+$words[1]+'"';
	
?>

    </script> 
  </body>
</html>