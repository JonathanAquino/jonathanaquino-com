<?php
// Redirects to a random Leslie Sansone 1-mile walk video.
$urls = array(
    'https://www.youtube.com/watch?v=njeZ29umqVE',
    'https://www.youtube.com/watch?v=iok-dkEfNtg',
    'https://www.youtube.com/watch?v=6C92d9e-11o',
    'https://www.youtube.com/watch?v=qsCxdsrV5Fc',
    'https://www.youtube.com/watch?v=k_SoCdUlBvM',
    'https://www.youtube.com/watch?v=iBAjNQODSVo',
    'https://www.youtube.com/watch?v=X7OzRLb2aKY',
    'https://www.youtube.com/watch?v=tW9IY48x1bc',
    'https://www.youtube.com/watch?v=ECxnTuzZ614',
    'https://www.youtube.com/watch?v=KCe3ZS7pAC4',
    'https://www.youtube.com/watch?v=QAnL1nwnHX8',
    'https://www.youtube.com/watch?v=7tUsOBTx98A',
    'https://www.youtube.com/watch?v=JKT2U_hJe1g',
    'https://www.youtube.com/watch?v=lweAVLxdblQ'
);
shuffle($urls);
header('Location: ' . $urls[0]);

