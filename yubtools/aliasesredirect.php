<html>
  <body>
    <script language="javascript">

<?php

header("Content-type: text/plain");

if (!isset($_GET["command"]) || !$_GET["command"]) {
    echo "Error: Missing required parameter 'command'";
    exit;
}

$phrase = $_GET["command"];
	$phrase = trim($phrase);
	$words = explode(' ', $phrase);
        echo $words[0];
        $word1 = isset($words[1]) ? $words[1] : '';
        echo 'location.href="http://www.jjefferydesign.com/aliases/jobactions.cfm?action=search&cmd='.$words[0].'&s='.$word1.'"';

?>

    </script> 
  </body>
</html>