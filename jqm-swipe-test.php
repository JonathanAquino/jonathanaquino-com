<!DOCTYPE html>
<html>
	<head>
	<title>My Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.css" />
	<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.1.0-rc.2/jquery.mobile-1.1.0-rc.2.min.js"></script>
</head>
<body>

<div data-role="page">

	<div data-role="header">
		<h1>Jon's jQuery Mobile Swipe Test</h1>
	</div><!-- /header -->

	<div data-role="content">
	    <p>When you swipe on the box below, you should see an alert box that says "swipeleft" or "swiperight".</p>
	    <p class="swipe-area" style="font-size: 20px; color: white; background: black; float: left; padding: 20px">Try swiping on this text.</p>
	    <script>
	        $('.swipe-area').on('swipeleft swiperight', function (event) {
                alert(event.type);
	        })
	    </script>
	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>
