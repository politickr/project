<?php  
        print("<div class=\"row\">");
        
		foreach ( $repinformation as $reps)
		{
			print("<div class=\"col-md-4\">");
			print("<a href=\"display.php?id={$reps[0]["id"]}\"><img src=\"{$reps[0]["photourl"]}\"  height=\"200\" width=\"180\"></a><br>");
			print("<a href=\"display.php?id={$reps[0]["id"]}\">{$reps[0]["firstname"]} {$reps[0]["lastname"]}</a><br>");
			print("{$reps[0]["description"]}<br>");       
			print("{$reps[0]["party"]}"); 
			print("</div>");  
		}
        print("</div>");      
  
  print("<div>");
  print("<a href=\"search.php\">Back</a>");
  print("</div>");
      
        
?>
