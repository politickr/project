
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
<h1 class="text-center"> Votefeed</h1>
<h4 class="text-center">Green is Yea, Red is Nay</h4>

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
	
	var svgHeight = moddata.length * 105;
	
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
	
	var container = d3.select('body').append('div')
    .attr('id','container')
	.style("overflow-y", "scroll");
	
	
	var svg = container.append("svg")
				.attr("width", 720)
				.attr("height", svgHeight - 5);
				
	var g = svg.selectAll("g")
    		.data(moddata)
  			.enter()
  			.append("g")
    		.attr("x", 0)
			.attr("y", function(d, i) {
					return i * 105;
				});

	
	g.append("rect")
				.attr("width", 720)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("fill", "#BBBBBB")
				.on("click", function(d) {
					window.location = "bill.php?id=" + d.vote.related_bill
										+ "&totalplusbill=" + d.vote.total_plus
										+ "&totalminusbill=" + d.vote.total_minus
										+ "&totalotherbill=" + d.vote.total_other;
				});
				
	g.append("rect")
				.attr("class", "vote")
				.attr("width", 100)
				.attr("height", 100)
				.attr("x", 0)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("fill", function(d, i) {
					if (d.option.value == "Yea") {
						return "#00F100";
						}
					return "#F10000";
					})
				.on("click", function(d) {
					window.location = "bill.php?id=" + d.vote.related_bill
										+ "&totalplusbill=" + d.vote.total_plus
										+ "&totalminusbill=" + d.vote.total_minus
										+ "&totalotherbill=" + d.vote.total_other;
				});
					
	
	g.append("text")
				.attr("x", 20)
				.attr("y", function(d, i) {
					return i * 105 + 15;
				})
				.style("color", "#FFFFFF")
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					var month = date.substring(5, 7);
					var day = date.substring(8, 10);
					var hour = parseInt(date.substring(11, 13)) % 12;
					
					return months[month] + " " + day;
					})
				.style("font-size", 16)
				.on("click", function(d) {
					window.location = "bill.php?id=" + d.vote.related_bill
										+ "&totalplusbill=" + d.vote.total_plus
										+ "&totalminusbill=" + d.vote.total_minus
										+ "&totalotherbill=" + d.vote.total_other;
				});
				
	g.append("text")
				.attr("x", 20)
				.attr("y", function(d, i) {
					return i * 105 + 40;
				})
				.style("color", "#FFFFFF")
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					
					return year;
					})
				.style("font-size", 24)
				.on("click", function(d) {
					window.location = "bill.php?id=" + d.vote.related_bill
										+ "&totalplusbill=" + d.vote.total_plus
										+ "&totalminusbill=" + d.vote.total_minus
										+ "&totalotherbill=" + d.vote.total_other;
				});	
		
	g.append("foreignObject")
				.attr("x", 120) 
				.attr("y", function(d, i) {
						return i * 105;
					})
				.attr("width", 600)
				.attr("height", 100)
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					})
				.style("font-size", 20);	
					
	</script>
</body>

