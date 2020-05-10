#!/usr/local/bin/ruby
rss = "http://populicio.us/newlinks.rss"
rss = ARGV[0] if ARGV.length > 0
require "net/http"
require "rexml/document"
include REXML

doc = Document.new(Net::HTTP.get(URI.parse(rss)))
XPath.each(doc, "/*/channel") { |channel|
  puts <<-HERE<html>
                <head>
                  <title>Bloglines Splicer</title>
                  <link rel="stylesheet" type="text/css" href="/mystyle.css" />
                  <style type="text/css" media="all">
                  .item-title {
                    font-weight: bold;
                    font-size: medium;
                  }
                  .unsubscribe {
                    font-style: italic;
                    font-size: x-small;
                  }
                  </style>
                </head>
                <body>'
#      items_grouped_by_feed << channel.elements.find_all{|child|child.name=="item"}.collect { |item|
#        item_link = item.text('link') == nil ? "" : item.text('link')
#        channel_link = channel.text('link') == nil ? "" : channel.text('link')
#        "<span class='item-title'><a href=\"#{item_link}\">#{item.text('title')}</a></span><br>" +
#        "<span style='font-size:x-small'>#{channel.text('title')}</span> " +
#        "<span class='unsubscribe' style='margin-left:1cm'>Don't like this feed? <a class='unsubscribe' style='color:red' href='http://bloglines.com/myblogs_subs?removesub=#{feed_title_url_to_id_map[channel_link+channel.text('title')]}' target='_blank'>Unsubscribe.</a></span><br>" +
#        "#{item.text('description')}<br>"
#     }
}


<<QQQ
<%
begin
%>
  <h1>Bloglines Splicer</h1>
  <span style="font-size:x-small"><a href="http://jonaquino.blogspot.com/2005/04/bloglines-splicer-improvement-on.html">About Bloglines Splicer</a> | <a href="http://jonaquinolabs.blogspot.com">Jon Aquino Labs</a></span><br><br>
<%
  require "cgi"
  require "cgi/session"
  cgi = CGI.new
  session = nil
  if cgi["_session_id"] == ""
    session = CGI::Session.new(cgi, "new_session" => true)
    session["username"] = cgi["username"]
    session["password"] = cgi["password"]
  else
    session = CGI::Session.new(cgi, "session_id" => cgi["_session_id"], "new_session" => false)
  end

  require 'net/http'
  def get(address, path, username, password)
    Net::HTTP.start(address) { |http|
      req = Net::HTTP::Get.new(path)
      req.basic_auth username, password
      response = http.request(req).body
    }
  end

  require "rexml/document"
  include REXML

  def feed_title_url_to_id_map(username, password)
    feed_title_url_to_id_map = {}
    doc = Document.new(get("bloglines.com", "/listsubs", username, password))
    XPath.each(doc, "//outline") { |outline|
      next if outline.attributes["htmlUrl"] == nil
      feed_title_url_to_id_map[outline.attributes["htmlUrl"].to_s+outline.attributes["title"].to_s] = outline.attributes["BloglinesSubId"].to_s
    }
    feed_title_url_to_id_map
  end

  def items_grouped_by_feed(username, password)
    # The siteid returned by getitems doesn't always match the subscription id.
    # So produce a map of feed title+url to subscription id. There is room for
    # ambiguity, but that's the best we can do until Bloglines decides
    # to provide more information in their API [Jon Aquino 2005-04-18]
    feed_title_url_to_id_map = feed_title_url_to_id_map(username, password)
    items_grouped_by_feed = []

    items_grouped_by_feed
  end

  items = []
  if cgi["action"] == "mark_all_as_read"
    get("bloglines.com", "/getitems?s=0&n=1", session["username"], session["password"])
  else
    items_grouped_by_feed = items_grouped_by_feed(session["username"], session["password"])
    while not items_grouped_by_feed.empty?
      items_grouped_by_feed.each { |items_in_feed|
        items << items_in_feed.delete_at(0)
      }
      # Don't delete during call to #each -- unpredictable [Jon Aquino 2005-04-17]
      items_grouped_by_feed.delete([])
    end
  end
  i = 0
  items.each { |item|
    i += 1 
%>
  <table width='100%' cellspacing='0' cellpadding='0'>
    <tr bgcolor="<%=i%2==0?"#efefef":"#ffffff"%>"><td><br>
      <%=item%>
    </td></tr>
    <tr bgcolor="<%=i%2==0?"#efefef":"#ffffff"%>"><td align="right"><a href="splice.html?action=mark_all_as_read&_session_id=<%=session.session_id%>">
      I'm done. Mark all items as read.
    </a></td></tr>
  </table>
<%
  }
%>
  <% if items.empty? %>
    There aren't any unread items. You're all caught up!
    <form name="form" action="splice.rhtml?" method="GET">
      <input name="button" type="submit" value="Check for new items">
      <input name="_session_id" type="hidden" value="<%=session.session_id%>">
    </form>
    <script language="JavaScript">document.form.button.focus();</script>
  <% else %>
    <center>
    <br>
    <table bgcolor="#ffff99"><tbody><tr><td>All done? Remember to click <a href="splice.html?action=mark_all_as_read&_session_id=<%=session.session_id%>">I'm done. Mark all items as read.</a></td></tr></tbody></table>
    </center>
    <br>
  <% end %>
  <hr>
  Generated <%=Time.new%>
<%
rescue => e
%>
  <%="Exception: #{e.class}: #{e.message}\n\t#{e.backtrace.join("\n\t")}"%>
<%
end
%>
</body>
</html>
QQQ