<?php
// Redirects to a random Leslie Sansone 1-mile walk video.
$urls = array(
    'https://www.youtube.com/watch?v=enYITYwvPAQ',
    'https://www.youtube.com/watch?v=cvEJ5WFk2KE',
    'https://www.youtube.com/watch?v=RP0Q8geTcJc',
    'https://www.youtube.com/watch?v=vUQXg5V7y2Q',
    'https://www.youtube.com/watch?v=p2ggHwtb-Zg',
    'https://www.youtube.com/watch?v=wwn3YJyOzdY',
    'https://www.youtube.com/watch?v=l5uilZNoaAU',
    'https://www.youtube.com/watch?v=OavMd2j3DvU'
);
shuffle($urls);
header('Location: ' . $urls[0]);

