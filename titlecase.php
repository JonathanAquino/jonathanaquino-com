<?php
/*
Plugin Name: Title Case
Plugin URI: http://nanovivid.com/stuff/wordpress/title-case/
Description: Attempts to properly capitalize post titles. Based on <a href="http://daringfireball.net/2008/05/title_case">code by John Gruber</a>.
Version: 1.1
Author: Adam Nolley
Author URI: http://nanovivid.com/
*/

function nv_title_case($str) {

    // Edit this list to change what words should be lowercase
    $small_words = "a an and as at but by en for if in of on or the to v[.]? via vs[.]?";
    $small_re = str_replace(" ", "|", $small_words);

    // Replace HTML entities for spaces and record their old positions
    $htmlspaces = "/&nbsp;|&#160;|&#32;/";
    $oldspaces = array();
    preg_match_all($htmlspaces, $str, $oldspaces, PREG_OFFSET_CAPTURE);

    // Remove HTML space entities
    $words = preg_replace($htmlspaces, " ", $str);

    // Split around sentance divider-ish stuff
    $words = preg_split('/( [:.;?!][ ] | (?:[ ]|^)["“])/x', $words, -1, PREG_SPLIT_DELIM_CAPTURE);

    for ($i = 0; $i < count($words); $i++) {

        // Skip words with dots in them like del.icio.us
        $words[$i] = preg_replace_callback('/\b([[:alpha:]][[:lower:].\'’(&\#8217;)]*)\b/x', 'nv_title_skip_dotted', $words[$i]);

        // Lowercase our list of small words
        $words[$i] = preg_replace_callback("/\b($small_re)\b/i", function($m) { return strtolower($m[1]); }, $words[$i]);

        // If the first word in the title is a small word, capitalize it
        $words[$i] = preg_replace_callback("/\A([[:punct:]]*)($small_re)\b/", function($m) { return $m[1] . ucfirst($m[2]); }, $words[$i]);

        // If the last word in the title is a small word, capitalize it
        $words[$i] = preg_replace_callback("/\b($small_re)([[:punct:]]*)\Z/", function($m) { return ucfirst($m[1]) . $m[2]; }, $words[$i]);
    }

    $words = join($words);

    // Oddities
    $words = preg_replace("/ V(s?)\. /i", " v$1. ", $words);                    // v, vs, v., and vs.
    $words = preg_replace("/(['’]|&#8217;)S\b/i", "$1s", $words);               // 's
    $words = preg_replace_callback("/\b(AT&T|Q&A)\b/i", function($m) { return strtoupper($m[1]); }, $words);  // AT&T and Q&A
    $words = preg_replace("/-ing\b/i", "-ing", $words);                         // -ing
    $words = preg_replace_callback("/(&[[:alpha:]]+;)/U", function($m) { return strtolower($m[1]); }, $words);          // html entities

    // Put HTML space entities back
    $offset = 0;
    for ($i = 0; $i < count($oldspaces[0]); $i++) {
        $offset = $oldspaces[0][$i][1];
        $words = substr($words, 0, $offset) . $oldspaces[0][$i][0] . substr($words, $offset + 1);
        $offset += strlen($oldspaces[0][$i][0]);
    }

    return $words;
}
function nv_title_skip_dotted($matches) {
    return preg_match('/[[:alpha:]] [.] [[:alpha:]]/x', $matches[0]) ? $matches[0] : ucfirst($matches[0]);
}

if (function_exists('add_filter')) {
    add_filter('the_title', 'nv_title_case');
}

echo nv_title_case(isset($_GET['q']) ? $_GET['q'] : '');
