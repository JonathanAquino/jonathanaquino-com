<html>
<head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<style>
h1 {
    font-size: 4em;
}
textarea, #button {
    margin-bottom: 1em;
}
textarea {
    width: 100%;
    height: 200px;
}
#spaces {
    width: 2em;
}
#button {
    font-size: 2em;
}
#xn_bar {
    display: none;
}
#userHeader {
    padding-top: 1em;
    padding-left: 2em;
}
#xn_app {
    padding-left: 2em;
}
body {
    font-size: 75%;
    font-family: Georgia,Verdana,Arial,Helvetica,sans-serif;
    /* background: url(/images/lblue091.jpg); */
}
p.instructions {
    font-size: 2em;
}
</style>
</head>
<body>
<h1>Jon's HTML/XML Indenter</h1>
<p class="instructions">Paste HTML or XML into the top box, then press the button.</p>
<textarea id="inputTextarea"><html><head></head><body><div>Hello, world!<div>--Goethe</div></div>
</body></html></textarea>
<?php $spaces = is_numeric($_GET['spaces']) ? $_GET['spaces'] : 4 ?>
<p>
    <input id="spaces" type="text" value="<?php echo $spaces ?>"/> &nbsp; spaces
    <?php
    if (! $_GET['spaces']) { ?>
        (you can also add ?spaces=<?php echo $spaces ?> to this page's URL)
    <?php
    } ?>
</p>
<p>
    <input id="divs-only" type="checkbox" /> &lt;div&gt;s only
</p>
<input id="button" type="button" value="Indent"/>
<textarea id="outputTextarea"></textarea>

<script>
var spaces = function(n) {
    var output = '';
    for (var i = 0; i < n; i ++) {
        output += ' ';
    }
    return output;
};
$('#button').click(function() {
    var spaceCount = parseInt($('#spaces').val());
    if ($('#divs-only').is(':checked')) {
        var openingOrClosingTag = /\s*(<\/?div[^>]*>)\s*/gi;
        var closingTag = /<\/div[^>]*>/i;
        var openingTag = /<div[^>]*[^/]>|<div>/i;
    } else {
        var openingOrClosingTag = /\s*(<\/?[a-z][^>]*>)\s*/gi;
        var closingTag = /<\/[a-z][^>]*>/i;
        var openingTag = /<[a-z][^>]*[^/]>|<[a-z]>/i;
    }
    var inputLines = $('#inputTextarea').val()
            .replace(openingOrClosingTag, '\n$1\n')
            .split(/\n/);
    var outputLines = [];
    var indentLevels = 0;
    $.each(inputLines, function(i, line) {
        line = $.trim(line);
        if (line == '') { return; }
        if (line.match(closingTag) && ! line.match(/-->/)) { indentLevels--; }
        var indent = '';
        outputLines.push(spaces(indentLevels*spaceCount) + line);
        if (line.match(openingTag) && ! line.match(/<img/)) { indentLevels++; }
    });
    $('#outputTextarea').val(outputLines.join('\n'));
});
</script>
</body>
</html>
