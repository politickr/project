
<?php
/*
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
    */
?>
<body>
<div class="container">
	<div class="row">
        
    	
        <div class="col-lg-6 text-left">
        	<h2><? echo $billinfo['title'] ?></h2>
            <br />
            <h4>Summary</h4>
			<? echo $billinfo['summary'] ?>
            <br /> <br />
            <h4>Votes</h4>
            In Favor: <? echo $totalplusbill ?><br />
            Opposed: <? echo $totalminusbill ?> <br />
            Other: <? echo $totalotherbill ?> <br />
            <br /> <br />
            <h4>Current Status</h4>
            <div class="current-status">
                <? echo $billinfo['current_status_description'] ?><br />
            </div>
            <br />
            <a href = <? $billinfo['thomas_link']?>><h4>Link</h4></a>
            
		</div>
        
        <div class="col-lg-6 news-feed" id="news-feed">
            <h2 class="text-center">News</h2>
    <script>
	var data = {objects: [1,2,3,4,5]};
	var datatwo = data.objects;
	 
	
	// Declare new array to put filtered votes in
	var moddata = [1,2,3,4,5,6,7,1,1,1,1,1,1,1,1,1,1,1,1,1];
	// Put passage bills in moddata by checking category value
	/*
	for(i=0; i<datatwo.length; i++)
	{
		if(datatwo[i].vote.category == 'passage')
		{
			moddata.push(datatwo[i]);
		}
	}
	*/
	var svgHeight = moddata.length * 105;
	
	var container = d3.select('.news-feed').append('div')
    .attr('id','news-container')
	.style("overflow-y", "scroll");
	
	
	var svg = container.append("svg")
				.attr("width", 450)
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
				.attr("width", 450)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("fill", "#BBBBBB");
				
	g.append("rect")
				.attr("class", "vote")
				.attr("width", 100)
				.attr("height", 100)
				.attr("x", 0)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("fill", "#3CF");
					
	
				
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
				.style("font-size", 24);
				
				
	g.append("foreignObject")
				.attr("x", 120) 
				.attr("y", function(d, i) {
						return i * 105;
					})
				.attr("width", 300)
				.attr("height", 50)
				.text("This will eventually be a news story about the bill.")
				.style("font-size", 20);	
								
	</script>
        </div>
        </div>
</div>
