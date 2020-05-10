<?php $url = 'http://dev5.mode.com/profile?affiliateId=12345&callback=' . rawurlencode('https://en.wikipedia.org/wiki/Pune'); ?>
<form action="<?php echo $url ?>" method="POST">
    Post to <?php echo $url ?><br>
    <input type="submit"/>
</form>