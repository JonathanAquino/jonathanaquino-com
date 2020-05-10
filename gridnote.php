<?php
if ($_GET['view-source']) {
    highlight_file(__FILE__);
    exit;
}
if (! $_GET['count']) {
    header('Location: http://jonathanaquino.com/gridnote.php?count=35&width=200&height=200');
    exit;
} ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>GridNote - A grid of sticky notes</title>
<style>
body {
    color: white;
    background: black;
    font-family: Arial, Helvetica, sans-serif;
}
a {
    color: #666;
    margin-right: 10px;
}
textarea {
    color: black;
    width: <?php echo intval($_GET['width']) ?>px;
    height: <?php echo intval($_GET['height']) ?>px;
    font-family: Arial, Helvetica, sans-serif;
    overflow: auto;
    border: none;
    padding: 7px;
}
</style>
</head>
<body>
<a href="#">Clear All Notes</a>
<a href="?view-source=yes">View Source</a>
<a href="http://jonaquino.blogspot.com/2007/12/gridnote-grid-of-sticky-notes.html">About GridNote</a>
<br />
<?php
$colors = array('4AFF5A', '7F3CFF', '41FFD8', 'E8DB47', 'E85997');
for ($i = 0; $i < intval($_GET['count']); $i++) { ?>
    <textarea style="background: #<?php echo $colors[$i % 5] ?> url(/gridnote_image/<?php echo $colors[$i % 5] ?>.jpg) repeat-x scroll top left" id="textarea_<?php echo $i ?>" onBlur="textareaChanged(<?php echo $i ?>)"><?php echo htmlentities($_COOKIE['text_' . $i]); ?></textarea>
<?php
} ?>
<script>
var textareaChanged = function(i) {
    var date = new Date();
    var year = 365 * 24 * 60 * 60 * 1000;
    date.setTime(date.getTime() + (10 * year));
    // Use expires instead of max-age, which IE does not support [Jon Aquino 2007-12-25]
    document.cookie = 'text_' + i + '=' + encodeURIComponent(document.getElementById('textarea_' + i).value) + '; expires=' + date.toUTCString() + '; path=/gridnote.php';
};
document.getElementsByTagName('a')[0].onclick = function() {
    var textareas = document.getElementsByTagName('textarea');
    for (var i = 0; i < textareas.length; i++) {
        textareas[i].value = '';
        textareaChanged(i);
    }
    return false;
};
</script>
</body>
</html>
