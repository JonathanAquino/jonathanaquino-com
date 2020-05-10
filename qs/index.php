<html>
<head>
<title>* <%= xnhtmlentities($_GET['file']) %></title>
<style>
body {
    background: #474457 url(gradient.png) repeat-x fixed top left;
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
        <?php echo $_SERVER['REQUEST_URI'] ?>
    </td>
  </tr>
</table>
<script src="/reflection.js"></script>
</body>
</html>
