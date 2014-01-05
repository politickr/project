
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

<script type="text/javascript">
	// Put PHP array of votes into javascript variable
	var data = <?php echo $votes ?>;
	var datatwo = data.objects;
	 
	
	// Declare new array to put filtered votes in
	var moddata = [];
	// Put passage bills in moddata by checking category value
	for(i=0; i<datatwo.length; i++)
	{
		if(datatwo[i].vote.category == 'passage')
		{
			moddata.push(datatwo[i]);
		}
	}
	
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
	
	var svg = d3.select("body").append("svg")
				.attr("height", 3000)
				.attr("width", 800)
				.attr("viewBox", "0 0 2000 2000")
				.style("margin-left", 200);
				
	var g = svg.selectAll("g")
    .data(data)
  .enter().append("g")
    .attr("transform", function(d) { return "translate(0," + i * 10 + ")"; });

	
	g.append("rect")
				.attr("width", 1500)
				.attr("height", 300)
				.attr("y", function(d, i) {
					return i * 305;
				})
				.attr("x", 20)
				.attr("fill", "#BBBBBB");
				
	g.append("rect")
				.attr("width", 200)
				.attr("height", 300)
				.attr("x", 20)
				.attr("y", function(d, i) {
					return i * 305;
				})
				.attr("fill", function(d, i) {
					if (d.option.value == "Yea") {
						return "#00F100";
						}
					return "#F10000";
					});
					
	/*
	svg.selectAll(".date")
				.data(moddata)
				.enter()
				.attr("width", 200)
				.attr("height", 300)
				.attr("x", 20)
				.attr("y", function(d, i) {
					return i * 305;
				})
				.append("foreignObject")
				.style("color", "#FFFFFF")
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
				.attr("href", function(d, i) {
					return "bill.php?bill=" + d.vote.related_bill;
				})
				.attr("x", 100) 
				.attr("y", 20)
				.attr("width", 600)
				.attr("height", 80)
				.style("font-weight", "thick")
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					});	*/
					
	</script>
</body>

