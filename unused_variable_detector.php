<?php
ini_set('magic_quotes_gpc', '0');
$code = $_POST['code'] ? $_POST['code'] : 'a = 100;
b = 200;
b = b + 1;';
?>
<h1>Unused Variable Detector</h1>
<p>Paste in code and press the button. A list of unused variables will be shown. Works for many different programming languages.</p>
<form method="post">
<p>
    <textarea name="code" cols="100" rows="20"><?php echo htmlentities($code) ?></textarea>
</p>
<p><input type="submit" value="Submit"></p>
</form>
<?php
if ($_POST) {
    $pattern = '@([a-z0-9_]+)\s+=\s@ui';
    preg_match_all($pattern, $_POST['code'], $matches);
    $variables = array_unique($matches[1]);
    $filteredCode = preg_replace($pattern, '', $_POST['code']);
    $unusedVariables = array();
    foreach ($variables as $variable) {
        if (! preg_match('@\b' . preg_quote($variable, '@') . '\b@', $filteredCode)) { $unusedVariables []= $variable; }
    } ?>
    <h2>Unused Variables</h2>
    <?php
    if ($unusedVariables) {
        echo '<ul>';
        foreach ($unusedVariables as $variable) {
            echo '<li>' . htmlentities($variable) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No unused variables.</p>';
    }
    ?>
<?php
}
