<!-- Contributed by Sean O'Hagan [Jon Aquino 2005-06-27] -->
<!-- Tweaked by Josh Diggs [Jon Aquino 2006-04-14] -->
<?php
if (isset($_GET["ynenc"])) {
  header('Content-Type: text/html; charset='.$_GET["ynenc"]);
  unset($_GET["ynenc"]);
}
echo "<html>\n";
echo "<head>\n";
echo "<script language=javascript><!--\n";
echo "function postit() {\n";
echo "  theform.submit();\n";
echo "}\n";
echo "//-->\n";
echo "</script>\n";
echo "</head>\n";

if (!isset($_GET["yndesturl"]))
  echo "<body>No URL found!\n";
else if ($_GET["yndesturl"] == "")
  echo "<body>The URL is empty!\n";
else {
  $dest = $_GET["yndesturl"];
  unset($_GET["yndesturl"]);
  echo "<body onLoad=\"postit();\">\n";
  echo "<form method=post action=\"$dest\" id=theform name=theform>\n";
  $keys = array_keys($_GET);
  foreach ($keys as $key => $elmnt_name){
    $elmnt_val = $_GET[$elmnt_name];
    if (is_array($elmnt_val)){
      foreach ($elmnt_val as $elmnt_array_key => $elmnt_array_val){
        echo "<input type=hidden name=\"$elmnt_name";
        echo "[$elmnt_array_key]\" value=\"$elmnt_array_val\">\n";
      }
    } else {
      echo "<input type=hidden name=\"$elmnt_name\" value=\"$_GET[$elmnt_name]\">\n";
    }
  }
  echo "</form>\n";
}
echo "</body>\n";
echo "</html>\n";
?>