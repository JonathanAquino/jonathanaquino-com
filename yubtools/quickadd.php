<script language="javascript">
function init()
{
  var txtbox = document.getElementById("quickText");
  txtbox.focus();
}

function onkeypress(event)
{
  if(event.keyCode == 27) {
    close();
  } else if(event.keyCode == 13) {
    addEvent();
  }
}

function number_html(i) {
	var num = 16;
	var j ="";
	for(var n = 0; n < i.length; n++) {
		j += ("&#x"+(i.charCodeAt(n)).toString(num)+";");
	}
	return j;
}

function addEvent() {
 try {

   var txtbox = document.getElementById("quickText");
   var req = new XMLHttpRequest();
   req.open('GET', "http://www.google.com/calendar/compose?ctext=" + txtbox.value, false);
   req.send(null);
   keys = {};

   if(req.getResponseHeader('Content-type').indexOf("text/javascript") == -1) {
     alert("It seems that you are not logged in to Google Calendar. Please login and try again.");
     return;
   }

   req.getResponseHeader('Set-Cookie').split(";").map(function(e) { var x = e.split("="); keys[x[0]] = x[1];});

   if(!keys['CAL']) {
     alert("Failed to obtain authorization token to insert entry. Please contact the developer.");
     return;
   }

   var parsed = eval(req.responseText);
   if(!parsed || parsed.length != 1) {
     alert('Invalid Response from Google Calendar Quick Add service.');
     return;
   }

   var gstart = parsed[0][4];
   var gend = parsed[0][5];
   var gloc = parsed[0][3];
   var gtitle = parsed[0][1];

   var start = "";
   var end = ""; 
   var splitstart = gstart.split("T");
   var splitend = gend.split("T");
   var dateonly = false;
   if(splitstart.length == 2) {
     startdate = splitstart[0];
     starttime = splitstart[1];
     if(startdate.indexOf("??") > -1) {
       alert('Google Calendar Quick Add service returned no start date. You may have entered an invalid event description.');
       return;
     }

     if(starttime.indexOf("??") > -1) {
       gstart = startdate;	
       dateonly = true;
     }

     start = processDates(parseGoogleDate(gstart),dateonly);

   } else {
     alert('Google Calendar Quick Add service returned an invalid date.');
     return;
   }

   var HOUR = 60 * 60 * 1000;
   var DAY = 24 * HOUR;

   var guessedEndOffset = dateonly ? DAY : HOUR;
   
   if(splitend.length == 2) {
     enddate = splitend[0];
     endtime = splitend[1];
     if(enddate.indexOf("??") > -1) {
       end = processDates(new Date(parseGoogleDate(gstart).getTime() + guessedEndOffset), dateonly);
     } else if(endtime.indexOf("??") > -1) {
       end = processDates(parseGoogleDate(enddate), dateonly);
     } else {
       end = processDates(parseGoogleDate(gend), dateonly);       
     }
   } else {
     end = processDates(new Date(parseGoogleDate(gstart).getTime() + guessedEndOffset ), dateonly);
   }

   var entry = "<entry xmlns='http://www.w3.org/2005/Atom' xmlns:gd='http://schemas.google.com/g/2005'>";
     entry += "<category scheme='http://schemas.google.com/g/2005#kind' term='http://schemas.google.com/g/2005#event'></category>";
     entry += "<title type='text'>" + number_html(gtitle) + "</title>";
     entry += "<gd:when startTime='"+ start +"' endTime='" + end + "'></gd:when>";
     entry += "<gd:where valueString='" + number_html(gloc) +"'></gd:where>";
     entry += "</entry>";

   var req = new XMLHttpRequest();
   req.open('POST', "http://www.google.com/calendar/feeds/default/private/full", false);
   req.setRequestHeader('Authorization', 'GoogleLogin auth=' + keys['CAL']);
   req.setRequestHeader('Content-type','application/atom+xml');
   req.send(entry);

   if(req.status != 201) {
     alert("There was an error adding your event (Error "+ req.status + "). Please contact developer.");
     return;
   }
   reloadCalendar(); 
 } finally {
   close();
 }
} 

]]> 
</script>