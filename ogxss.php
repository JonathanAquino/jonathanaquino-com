<!doctype html>
<html lang="en">
<head prefix="og: http://ogp.me/ns#">
<meta charset="utf-8">
<title>Cross site scripting image attempt</title>
<meta property="og:title" content="Cross site scripting image attempt">
<meta property="og:url" content="http://jonathanaquino.com/ogxss.php">
<meta property="og:image" content="javascript:alert('XSS!')">
<meta property="og:type" content="photo">
</head>
<body>
<p>An attempt to introduce JavaScript in an og:image, which might be displayed as an &lt;img src&gt; on a consuming website.</p>
<p>Images are defined as http and https protocols only; javascript:* should not be an accepted value.</p>
</body>
</html>
