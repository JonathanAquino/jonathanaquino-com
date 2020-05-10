<?php

define("FORWARD", 0);
define("BACKWARD", 1);

// fetch the GET vars

// maybe we're debugging
$debugging = FALSE;
if (isset($_GET["ynp_debug"])) {
  if ($_GET["ynp_debug"] == 1) {
    $debugging = TRUE;
  }
  unset($_GET["ynp_debug"]);
}

if ($debugging) { var_dump($_GET); echo "<br>"; }

// the method to send the vars using curl
if (isset($_GET["ynp_http"])) {
  if ($_GET["ynp_http"] == "get") {
    $http_method = "-G"; // explicitly use the curl GET switch "-G"
  } else {
    $http_method = ""; // use no switch
  }
  unset($_GET["ynp_http"]);
} else {
  $http_method = "-G"; // explicitly use the curl GET switch "-G"
}

// are we fetching an xml rss feed?
if (isset($_GET["ynp_rss"])) {
  $rss_feed = TRUE;
  unset($_GET["ynp_rss"]);
} else {
  $rss_feed = FALSE;
}

// the destination url for the command
if (isset($_GET["yndesturl"])) {
  $url = $_GET["yndesturl"];
  if ($debugging) { echo "$url<br>"; }
  unset($_GET["yndesturl"]);
} else {
  echo "yubnub error: yndesturl var not set";
  return "yubnub error: yndesturl var not set";
}

// the start offset if you want to skip some characters (optional)
if (isset($_GET["ynp_so"])) {
  $ynp_so = $_GET["ynp_so"];
  unset($_GET["ynp_so"]);
}

// the length of the string required (optional)
if (isset($_GET["ynp_l"])) {
  $ynp_l = $_GET["ynp_l"];
  unset($_GET["ynp_l"]);
}

// the following two switches can be used if only two tokens
// are provided. without them, everything between the two tokens
// is fetched.

// the start word (words separated by spaces, will be made more
// flexible) ie. "2" will start grabbing the second word
if (isset($_GET["ynp_w"])) {
  $ynp_w = $_GET["ynp_w"];
  unset($_GET["ynp_w"]);
}

// the number of words wanted
if (isset($_GET["ynp_nw"])) {
  $ynp_nw = $_GET["ynp_nw"];
  unset($_GET["ynp_nw"]);
}

// the token array. you must scan through the source html of
// a page and find some tokens, which, along with the above
// options should be able to pick out a word or phrase.
// if only two tokens are provided, the parser defaults to
// everything within those two tokens

$token_array = $_GET["ynp_tokens"];
unset($_GET["ynp_tokens"]);

// the direction array. how the tokens are to be found.
// 0 means forward and 1 means backward. you can scan forward
// to token1, then back to token2, then back to token3, then
// forward to token4, for example. everything before (relative
// to the seek direction) a found token is removed by the parser
// finally leaving you with a string between the last 2 tokens

if (isset($_GET["ynp_dirs"])) {
  $dir_array = $_GET["ynp_dirs"];
  unset($_GET["ynp_dirs"]);
} else {
  $dir_array = NULL;
}

$first = TRUE;
$data = "";
foreach ($_GET as $var => $val) {
  if ($first) {
    $first = FALSE;
    $data .= $var . "=" . urlencode($val);
  } else {
    $data .= "&" . $var . "=" . urlencode($val);
  }
}

if ($debugging) { echo "$data<br>"; }

// change to where curl is installed on your server
// usually /usr/bin or /usr/local/bin
$curl_path = "/usr/local/bin/"; // textdrive
//$curl_path = "/usr/bin/"; // eigology
//$curl_path = "c:\\cygwin\\bin\\"; // Sean local

$http_client = "Mozilla/4.0";

if ($data != "") {
  $http_data = "-d \"$data\"";
} else {
  $http_data = "";
}

$command = $curl_path."curl $http_method -A $http_client -m 30 $http_data $url";

$html_site=array();
exec($command, $html_site, $retval);
if ($retval != 0) {
  echo "yubnub error: URL fetch failed! ($retval)";
  return "yubnub error: URL fetch failed! ($retval)";
}

$html_parser_obj = new html_parser_obj($html_site, $url, $data);
$html_parser_obj->set_tokens($token_array);
$html_parser_obj->set_dirs($dir_array);
if ($debugging) {
  $html_parser_obj->set_debug();
}
if ($rss_feed) {
  $html_parser_obj->rss_doit();
} else {
  $html_parser_obj->doit();
}

class html_parser_obj {

  var $line_array;
  var $line_index;
  var $html_link;
  var $token_array;
  var $dir_array;
  var $curr_tok_array;
  var $curr_dir_array;
  var $line_char_index;
  var $url;

  function html_parser_obj($html_site, $url, $vars) {
    $this->line_array = $html_site;
    $url_arr = parse_url($url);
    $this->url = $url_arr["scheme"]."://".$url_arr["host"];
    $this->html_link = $url;
    if ($vars != "") {
      $this->html_link .= "?" . $vars;
    }
    $this->line_index = 0;
    $this->line_char_index = 0;
    $this->seekdir = FORWARD;
    $this->length = 0;
    $this->relevant_html = "";
    $this->debug = FALSE;
  }

  function set_tokens($token_array) {
    if (is_array($token_array)) {
      foreach($token_array as $token) {
        $this->token_array[] = urldecode($token);
      }
    }
  }

  function set_dirs($dir_array) {
    if ($dir_array == NULL) {
      for ($i=0; $i<count($this->token_array); $i++) {
        $this->dir_array[$i] = 0;
      }
    } else {
      $this->dir_array = $dir_array;
    }
  }

  function rss_doit() {
    // get the title

    // get the main link

    // get the items

      // get the titles

      // get the links
  }

  function doit() {

    // get the title
    $title_tok_array = array("<body", "<title", "</title>", ">");
    $title_dir_array = array(0, 1, 0, 1);

    $this->curr_tok_array = $title_tok_array;
    $this->curr_dir_array = $title_dir_array;

    $this->wkg_line_array = $this->line_array;
    foreach($title_tok_array as $i => $title_token) {
      $this->curr_index = $i;
      $result = $this->compactify();
      if ($result == FALSE) {
        break;
      }
    }

    if ($result == FALSE) {
      $this->title = $this->url;
    } else {
      $this->title = "";
      foreach ($this->wkg_line_array as $html_line) {
        $this->title .= $html_line;
      }
    }

    $this->curr_tok_array = $this->token_array;
    $this->curr_dir_array = $this->dir_array;

    $this->wkg_line_array = $this->line_array;
    foreach($this->token_array as $i => $token_string) {
      $this->curr_index = $i;
      $result = $this->compactify();
      if ($result == FALSE) {
        break;
      }
    }

echo "<html><head>
<link href=\"http://www.yubnub.org/stylesheets/yubnub.css\" media=\"screen\" rel=\"Stylesheet\" type=\"text/css\" />
  <script type=\"text/javascript\">
    function focus(){document.input_box.command.focus();}
  </script></head><body onload=\"focus()\">
";
echo "<table><tr><td></td><td><div class=footer>";

    if ($result) {
      foreach ($this->wkg_line_array as $html_line) {
        if (strpos($html_line, "href")) {
          if (strpos($html_line, "http") === FALSE) {
            $line_array = explode("<a href=\"", $html_line);
            $html_line = implode("<a href=\"$this->url", $line_array);
          }
        }
        echo $html_line;
      }
    } else {
      echo "yubnub parser error";
    }

    echo "<br>";
    echo "<div class=hint>(want more info? problem? click <a href=$this->html_link><font color=black>$this->title</font></a>)</div>";

echo "</div></td></tr>
  <tr>
    <td style=\"vertical-align:bottom;\"><a href=\"http://www.yubnub.org/\"><img src=\"http://www.yubnub.org/images/yubnub_small.png\"></a></td>

    <td style=\"vertical-align:bottom;\">
      <div class=\"hint\">Type in a command, or \"ls dictionary\" to search all commands for \"dictionary\", etc.</div>
      <form action=\"http://www.yubnub.org/parser/parse\" method=\"post\" name=\"input_box\">
  <input type=\"text\" name=\"command\" size=\"25\" value=\"\"/>
  <input type=\"submit\" value=\"Enter\" />
</form>
    </td>
  </tr>
</table></body></html>
";
  }

  function set_debug() {
    $this->debug = TRUE;
  }

  function debugging() {
    if ($this->debug)
      return TRUE;
    else
      return FALSE;
  }

  function compactify() {

    $this->decho("Searching in direction [".$this->get_curr_dir()."]", "green");
    $this->decho("for token [".$this->get_curr_tok()."]", "green");

    if ($this->searching_backwards()) {
      $new_line_array = array();
      $line_array_count = count($this->wkg_line_array) - 1;
      for ($i=$line_array_count; $i>=0; $i--) {
        $new_line_array[$line_array_count-$i] = strrev($this->wkg_line_array[$i]);
      }
      $this->wkg_line_array = $new_line_array;
      $token_string = strrev($this->curr_tok_array[$this->curr_index]);
      if ($this->line_char_index > 0) {
        $line_char_index = strlen($this->curr_tok_array[$this->curr_index])-$this->line_char_index;
      } else {
        $line_char_index = 0;
      }
    } else {
      $token_string = $this->curr_tok_array[$this->curr_index];
      $line_char_index = $this->line_char_index;
    }

    $token_string = strtolower($token_string);
    for ($i=0; $i<count($this->wkg_line_array); $i++) {
      $curr_line = strtolower($this->wkg_line_array[$i]);
      if ($curr_line == "") continue;

      $tok_pos = strpos($curr_line, $token_string, $line_char_index);

      $this->decho("Searching for [".htmlentities($token_string)."] in", "red");
      $this->decho("[".htmlentities($curr_line)."]", "black");
      $this->decho("from position $line_char_index", "red", 2);

      $token_found = FALSE;
      // if we find the current token...
      if (!($tok_pos === FALSE)) {

        // make sure we don't go beyond end of token array
        if ($this->curr_index < (count($this->curr_tok_array)-1)) {

          // if we're looking in the same direction for the next token
          if ($this->get_curr_dir() == $this->get_next_dir()) {
            if ($curr_line == $token_string) {
              $this->line_char_index = 0;
              $this->wkg_line_array = array_slice($this->wkg_line_array, $i+1);
            } else {
              $this->line_char_index = $tok_pos + strlen($token_string);
              $this->wkg_line_array[$i] = substr($this->wkg_line_array[$i],
                                             $this->line_char_index);
              $this->wkg_line_array = array_slice($this->wkg_line_array, $i);
            }

          // or maybe we're looking in the opposite direction
          } else {
            $this->decho("looking in opposite direction", "blue");
            if ($curr_line == $token_string) {
              $this->decho("the current line IS the token string", "blue");
              $this->line_char_index = 0;
              $this->wkg_line_array = array_slice($this->wkg_line_array,0,$i);
            } else {
              $this->decho("the token string is a substr of curr_line","blue");
              $this->line_char_index = $tok_pos - 1;
              $this->wkg_line_array[$i] = substr($this->wkg_line_array[$i], 0,
                                             $this->line_char_index+1);
              $this->wkg_line_array = array_slice($this->wkg_line_array,0,$i+1);
            }
          }
        } else {
          $this->line_char_index = $tok_pos - 1;
          $this->wkg_line_array[$i] = substr($this->wkg_line_array[$i],0,$this->line_char_index+1);
          $this->wkg_line_array = array_slice($this->wkg_line_array, 0, $i+1);
          if ($this->line_char_index >= strlen($this->wkg_line_array[$i])) {
            $this->line_char_index = 0;
          }
        }

        // and if the token is NOT on the first line
        if ($i != 0) {

          // then tack on this string to our relevant_html
          if ($this->searching_backwards()) {
            $this->relevant_html = strrev($this->wkg_line_array[$i])." ".$this->relevant_html;
          } else {
//            $this->relevant_html .= " ".$this->wkg_line_array[$i];
          }
          $this->line_char_index = 0;

        // or if we ARE on the first line
        } else {

          // if next token in same dir then simply advance the char pointer
          if ($this->curr_index < (count($this->curr_tok_array)-1)) {
            if ($this->get_curr_dir() == $this->get_next_dir()) {
              $this->line_char_index = $tok_pos + strlen($token_string);
            } else {
              $this->line_char_index = $tok_pos - 1;
            }
          }
          $this->line_char_index = 0;
        }
        $token_found = TRUE;
        break;
      }
    }

    if ($token_found) {
      if ($this->searching_backwards()) {
        $new_line_array = array();
        $line_array_count = count($this->wkg_line_array) - 1;
        for ($i=$line_array_count; $i>=0; $i--) {
          $new_line_array[$line_array_count-$i] = strrev($this->wkg_line_array[$i]);
        }
        $this->wkg_line_array = $new_line_array;
      }
    }
    return $token_found;
  }

  function searching_backwards() {
    if ($this->get_curr_dir() == BACKWARD) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function get_curr_tok() {
    return htmlentities($this->curr_tok_array[$this->curr_index]);
  }

  function get_curr_dir() {
    return $this->curr_dir_array[$this->curr_index];
  }

  function get_next_dir() {
    return $this->curr_dir_array[$this->curr_index+1];
  }

  function decho($string, $colour, $breaks=1, $override=FALSE) {
    if ($this->debugging() || $override) {
      echo "<font color=$colour>$string</font>";
      for ($i=1; $i<=$breaks; $i++)
        echo "<br>";
    }
  }

}

?>
