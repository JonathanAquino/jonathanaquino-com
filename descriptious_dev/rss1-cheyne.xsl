<?xml version="1.0" encoding="utf-8"?>
<!--
  Title: RSS 1.0 XSL Template
  Author: Rich Manalang (http://manalang.com)
  Description: This sample XSLT will convert any valid RSS 1.0 feed to HTML.
-->
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:foo="http://purl.org/rss/1.0/">
  	<xsl:output method="html"/>
	<xsl:template match="/">
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="/mystyle.css" />
                <link rel="stylesheet" type="text/css" href="descriptious.css" />
                <link rel="stylesheet" type="text/css" href="cheyne.css" />
            </head>
            <body>
		<xsl:apply-templates select="/rdf:RDF/foo:channel"/>
            </body>
            </html>
	</xsl:template>
	<xsl:template match="/rdf:RDF/foo:channel">
		<div class="syndication-content-area">
			<div class="syndication-title">
				<xsl:value-of select="foo:title"/>
                                <a style="margin-left:10px" href="{$name}.xml"><img src="/images/xml_button.gif"/></a>
			</div>
<span style="font-size:small"><a href="http://jonaquino.blogspot.com/2005/05/descriptious-adding-descriptions-to.html">About Descriptious</a> | <a href="http://jonaquinolabs.blogspot.com">Jon Aquino Labs</a><span style="padding-left:50px">Skin: <a href="{$name}.html">Original</a> | Cheyne (by <a href="http://cheyne.net/blog/">Iain Cheyne</a>)</span></span><br/>
                        <br/>
			<xsl:apply-templates select="/rdf:RDF/foo:item"/>
		</div>
	</xsl:template>
	<xsl:template match="/rdf:RDF/foo:item">
		<div class="syndication-list-item">
			<span class="syndication-list-item-title">
			<a href="{foo:link}">
				<xsl:value-of select="foo:title"/>
			</a>
			</span>
			<span class="syndication-list-item-description">
				<xsl:value-of select="foo:description" disable-output-escaping="yes"/>
			</span>
                </div>
	</xsl:template>
</xsl:stylesheet>