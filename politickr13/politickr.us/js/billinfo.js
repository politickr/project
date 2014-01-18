// JavaScript Document<script>

var billcontainer = d3.select('#news-column').append('div')
    					.attr('id','bill-container')
						.style("overflow-y", "scroll")
						.style("max-height", "70%");
						
var billdiv = billcontainer.append("div")
							.attr("id", "billdiv");
							
					
var newsdiv = billcontainer.append("div")
							.attr("id", "newsdiv")
							.style("display", "none");
						
function updateBillInfo(i) {
	
	
	var info = [$.parseJSON(i)];
	console.log(info);
	
	billcontainer.selectAll("div").remove();
	
	newsdiv = billcontainer.append("div")
							.attr("id", "newsdiv")
							.style("display", "none");
	
	billdiv = billcontainer.append("div")
							.attr("class", "billdiv")
							.data(info);
	
	var newsbutton = billdiv.append("button")
						.attr("x", 0)
						.attr("y", 0)
						.attr("width", 100)
						.attr("height", 50)
						.on("click", function(d, i) {
							  $.ajax({
								  url: 'bill_news.php',
								  type: 'GET',
								  data: { billTitle: function() {
									  	var s = d.title.substring(
										 		d.title.indexOf(":") + 2);
										return s;
								  }},
								  success: function (data) {
									  console.log(data);
									  showNews(data);
								  }
						  		});
								
								console.log("news ajax called");
						})
						.text("Show News");					
	
	billdiv.append("h3")
				.attr("class", "bill-info")
				.attr("id", "title")
				.append("text")
				.text(function(d, i) {
					return d.title;
					});
	
	billdiv.append("br");
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "summary-title")
				.attr("width", 400)
				.text("Summary");
				
	billdiv.append("h5")
				.attr("class", "bill-info")
				.attr("id", "summary")
				.attr("width", 400)
				.text(function(d, i) {
					return d.summary;
					});
					
	billdiv.append("br");
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "votes")
				.attr("width", 400)
				.text(function(d, i) {
					return "In Favor: " + d.vote.total_plus
							+ "\nOpposed: " + d.vote.total_minus
							+ "\nOther: " + d.vote.total_other;
				});
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "status-title")
				.attr("width", 400)
				.text("Current Status");
				
	billdiv.append("h5")
				.attr("class", "bill-info")
				.attr("id", "summary")
				.attr("width", 400)
				.text(function(d, i) {
					return d.current_status_description;
					});
					
				
}

function showNews(i) {
		var info = $.parseJSON(i);
		console.log(info);
		billdiv.style("display", "none");
		
		newsdiv = billcontainer.append("div")
							.attr("class", "newsdiv");
		
		var moddata = info.d.results;
		
	if (browser != "msie" && browser != "Netscape") {
		
					
		var d = newsdiv.selectAll("div")
				.data(moddata)
				.enter()
				.append("div");
					
		var a = d.append("a")
				.attr("xlink:href", function(d, i) {
						return d.Url;
					});

	
		/*
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
					*/
						
		a.append("h4")
					.attr("class", "newsfeed-source")
					.text(function(d, i) {
							return d.Source;
						})
					.style("font-weight", "bold")
					.style("color", "#FFFFFF");
		
		a.append("h3")
					.text(function(d, i) {
						return d.Title;
						})
					.style("text-align", "left")
					.style("font-weight", "bold")
					.style("color", "#666666");
					
		a.append("h5")
					.text(function(d, i) {
						return d.Description;
					})
					.style("text-align", "left")
					.style("overflow-y", "scroll");
					
		d.append("br");
				
	} else if (browser == "Netscape") {
		
		
		
	}
}