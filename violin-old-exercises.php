<?php
$count = 4;
$pool = array(
    'Spider exercise, to get to know the bow. Exaggerate, involving all fingers. Not so deep - use fingertips.',
    'Out-and-in exercise with a pencil',
    'Play F# on all four strings',
    'Sautille - find 2" spot where bow coughs, between midpoint and center of gravity.',
    'G scale with staccato. Like coughing - use gravity.',
    '4-finger scale',
    'Trace along string with pinky',
    'Vibrato exercise 1 (setting)',
    'Vibrato exercise 2 (wah-wah))',
    '12-note scale',
);
$items = array();
while (count($items) < $count) {
    $item = select($pool);
    if (in_array($item, $items)) {
        continue;
    }
    $items[] = $item;
}
echo '<ul><li>' . implode('</li><li>', $items) . '</li></ul>';
function select($pool) {
    $key = array_rand($pool);
    if (is_numeric($key)) {
        return $pool[$key];
    }
    return $key . ': ' . select($pool[$key]);
}