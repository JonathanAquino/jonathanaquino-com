#!ruby

rss = "http://populicio.us/newlinks.rss"

rss = ARGV[0] if ARGV.length > 0

require "net/http"
def fetch(url)
  Net::HTTP.get(URI.parse(url))
end

require "digest/md5"
def extended_descriptions(url)
  extended_descriptions = ""
  # Wait 1 second between queries, as per http://del.icio.us/doc/api [Jon Aquino 2005-03-06]
  sleep 1
  delicious_url = "http://del.icio.us/url/#{Digest::MD5.new(url)}"
  fetch(delicious_url).split("\n").each { |line|
    if line =~ /<div style="font-size: 90%; margin-left: 1em;">(.*)<\/div>/
      extended_descriptions += "#{$1}..."
    end
  }  
  extended_descriptions = extended_descriptions[0..300]
  if extended_descriptions.length > 0
    extended_descriptions = "&lt;a href='#{delicious_url}'&gt;[D]&lt;/a&gt; " + extended_descriptions
  end
end

in_item_tag = false
title_replaced = false
last_link = ""
fetch(rss).split("\n").each { |line|
  # Assume tags are on separate lines [Jon Aquino 2005-03-18]
  if line =~ /<item.*>/
    in_item_tag = true 
  end
  if line =~ /<\/item>/
    in_item_tag = false 
  end
  if line =~ /<title>(.*)<\/title>/ and not title_replaced
    line = "<title>Descriptious: #{$1}</title>"
    title_replaced = true
  end
  if line =~ /<link>(.*)<\/link>/
    last_link = $1
  end
  if line =~ /<description>(.*)/ and in_item_tag
    description = $1
    line = "<description>&lt;i&gt;#{extended_descriptions(last_link)}&lt;/i&gt;&lt;br&gt;#{description}"
  end
  puts line
}
