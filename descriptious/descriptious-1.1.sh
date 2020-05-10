#!/usr/local/bin/bash

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://opencontent.org/oishii/oishii.rss | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-oishii.xml

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://populicio.us/newlinks.rss | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-populicious.xml
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1.xsl descriptious-populicious descriptious-populicious.html
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1-cheyne.xsl descriptious-populicious descriptious-populicious-cheyne.html

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://del.icio.us/rss/popular/ | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-delicious-popular.xml
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1.xsl descriptious-delicious-popular descriptious-delicious-popular.html
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1-cheyne.xsl descriptious-delicious-popular descriptious-delicious-popular-cheyne.html

# For Trendalicious, stick with descriptious-1.3.rb, which preserves the description, because Trendalicious
# has useful descriptions (number of posts) [Jon Aquino 2005-05-29]

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.3.rb 'http://www.wotzwot.com/rssxl.php?pageurl=http%3A%2F%2Ffresh.homeunix.net%2Fdelicious.html&sf=%3Ctable%3E&si=%3Ctr%3E%3Ctd%3E&ei=%3C%2Ftd%3E%3C%2Ftr%3E&sd=&ed=' | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-trendalicious.xml

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://populicio.us/newlinks48.rss | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-populicious-new-sites-48h.xml
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1.xsl descriptious-populicious-new-sites-48h descriptious-populicious-new-sites-48h.html
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1-cheyne.xsl descriptious-populicious-new-sites-48h descriptious-populicious-new-sites-48h-cheyne.html

/usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://populicio.us/last24hours.rss | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-populicious-last-24h-popular.xml
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1.xsl descriptious-populicious-last-24h-popular descriptious-populicious-last-24h-popular.html
/usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1-cheyne.xsl descriptious-populicious-last-24h-popular descriptious-populicious-last-24h-popular-cheyne.html

# Disabling this feed because it takes too long to process [Jon Aquino 2005-05-07]
# /usr/local/bin/ruby /home/jonathanaquino/public_html/descriptious/descriptious-1.4.rb http://populicio.us/fulltotal.rss | /usr/local/bin/tidy -indent -xml > /home/jonathanaquino/public_html/descriptious/descriptious.xml
# cat /home/jonathanaquino/public_html/descriptious/descriptious.xml > /home/jonathanaquino/public_html/descriptious/descriptious-populicious-all-time-popular.xml
# /usr/local/bin/python /home/jonathanaquino/public_html/descriptious/xslt.py rss1.xsl descriptious-populicious-all-time-popular