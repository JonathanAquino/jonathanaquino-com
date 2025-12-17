<?php
if (isset($_GET['url']) && $_GET['url']) {
    readfile($_GET['url']);
} else {
    echo "Error: Missing required parameter 'url'";
}
