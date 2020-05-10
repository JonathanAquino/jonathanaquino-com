<?php
header('Content-Type: video/mp4');
header('Content-Length: 0');
header('X-Foo: Bar');
echo 'x';
readfile('foo.mp4');
