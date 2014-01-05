
<?php
	
    //prints headers
	/*
    print("<tr>");
	print("<th>Date</th>");
    print("<th>Question</th>");
    print("<th>Ballot</th>");
    print("</tr>");
    
    //prints values for each position
    foreach($votes as $vote)
    {
    	if( strcmp($vote['vote']['category'], "passage") == 0)
    	{
        	print("<tr>");
			print("<td>{$vote["created"]}</td>");
        	print("<td><a href=\"bill.php?bill={$vote["vote"]["related_bill"]}&totalplusbill={$vote["vote"]["total_plus"]}&totalminusbill={$vote["vote"]["total_minus"]}&totalotherbill={$vote["vote"]["total_other"]}\">{$vote["vote"]["question"]}</a></td>");
        	print("<td>{$vote["option"]["value"]}</td>");
        	print("</tr>");
    	}
    }
    */
?>


<body>
<script type="text/javascript">
	var data = <?php echo $votes ?>;
	var dataset = data.objects;
			d3.select("body").selectAll("p")
				.data(dataset)
				.enter()
				.append("p")
				.text(function(d) { return d; });
			
	</script>
</body>

