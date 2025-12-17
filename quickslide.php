<?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
<html>
<head>
<title><?php echo strip_tags($q) ?></title>
<style>
body {
    background: #3C394B url(gradient.png) repeat-x fixed top left;
}
#content {
    color: white;
    font-family: Myriad, Futura, "Tw Cen MT", "Gill Sans", Helvetica, Arial;
    font-size: 9em;
}
.subtitle {
    padding-top:2.5em;
    font-size:0.4em;
}
</style>
</head>
<body>
<table width="100%" height="95%">
  <tr>
     <td id="content" valign="middle" align="center">
        <?php echo $q ?>
    </td>
  </tr>
</table>
<script src="/reflection.js"></script>
</body>
</html>