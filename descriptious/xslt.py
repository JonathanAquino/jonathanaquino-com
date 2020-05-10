import sys
import libxml2
import libxslt
import time

xsl = sys.argv[1]
name = sys.argv[2]
output = sys.argv[3]
styledoc = libxml2.parseFile("/home/jonathanaquino/public_html/descriptious/"+xsl)
style = libxslt.parseStylesheetDoc(styledoc)
doc = libxml2.parseFile("/home/jonathanaquino/public_html/descriptious/"+name+".xml")
result = style.applyStylesheet(doc, { "name": "'"+name+"'" })
style.saveResultToFilename("/home/jonathanaquino/public_html/descriptious/"+output, result, 0)
style.freeStylesheet()
doc.freeDoc()
result.freeDoc()
