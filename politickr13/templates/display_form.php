<div>
<table>
<?php
    //prints headers
    print("<tr>");
    print("<th>Question</th>");
    print("<th>Ballot</th>");
    print("</tr>");
    
    //prints values for each position
    foreach($votes as $vote)
    {
    	if( strcmp($vote['vote']['category'], "passage") == 0)
    	{
        	print("<tr>");
        	print("<td><a href=\"bill.php?bill={$vote["vote"]["related_bill"]}&totalplusbill={$vote["vote"]["total_plus"]}&totalminusbill={$vote["vote"]["total_minus"]}&totalotherbill={$vote["vote"]["total_other"]}\">{$vote["vote"]["question"]}</a></td>");
        	print("<td>{$vote["option"]["value"]}</td>");
        	print("</tr>");
    	}
    }
    


?>



</table>



</div>
