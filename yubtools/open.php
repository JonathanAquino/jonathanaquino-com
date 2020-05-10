<html>
  <body>
    <script language="javascript">
      <!--
      var WindowOpen = window.open("open.php");
      try{
        var obj = WindowOpen.name;
        WindowOpen.close();
        <?php
          $URIs = explode(';',$text);
           for($i=0;$i<count($URIs);$i++){
             $URIs[$i] = trim($URIs[$i]);
             if (!preg_match('/^http:\/\//i',$URIs[$i])) $URIs[$i] = 'http://'.$URIs[$i];
             echo 'window.open("'.$URIs[$i].'");';
           }
        ?>
      history.back();
      //If there isn't previous page...
      window.opener=top;
      window.close(); 
      //In firefox you can close the tab this way, so...
        var msg = '<center><b><a href="javascript:self.close()">'+
                'close me</a></b></center><br />'+
                'sorry, I couldn\'t close this window.<br />'+
                'if this is annoying for you, you can to turn on the '+
                '"pref("dom.allow_scripts_to_close_windows", false);" option in '+
                'your firefox configuration file, and then this window will close '+
                'automatically.';
        document.write(msg);
      }
      catch(e){
        var msg = 'Multi tab opener:<br />'+
                'This script uses the javascript window.open method, so you must disable '+
                'your pop-up blocker in this site to make it work. Thanks';
        document.write(msg);
      }
      //-->
    </script> 
  </body>
</html>