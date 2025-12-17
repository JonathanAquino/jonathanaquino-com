<?php $url = isset($_GET['url']) ? $_GET['url'] : ''; ?>
<iframe id="embed1" src="http://www35.glam.com/gad/glamadapt_video.act?afid=1726481576&videourl=<?php echo htmlentities(rawurlencode($url)) ?>" frameborder="0" allowfullscreen seamless width="640" height="480"></iframe>
<script>
    window.addEventListener("message", function(ev) {
        if(ev.source === document.getElementById('embed1').contentWindow) {
            console.log("Message from embed1", ev.data);
            if(ev.data.type == 'ready') {
                document.getElementById('embed1').contentWindow.postMessage({action:'play'}, '*');
            }
        }
    });
</script>