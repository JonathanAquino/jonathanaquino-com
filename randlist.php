<?php
$items = explode(',', $_GET['items']);
shuffle($items);
$item = $items[0];
$big = isset($_GET['big']) && $_GET['big'] === 'yes';
if ($big) {
    echo "<span style='font-size: 200px'>$item</span>";
} else {
    echo $item;
}