<!-- Contributed by Sean O'Hagan [Jon Aquino 2005-06-27] -->
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
  foreach ($_GET as $var_name => $var_value) {
    echo "<input type=hidden name=\"$var_name\" value=\"$var_value\">\n";
  }
  echo "</form>\n";
}
echo "</body>\n";
echo "</html>\n";
?>
