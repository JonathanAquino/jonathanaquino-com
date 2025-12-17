<?php
$url = isset($_GET['url']) ? $_GET['url'] : '';
$seconds = isset($_GET['seconds']) ? $_GET['seconds'] : '60';
?>
<HTML>
<HEAD>
</HEAD>
<FRAMESET rows="*,15px">
 <FRAME SRC="<?php echo htmlspecialchars($url) ?>">
 <FRAME SRC="autorefresh-timer.php?seconds=<?php echo htmlspecialchars($seconds) ?>">
</FRAMESET>
</HTML> 
