<div>
<?php
    print("<div class=\"row\">");
    print("Title: <br> {$billinfo["title"]}");
    print("</div>");    
 
    print("<div class=\"row\">");
    print("Summary: <br> {$billinfo["summary"]}");
    print("</div>");
    
    print("<div class=\"row\">");
    print("$totalplusbill In Favor");    
    print("</div>");
    
    print("<div class=\"row\">");
    print("$totalminusbill Opposed");
    print("</div>");
    
    print("<div class=\"row\">");
    print("$totalotherbill Other");
    print("</div>");
	
	print("<div class=\"row\">");
    print("Current Status: <br> {$billinfo["current_status_date"]}:{$billinfo["current_status_label"]}:{$billinfo["current_status_description"]}");
    print("</div>");
	
	print("<div class=\"row\">");
    print("Alive?: <br> {$billinfo["is_alive"]}");
    print("</div>");

    
    print("<div class=\"row\">");
    print("<a href = {$billinfo["thomas_link"]}>Link</a>");
    print("</div>");
    
?>
</div>
