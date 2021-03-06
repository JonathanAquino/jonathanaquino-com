#!ruby

rss = "http://populicio.us/newlinks.rss"

rss = ARGV[0] if ARGV.length > 0

require "net/http"
def fetch(url)
  Net::HTTP.get(URI.parse(url))
end

def limit_total_length(descriptions)
  total_length = 0
  new_descriptions = []
  descriptions.each { |description|
    new_descriptions << description
    total_length += description.length
    return new_descriptions if total_length > 300
  }
  return new_descriptions
end

require "digest/md5"
def extended_descriptions(url)
  tags = []
  extended_descriptions = []
  # Wait 1 second between queries, as per http://del.icio.us/doc/api [Jon Aquino 2005-03-06]
  sleep 1
  delicious_url = "http://del.icio.us/url/#{Digest::MD5.new(url)}"
  fetch(delicious_url).split("\n").each { |line|
    if line =~ /delNum.*<a.*">(.*)<\/a>.*/
      tags << $1
    end
    if line =~ /<div class="extended">(.*)<\/div>/
      extended_descriptions << "#{$1}"
    end
  }  
  extended_descriptions = limit_total_length(extended_descriptions)
  return "&lt;a class='descriptious-delicious-url' href='#{delicious_url}'&gt;[D]&lt;/a&gt; &lt;span class='descriptious-tags'&gt;(" + tags[0..3].collect{|tag|"&lt;b&gt;#{tag}&lt;/b&gt;"}.join(", ") + ")&lt;/span&gt; &lt;span class='descriptious-extended-descriptions'&gt;" + extended_descriptions.collect {|description|"&lt;span class='descriptious-extended-description'&gt;#{description}&lt;/span&gt;&lt;span class='descriptious-ellipsis'&gt;...&lt;/span&gt;"}.join(" ") + "&lt;/span&gt;" 
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
  if line =~ /<description>/ and in_item_tag
    # Make the somewhat brittle assumption that description is all on one line. 
    # Starting with Descriptious 1.4, we are going to eliminate the original description, 
    # as it often a repeat of the title. [Jon Aquino 2005-05-29]
    line = "<description>#{extended_descriptions(last_link)}</description>"
  end
  puts line
}
