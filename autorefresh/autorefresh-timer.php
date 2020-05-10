<?php $seconds = $_GET['seconds'] ? $_GET['seconds'] : 60; ?>
<div style="position:absolute;top:0;left:0;font-size:12px">Autorefreshes every <?php echo $seconds; ?> seconds.</div>
<script type="text/javascript">
    setTimeout("top.location.reload(true);", <?php echo $seconds ?>*1000);  
</script>
