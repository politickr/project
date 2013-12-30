<?php  
        print("<div class=\"row\">");
        print("<div class=\"col-md-4\">");
        print("<a href=\"display.php?id={$Congressmen[0]["person"]["id"]}\"><img src=\"{$Congressmen[0]["photoUrl"]}\"  height=\"200\" width=\"180\"></a><br>");
        print("<a href=\"display.php?id={$Congressmen[0]["person"]["id"]}\">{$Congressmen[0]["person"]["firstname"]} {$Congressmen[0]["person"]["lastname"]}</a><br>");
        print("{$Congressmen[0]["description"]}<br>");       
        print("{$Congressmen[0]["party"]}"); 
        print("</div>");  

        print("<div class=\"col-md-4\">");
        print("<a href=\"display.php?id={$Congressmen[1]["person"]["id"]}\"><img src=\"{$Congressmen[1]["photoUrl"]}\"  height=\"200\" width=\"180\"></a><br>");
        print("<a href=\"display.php?id={$Congressmen[1]["person"]["id"]}\">{$Congressmen[1]["person"]["firstname"]} {$Congressmen[1]["person"]["lastname"]}</a><br>");
        print("{$Congressmen[1]["description"]}<br>");       
        print("{$Congressmen[1]["party"]}"); 
        print("</div>");   

        print("<div class=\"col-md-4\">");
        print("<a href=\"display.php?id={$Congressmen[2]["person"]["id"]}\"><img src=\"{$Congressmen[2]["photoUrl"]}\"  height=\"200\" width=\"180\"></a><br>");
        print("<a href=\"display.php?id={$Congressmen[2]["person"]["id"]}\">{$Congressmen[2]["person"]["firstname"]} {$Congressmen[2]["person"]["lastname"]}</a><br>");
        print("{$Congressmen[2]["description"]}<br>");       
        print("{$Congressmen[2]["party"]}");    
        print("</div>");   
        print("</div>");      
  
  print("<div>");
  print("<a href=\"search.php\">Back</a>");
  print("</div>");
      
        
?>
