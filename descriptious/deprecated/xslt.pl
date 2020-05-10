#!/usr/local/bin/perl
$xmlfile = "/home/jonathanaquino/public_html/descriptious/descriptious-trendalicious.xml";
$xsl = "/home/jonathanaquino/public_html/descriptious/rss1.xsl";

use XML::XSLT;

my $xslt = XML::XSLT->new ($xsl, warnings => 1);

$xslt->transform ($xmlfile);
print $xslt->toString;

$xslt->dispose();
