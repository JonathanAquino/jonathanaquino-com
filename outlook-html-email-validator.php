<?php
$title = 'Outlook HTML Email Online Validator';
if (isset($_GET['source']) && $_GET['source']) {
    echo '<pre>';
    echo htmlentities(file_get_contents(__FILE__));
    echo '</pre>';
    return;
} ?>
<html>
<head>
<title><?php echo $title ?></title>
</head>
<body>
<h1><?php echo $title ?></h1>
<p>This tool checks for HTML/CSS elements that are not supported by Outlook 2007.
Use it as a basic check to see if your HTML email contains unsupported elements.
See <a href="http://msdn.microsoft.com/en-us/library/aa338201.aspx">Word 2007 HTML and CSS Rendering Capabilities in Outlook 2007</a>.</p>
<p>Paste your email HTML below:</p>
<form method="post">
<textarea style="width:500px; height: 150px;" name="message"><?php echo htmlentities(isset($_POST['message']) ? $_POST['message'] : '') ?></textarea><br/>
<input type="submit" value="Submit" />
</form>
<?php
if (isset($_POST['message']) && $_POST['message']) {
    $lowerCaseMessage = strtolower($_POST['message']);
    $unsupportedHtmlElements = array('applet', 'bdo', 'button', 'form', 'iframe', 'input', 'isindex', 'menu', 'noframes', 'noscript', 'object', 'optgroup', 'option', 'param', 'q', 'script', 'select');
    $unsupportedHtmlAttributes = array('accept', 'accept-charset', 'accesskey', 'archive', 'background', 'checked', 'classid', 'code', 'codecore', 'codetype', 'compact', 'data', 'declare', 'defer', 'disabled', 'enctype', 'longdesc', 'marginheight', 'marginwidth', 'media', 'method', 'multiple', 'noresize', 'object', 'onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus', 'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onreset', 'onselect', 'onsubmit', 'onunload', 'readonly', 'scrolling', 'selected', 'standby', 'tabindex', 'title', 'valuetype');
    $unsupportedCssProperties = array('azimuth', 'background-attachment', 'background-attachment', 'background-image', 'background-image', 'background-position', 'background-position', 'background-repeat', 'background-repeat', 'border-spacing', 'bottom', 'caption-side', 'clear', 'clear', 'clip', 'content', 'counter-increment', 'counter-reset', 'cue-before, cue-after, cue', 'cursor', 'display', 'display', 'elevation', 'empty-cells', 'float', 'float', 'font-size-adjust', 'font-stretch', 'left', 'line-break', 'list-style-image', 'list-style-image', 'list-style-position', 'list-style-position', 'marker-offset', 'max-height', 'max-width', 'min-height', 'min-width', 'orphans', 'outline', 'outline-color', 'outline-style', 'outline-width', 'overflow', 'overflow-x', 'overflow-y', 'pause-before, pause-after, pause', 'pitch', 'pitch-range', 'play-during', 'position', 'quotes', 'richness', 'right', 'speak', 'speak-header', 'speak-numeral', 'speak-punctuation', 'speech-rate', 'stress', 'table-layout', 'text-shadow', 'text-transform', 'text-transform', 'top', 'unicode-bidi', 'visibility', 'voice-family', 'volume', 'widows', 'word-spacing', 'word-spacing', 'z-index');
    echo '<h3>Unsupported HTML Elements</h3>';
    echo '<ul>';
    foreach ($unsupportedHtmlElements as $unsupportedHtmlElement) {
        if (strpos($lowerCaseMessage, '<' . $unsupportedHtmlElement)) {
            echo '<li>' . $unsupportedHtmlElement . '</li>';
        }
    }
    echo '</ul>';
    echo '<h3>Unsupported HTML Attributes</h3>';
    echo '<ul>';
    foreach ($unsupportedHtmlAttributes as $unsupportedHtmlAttribute) {
        if (strpos($lowerCaseMessage, $unsupportedHtmlAttribute . '=')) {
            echo '<li>' . $unsupportedHtmlAttribute . '</li>';
        }
    }
    echo '</ul>';
    echo '<h3>Unsupported CSS Properties</h3>';
    echo '<ul>';
    foreach ($unsupportedCssProperties as $unsupportedCssProperty) {
        if (strpos($lowerCaseMessage, $unsupportedCssProperty . ':')) {
            echo '<li>' . $unsupportedCssProperty . '</li>';
        }
    }
    echo '</ul>';
}
?>
<p>View the <a href="?source=1">source code</a> for this tool.</p>
</body>
</html>
