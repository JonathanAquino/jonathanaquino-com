#!/usr/local/bin/bash
cd /users/home/jonathanaquino/public_html/openjump_nightly_builds
/usr/bin/find . -name '*.zip' -mtime +7 -exec /bin/rm {} \;
