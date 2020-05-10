<?php
$count = 1;
$pool = array(
    'Tone production DVD',
    'Review old exercises',
    'Kreutzer Etude 1' => array(
        '2 legatos, 1 detache, starting up-bow',
        '2 legatos, 1 detache, starting down-bow',
        '1 detache, 2 legatos, starting up-bow',
        '1 detache, 2 legatos, starting down-bow',
        'Dotted',
        '3 legatos, 1 detache, starting up-bow',
        '3 legatos, 1 detache, starting down-bow',
        '1 detache, 3 legatos, starting up-bow',
        '1 detache, 3 legatos, starting down-bow',
    ),
    'Shifting book',
    'Studies book',
    'Skye Boat Song',
    'Mazurka',
    'Gaby Ghost',
    'Nocturne',
    'Partita',
    'Donkey Doodle',
    'Gounod Ave Maria',
    'Listen to Youtube recordings' => array(
        'Kogan Oleg',
        'Oistrakh David',
        'Sitkovetski',
        'Kremer, esp. Bach Sonatas Partitas.',
        'Milstain',
        'Perlman',
        'Heifetz',
        'Repin'
    ),
    'Read Galamian',
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