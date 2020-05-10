<html>
<body>
<?php
$script = "
<script>
window.glam_affiliate_id = 0;
if (!window.glam_ord) { window.glam_ord = Math.random()*1E16; }
if (!window.glam_tile) { window.glam_tile = 0; }
var adCallUrl = 'http://www35.glam.com/gad/glamadapt_mobile.act?;sz=300x50' +';afid=' + window.glam_affiliate_id +';ord=' + window.glam_ord +';tile=' + (++window.glam_tile) +';_glto=' + (new Date()).getTimezoneOffset() +';_g_cv=3;';
document.write('<scr' + 'ipt src=\"' + adCallUrl + '\"><' + '/sc' + 'ript>');
</script>
" ?>
<h2>300x50</h2>
<pre>
<?php echo htmlentities(trim($script)) ?>
</pre>
<p>Output shown below:</p>
<?php echo $script ?>
</body>
</html>
