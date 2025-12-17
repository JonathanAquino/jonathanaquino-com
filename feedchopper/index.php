<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (!isset($_GET['feed']) || !$_GET['feed']) {
    header("HTTP/1.0 400 Bad Request");
    echo "Error: Missing required parameter 'feed'";
    exit;
}
$feed = $_GET['feed'];
$validFeeds = array(
    'dave-aquino-portfolio',
    'graphic-design-history',
    'pragmatic-software-development-tips',
    'baltimore-catechism',
    'world-history',
    'cccc',
    'the-way',
    'churchill',
    'altarserver',
    'devoutlife',
);
if (!in_array($feed, $validFeeds)) {
    header("HTTP/1.0 404 Not Found");
    echo 'The feed could not be found';
    exit;
}
$lines = file('feeds/' . $_GET['feed'] . '.txt');
$title = str_replace('Title: ', '', trim(array_shift($lines)));
$startDate = str_replace('Start: ', '', trim(array_shift($lines)));
$todayDate = date('r', strtotime(date('Y-m-d', time())));
$itemIndex = ((strtotime($todayDate) - strtotime($startDate))/86400) % count($lines);
$item = trim($lines[$itemIndex]);
$itemTitle = mb_substr(strip_tags(str_ireplace('<br', ' - <br', $item)), 0, 100);
/** Quotes HTML */
function qh($s) {
    return htmlentities($s, ENT_QUOTES, 'UTF-8');
}
/** Quotes XML */
function qx($s) {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
header('Content-Type: application/rss+xml');
?><<?php ?>?xml version="1.0" encoding="UTF-8" ?<?php ?>>
<rss version="2.0">
<channel>
<title><?php echo qx($title) ?></title>
<link><?php echo qx('http://' . $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"]) ?></link>
<ttl>720</ttl>
<lastBuildDate><?php echo qx($todayDate) ?></lastBuildDate>
<pubDate><?php echo qx($todayDate) ?></pubDate>
<item>
    <title><?php echo qx($itemTitle) ?></title>
    <description><![CDATA[<?php echo $item ?>]]></description>
    <guid isPermaLink="false"><?php echo qx($todayDate) ?></guid>
    <pubDate><?php echo qx($todayDate) ?></pubDate>
</item>
</channel>
</rss>
