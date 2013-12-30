<div>
<table>
<?php
    $votes = getVotes()
    
    //prints headers
    print("<tr>");
    print("<th>Question</th>");
    print("<th>Ballot</th>");
    print("</tr>");
    
    //prints values for each position
    foreach($votes as $vote)
    {
        print("<tr>");
        print("<td>{$vote["vote"]["question"]}</td>");
        print("<td>{$vote["option"]["value"]}</td>");
        print("</tr>");
    }



?>



</table>



</div>
