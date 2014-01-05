
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
<h1> Votefeed: Green is Yea, Red is Nay</h1>
<?php 
$modvotes;
  foreach($votes as $vote)
    {
    	if( strcmp($vote['vote']['category'], "passage") == 0)
    	{
       `	$modvotes = 
    	}
    }
?>
<script type="text/javascript">
	// Put PHP array of votes into javascript variable
	var data = <?php echo $votes ?>;
	var datatwo = data.objects;
<<<<<<< HEAD
	
	var dataset = datatwo.slice(0, 25); 
	
=======
	// Declare new array to put filtered votes in
	var moddata;
	// Put passage bills in moddata by checking category value
	for(i=0; i<datatwo.length; i++)
	{
		if(datatwo[i]['vote']['category'] == ('passage'))
		{
			moddata.push(datatwo[i]['vote']['category']);
		}
	}
>>>>>>> 91e3aac9e7f06ec60270a2757f485c1c29301fc2
	months = [];
	months["01"] = "Jan";
	months["02"] = "Feb";
	months["03"] = "Mar";
	months["04"] = "Apr";
	months["05"] = "May";
	months["06"] = "Jun";
	months["07"] = "Jul";
	months["08"] = "Aug";
	months["09"] = "Sep";
	months["10"] = "Oct";
	months["11"] = "Nov";
	months["12"] = "Dec";
	
	var rectContainers = d3.select("body").selectAll("svg")
				.data(moddata)
				.enter()
				.append("svg")
				.attr("class", "vote")
				.attr("width", 720)
				.attr("height", 100)
				.attr("viewBox", "0 0 720 100")
				.style("background-color", "BBBBBB")
				.style("margin-left", "20%")
				.style("margin-top", 5);
				
				
				
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
				.attr("x", 100) 
				.attr("y", 20)
				.attr("width", 600)
				.attr("height", 80)
				.style("font-weight", "thick")
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					});	
	</script>
</body>

