
<body>
<div class="container">
	<div class="row">
        
    	
        <div class="col-xs-6 text-left">
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
            <a href = <? echo $billinfo['thomas_link']?>><h4>Go to the bill's Library of Congress page</h4></a>
            
		</div>
        
        <div class="col-xs-6 news-feed" id="news-feed">
            <h2 class="text-center">News</h2>
    <script>
	
	function get_browser() {
    	var N=navigator.appName, ua=navigator.userAgent, tem;
    	var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    	if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    	M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
    	return M[0];
    }
	
	function get_browser_version() {
    	var N=navigator.appName, ua=navigator.userAgent, tem;
    	var M=ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
    	if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
    	M=M? [M[1], M[2]]: [N, navigator.appVersion, '-?'];
    	return M[1];
    }
	
	var browser = get_browser();
	
	<? $searchStr = explode(":", $billinfo['title']); ?>
	var data = <? echo billNews($searchStr[1]) ?>;
	var moddata = data.d.results;
	if (browser != "msie" && browser != "Netscape") {
		
		var svgHeight = moddata.length * 210;
		
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
						return i * 210;
					});
					
		var a = g.append("a")
				.attr("xlink:href", function(d, i) {
						return d.Url;
					});

	
		
		a.append("rect")
					.attr("width", 450)
					.attr("height", 205)
					.attr("y", function(d, i) {
						return i * 210;
					})
					.attr("x", 0)
					.attr("fill", "#CCCCCC");
					
		a.append("rect")
					.attr("class", "news")
					.attr("width", 100)
					.attr("height", 205)
					.attr("x", 0)
					.attr("y", function(d, i) {
						return i * 210;
					})
					.attr("fill", "#666666");
						
		a.append("foreignObject")
					.attr("class", "newsfeed-source")
					.attr("x", 5)
					.attr("y", function(d, i) {
							return i * 210;
						})
					.attr("width", 90)
					.attr("height", 200)
					.text(function(d, i) {
							return d.Source;
						})
					.style("font-size", 16)
					.style("font-weight", "bold")
					.style("color", "#FFFFFF");
		
		a.append("foreignObject")
					.attr("x", 110)
					.attr("y", function(d, i) {
							return i * 210;
						})
					.attr("width", 300)
					.attr("height", 40)
					.text(function(d, i) {
						return d.Title;
						})
					.style("font-size", 16)
					.style("text-align", "left")
					.style("font-weight", "bold")
					.style("color", "#666666");
					
		a.append("foreignObject")
					.attr("x", 120)
					.attr("y", function(d, i) {
							return i * 210 + 50;
						})
					.attr("width", 300)
					.attr("height", 160)
					.text(function(d, i) {
						return d.Description;
					})
					.style("font-size", 14)
					.style("text-align", "left")
					.style("overflow-y", "scroll");
				
	} else if (browser == "Netscape") {
		
		var svgHeight = moddata.length * 75;
		
		var container = d3.select('.news-feed').append('div')
		.attr('id','news-container');
		
		
		var svg = container.append("svg")
					.attr("width", 465)
					.attr("height", svgHeight - 5);
					
					
		var g = svg.selectAll("g")
				.data(moddata)
				.enter()
				.append("g")
				.attr("x", 0)
				.attr("y", function(d, i) {
						return i * 210;
					});
					
		var a = g.append("a")
				.attr("xlink:href", function(d, i) {
						return d.Url;
					});

		a.append("rect")
					.attr("width", 450)
					.attr("height", 70)
					.attr("y", function(d, i) {
						return i * 75;
					})
					.attr("x", 0)
					.attr("fill", "#CCCCCC");
					
		a.append("rect")
					.attr("class", "news")
					.attr("width", 450)
					.attr("height", 25)
					.attr("x", 0)
					.attr("y", function(d, i) {
						return i * 75;
					})
					.attr("fill", "#00CCFF");
					
		a.append("text")
					.attr("id", "news-source")
					.attr("x", 20)
					.attr("y", function(d, i) {
						return i * 75 + 20;
					})
					.attr("width", 430)
					.attr("height", 25)
					.text(function(d, i) {
						return d.Source;
					})
					.style("font-size", 16);
			
		a.append("text")
					.attr("id", "news-title")
					.attr("x", 40)
					.attr("y", function(d, i) {
						return i * 75 + 50;
					})
					.attr("width", 410)
					.attr("height", 21)
					.text(function(d, i) {
						return d.Title;
					})
					.style("font-size", 20);
		
	}
	</script>
        </div>
        </div>
</div>
