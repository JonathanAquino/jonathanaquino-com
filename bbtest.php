<!DOCTYPE html>
<html>
	<head>
	<title>My Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
</head>
<body>
<div data-role="page" data-url="<?php echo $_SERVER['REQUEST_URI']; ?>">

	<div data-role="header">
		<h1>BlackBerry Test</h1>
	</div><!-- /header -->

	<div data-role="content">
	    <p><?php echo $_GET['x'] ?></p>
	    <?php $id = mt_rand(); ?>
		<p id="<?php echo $id ?>">POSTing...</p>
		<script>
            $.post('/bbtest-js.php', {}, function (data) {
console.log(data);
                $('#<?php echo $id ?>').after('<p>POST done. Got back text/javascript.</p>');
            });
		</script>
		<a href="/bbtest.php?x=<?php echo mt_rand() ?>" data-transition="slide">Try again</a>
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>
