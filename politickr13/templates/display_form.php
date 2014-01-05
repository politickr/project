
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
	var datatwo = data.objects;
	dataset = datatwo.slice(0, 300);
	months = [];
	months["1"] = "Jan";
	months["2"] = "Feb";
	months["3"] = "Mar";
	months["4"] = "Apr";
	months["5"] = "May";
	months["6"] = "Jun";
	months["7"] = "Jul";
	months["8"] = "Aug";
	months["9"] = "Sep";
	months["10"] = "Oct";
	months["11"] = "Nov";
	months["12"] = "Dec";
	
	var rectContainers = d3.select("body").selectAll("svg")
				.data(dataset)
				.enter()
				.append("svg")
				.attr("class", "vote")
				.attr("width", 720)
				.attr("height", 100)
				.attr("viewBox", "0 0 720 100")
				.style("border", "solid")
				.style("border-radius", "5px");
				
	rectContainers.append("rect")
				.attr("width", 80)
				.attr("height", 100)
				.attr("fill", function(d, i) {
					if (d.option.value == "Yea") {
						return "#00F100";
						}
					return "#F10000";
					});
					
				
	rectContainers.append("text")
				.attr("fill", "#FFFFFF")
				.attr("transform", "matrix(1 0 0 1 16 72.1484)")
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					var month = date.substring(5, 7);
					var day = date.substring(8, 10);
					var hour = parseInt(date.substring(11, 13)) % 12;
					
					return months[month] + " " + day;
					});	
					
	rectContainers.append("foreignObject")
				.attr("x", 300) 
				.attr("y", 20)
				.attr("width", 400)
				.attr("height", 80)
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					});	
	</script>
</body>

