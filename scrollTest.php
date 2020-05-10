<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<input type="button" value="Go!">
<script>
    function getRandomColor() {
      var hex = Math.floor(Math.random() * 0xFFFFFF);
      return "#" + ("000000" + hex.toString(16)).substr(-6);
    }
    setInterval(function () {
        $('body').css('backgroundColor', getRandomColor());
        $('input').val($('input').val() + '!');
    }, 1000);
    $('input').click(function () {
        $('input').val($('input').val() + '!');
        setTimeout(function () {
            window.scrollTo(0, 0);
            $('body').css('backgroundColor', getRandomColor());
        }, 3000);
    });
</script>
<?php
for ($i = 0; $i < 100; $i++) {
    echo $i;
    echo str_repeat('<br>', 10);
} ?>
</body>