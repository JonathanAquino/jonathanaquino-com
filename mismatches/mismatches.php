<html>
<head>
</head>
<body>
<p style="width: 700px;">This page shows objects whose image differs from the video image provided
by Hydra. You can mark each object as "Leave it alone", "Remove the video", or
"Use Hydra image". Later, Jon will process the objects according to your choices.</p>
<?php
function ifseta($array, $offset, $default = null) {
    return is_array($array) && isset($array[$offset]) ? $array[$offset] : $default;
}
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
function qh($str) {
    return htmlentities($str, ENT_QUOTES, 'UTF-8');
}
function compare($a, $b) {
    return strcasecmp($b['createdDate']['date'], $a['createdDate']['date']);
}
$json = file_get_contents(__DIR__ . '/mismatches.json');
$data = json_decode($json, true);
uasort($data, 'compare');
$i = 0;
foreach ($data as $key => $properties) {
    $i++;
    $status = ifseta($properties, 'status', '');
    $canoeImageUrl = $properties['canoeImageUrl'];
    if (strpos($canoeImageUrl, 'http') !== 0) {
        $canoeImageUrl = 'http://api.ning.com' . $canoeImageUrl;
    }
    $createdDate = date('Y-m-d', strtotime($properties['createdDate']['date']));
    ?>
    <?php echo qh($i . '. ' . $createdDate . ' ' . $properties['title']) ?>
    (
        <a target="_blank" href="<?php echo qh($properties['url']) ?>">mode.com</a>,
        <a target="_blank" href="<?php echo qh($properties['externalUrl']) ?>"><?php echo qh($properties['source']) ?></a>
    )
    <?php
    if (!$properties['hydraImageUrl']) { ?>
        (Hydra can't find video anymore)
    <?php
    } ?>
    <br>
    <form class="object" data-key="<?php echo qh($key) ?>" style="margin-bottom: 1em;">
        <input type="button" name="showImages" value="Show images">
        <input style="display: none" type="button" name="hideImages" value="Hide images">
        <label><input type="radio" name="status" value="leave-alone" <?php echo $status === 'leave-alone' ? 'checked' : '' ?>> Leave it alone</label>
        <label><input type="radio" name="status" value="remove-video" <?php echo $status === 'remove-video' ? 'checked' : '' ?>> Keep the current image, remove the video</label>
        <label><input type="radio" name="status" value="hydra-image" <?php echo $status === 'hydra-image' ? 'checked' : '' ?>> Keep the video, change the image to the Hydra image</label>
        <br>
        <table style="display: none;">
            <tr>
                <td>Current video image</td>
                <td>What Hydra says the video image should be now</td>
            </tr>
            <tr>
                <td>
                    <img style="max-width: 400px; max-height: 400px;" src="about:blank" data-src="<?php echo qh($canoeImageUrl) ?>?width=400">
                </td>
                <td>
                    <?php
                    if ($properties['hydraImageUrl']) { ?>
                        <img style="max-width: 400px; max-height: 400px;" src="about:blank" data-src="<?php echo qh($properties['hydraImageUrl']) ?>">
                    <?php
                    } else {
                        echo '(none)';
                    } ?>
                </td>
            </tr>
        </table>
    </form>
<?php
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script>
$('[name="showImages"]').click(function () {
    $(this).closest('.object').find('table').show();
    $(this).closest('.object').find('img').each(function () {
        $(this).attr('src', $(this).data('src'));
    });
    $(this).closest('.object').find('[name="hideImages"]').show();
    $(this).hide();
});
$('[name="hideImages"]').click(function () {
    $(this).closest('.object').find('table').hide();
    $(this).closest('.object').find('[name="showImages"]').show();
    $(this).hide();
});
$('[name="status"]').click(function () {
    var key = $(this).closest('.object').data('key');
    var status = $(this).val();
    $.post('/mismatches/updateStatus.php', {key: key, status: status});
});
</script>
</body>
</html>