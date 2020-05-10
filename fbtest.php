<html>
<head>
</head>
<body>
<div id='fb-root'></div>
<script>
  window.fbAsyncInit = function () {
    FB.init({
      appId      : '308939305080',
      status     : true,
      cookie     : true,
      xfbml      : false,
      version    : 'v2.3'
    });
  };
  (function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/$facebookLocale/sdk.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
  })();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<textarea id="textarea">
</textarea>
<input id="submit" type="submit">
<script>
$('#submit').click(function () {
    FB.login(function (response) {
        FB.api('/me/feed', 'post', $('#textarea').val(), function () {});
    }, {scope: 'publish_actions'});
});
</script>
</body>
</html>