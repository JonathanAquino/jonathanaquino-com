<?xml version="1.0" encoding="utf-8" ?> 
<xsl:stylesheet
     version="1.0"
     xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
     <xsl:output method="html" />
     <xsl:template match="/rss/channel">
     <html>
          <head>
               <link rel="stylesheet" type="text/css" href="/mystyle.css" />
               <title><xsl:value-of select="title" /></title>
               <style media="all" lang="en" type="text/css">
                    .ChannelTitle
                    {
                         font-size:  x-large;
                         font-weight:  bold;
                         width:  700px;
#                         text-align:  center;
                    }
                    .ArticleEntry0
                    {
                         background-color:  #FFFFFF;
                         width:  700px;
                    }
                    .ArticleEntry1
                    {
                         background-color:  #EFEFEF;
                         width:  700px;
                    }
                    .ArticleTitle
                    {
#                         color:  #FFFFFF;
                         font-size:  large;
#                         font-weight:  bold;
                         padding-left:  5px;
                         padding-top:  5px;
                         padding-bottom:  5px;
                    }
                    .ArticleHeader
                    {
                         background-color:  #3399FF;
                         color:  #FFFFFF;
                         font-size:  7pt;
                         padding-left:  5px;
                         padding-top:  2px;
                         padding-bottom:  2px;
                    }
                    .ArticleHeader A:visited
                    {
                         color:  #FFFFFF;
                         text-decoration:  none;
                    }
                    .ArticleHeader A:link
                    {
                         color:  #FFFFFF;
                         text-decoration:  none;
                    }
                    .ArticleHeader A:hover
                    {
                         color:  #FFFF00;
                         text-decoration:  underline;
                    }
                    .ArticleDescription
                    {
                         color:  #000000;
                         font-size:  small;
                         padding-left:  5px;
                         padding-top:  5px;
                         padding-bottom:  5px;
                         padding-right:  5px;
                    }
               </style>
          </head>     
          <body>
               <xsl:apply-templates select="title" />
               <xsl:apply-templates select="item" />
          </body>
     </html>
     </xsl:template>
     <xsl:template match="title">
          <div class="ChannelTitle">
               <xsl:value-of select="text()" />
          </div>
<!--
<span style="font-size:x-small"><a href="http://jonaquino.blogspot.com/2005/05/descriptious-adding-descriptions-to.html">About Descriptious</a> | <a href="http://jonaquinolabs.blogspot.com">Jon Aquino Labs</a></span> | <a href="$feedUrl"><img src="/images/xml_button.gif"/></a><br/><br/>
-->
          <br />
     </xsl:template>
     <xsl:template match="item">
          <div class="ArticleEntry{position() mod 2}">

               <div class="ArticleTitle">
                    <a href="{link}"><xsl:value-of select="title" /></a>
               </div>
               <div class="ArticleDescription">
                    <xsl:value-of select="description" disable-output-escaping="yes"/>
               </div>
          </div>
          <br />
     </xsl:template>
</xsl:stylesheet>