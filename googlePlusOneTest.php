<script>
var a = {b: {c: function() {alert('a.b.c')}}};
var foo = function (args) {alert(args.state)};
</script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<g:plusone callback="a.b.c"></g:plusone>
<g:plusone callback="foo"></g:plusone>

