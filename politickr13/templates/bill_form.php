
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
	var data = <? echo billNews($billinfo['title']) ?>;
	var moddata = data.d.results;
	 
	var svgHeight = moddata.length * 105;
	
	var container = d3.select('.news-feed').append('div')
    .attr('id','news-container');
	
	
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
				
	var a = g.append("a")
			.attr("xlink:href", function(d, i) {
					return d.Url;
				});

				
	a.append("rect")
				.attr("width", 450)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("fill", "#CCCCCC");
				
	a.append("rect")
				.attr("class", "vote")
				.attr("width", 100)
				.attr("height", 100)
				.attr("x", 0)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("fill", "#666666");
					
	a.append("foreignObject")
				.attr("class", "newsfeed-source")
				.attr("x", 5)
				.attr("y", function(d, i) {
						return i * 105;
					})
				.attr("width", 90)
				.attr("height", 100)
				.text(function(d, i) {
						return d.Source;
					})
				.style("font-size", 16)
				.style("font-weight", "bold")
				.style("color", "#FFFFFF");
	
	a.append("foreignObject")
				.attr("x", 110)
				.attr("y", function(d, i) {
						return i * 105;
					})
				.attr("width", 300)
				.attr("height", 20)
				.text(function(d, i) {
					return d.Title;
					})
				.style("font-size", 12)
				.style("text-align", "left")
				.style("font-weight", "bold")
				.style("color", "#666666");
				
	a.append("foreignObject")
				.attr("x", 120)
				.attr("y", function(d, i) {
						return i * 105 + 20;
					})
				.attr("width", 300)
				.attr("height", 70)
				.text(function(d, i) {
					return d.Description;
				})
				.style("font-size", 12)
				.style("text-align", "left")
				.style("overflow-y", "scroll");
				
		
	</script>
        </div>
        </div>
</div>
