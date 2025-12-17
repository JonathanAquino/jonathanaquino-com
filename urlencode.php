<?php
header('Content-Type:text/plain');
if (!isset($_GET['q'])) {
    echo "Error: Missing required parameter 'q'";
    exit;
}
echo rawurlencode($_GET['q']);