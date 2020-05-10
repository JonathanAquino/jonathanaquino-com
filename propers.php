<?php
/**
 * This script extracts the propers from the HTML of http://divinumofficium.com/cgi-bin/missa/missa.pl
 */
if (!$_GET['date']) {
    header('Location: http://jonathanaquino.com/propers.php?date=' . date('Y-m-d', time()));
    exit;
}
$text = file_get_contents("http://divinumofficium.com/cgi-bin/missa/missa.pl?date=" . date('m-d-Y', strtotime($_GET['date'])));
preg_match('!<P\b.*?&nbsp!is', $text, $matches);
echo $matches[0];
echo date('F j, Y', strtotime($_GET['date']));
echo '</P>';
preg_match_all('!<td.*?</td>!is', $text, $matches);
foreach ($matches[0] as $match) {
    if (preg_match('!<I>\s*(Introit|Collect|Lesson|Gospel|Offertory|Secret|Preface|Communion|Post Communion)\s*</I>!', $match)) {
        echo utf8_encode(str_replace('../../', 'http://divinumofficium.com/', preg_replace('!\btd\b!', 'span', $match)));
        echo '<hr>';
    }
}
echo '<small><i>From <a href="http://divinumofficium.com/cgi-bin/missa/missa.pl">Divinum Officium</a></i></small>';
