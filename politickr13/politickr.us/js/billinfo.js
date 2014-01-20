// JavaScript Document<script>

var contentContainer = d3.select('#news-column').append('div')
						.attr("class", "content-container");
						
var menu = contentContainer.append("div")
						.attr("class", "row menu-margin")
						.attr("id", "bill-menu")
						.style("background-color", "#CCC")
						.style("height", "50px")
						.style("width", "100%");

						
var billcontainer = contentContainer.append("div")
						.attr("class", "bill-container")
						.attr("id", "bill-container")
						.style("overflow-y", "scroll")
						.style("max-height", "600px");
						

var newsdiv = billcontainer.append("div")
							.attr("class", "newsdiv")
							.style("display", "none")
							.data(info);
							
					
var billdiv = billcontainer.append("div")
							.attr("class", "billdiv")
							.data(info);
						
function updateBillInfo(i) {
	
	
	var info = [$.parseJSON(i)];
	console.log(info);
	
	billcontainer.remove();
	menu.remove();
	
	menu = contentContainer.append("div")
						.attr("class", "row menu-margin")
						.attr("id", "bill-menu")
						.style("background-color", "#CCC")
						.style("height", "25px")
						.data(info);
	
	billcontainer = contentContainer.append("div")
						.attr("class", "bill-container")
						.attr("id", "bill-container")
						.style("overflow-y", "scroll")
						.style("max-height", "600px");
						
	billcontainer.style("opacity", 1);
	
	newsdiv = billcontainer.append("div")
							.attr("class", "newsdiv")
							.style("display", "none")
							.data(info);
	
	billdiv = billcontainer.append("div")
							.attr("class", "billdiv")
							.data(info);
							
	var infobutton = menu.append("button")
						.attr("class", "col-xs-2 infobutton")
						.on("click", function(d, i) {
							
							$(".newsdiv").fadeTo("fast", 0);
							$(".newsdiv").css({"display": "none"});
							$(".billdiv").css({"display": "block"});
							$(".billdiv").fadeTo("fast", 1);
							$(".newsbutton").fadeTo("fast", .5);
							$(".infobutton").fadeTo("fast", 1);
							
						})
						.style("background-color", "transparent")
						.style("border", "none")
						.text("INFO");		
	
	var newsbutton = menu.append("button")
						.attr("class", "col-xs-2 newsbutton")
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
								
								$(".billdiv").fadeTo("fast", 0);
								$(".billdiv").css({"display": "none"});
								$(".newsdiv").css({"display": "block"});
								$(".newsdiv").fadeTo("fast", 1);
								$(".infobutton").fadeTo("fast", .5);
								$(".newsbutton").fadeTo("fast", 1);
								
								console.log("news ajax called");
						})
						.style("background-color", "transparent")
						.style("border", "none")
						.text("NEWS");					
	
	billdiv.append("h3")
				.attr("class", "bill-info")
				.attr("id", "title")
				.append("text")
				.text(function(d, i) {
					return d.title;
					})
				.style("padding", "10px");
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "summary-title")
				.text("Summary")
				.style("padding", "10px");
				
	billdiv.append("h5")
				.attr("class", "bill-info")
				.attr("id", "summary")
				.text(function(d, i) {
					return d.summary;
					});
					
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "votes")
				.text(function(d, i) {
					return "In Favor: " + d.vote.total_plus
							+ "\nOpposed: " + d.vote.total_minus
							+ "\nOther: " + d.vote.total_other;
				})
				.style("padding", "10px");
	
	billdiv.append("h4")
				.attr("class", "bill-info")
				.attr("id", "status-title")
				.text("Current Status")
				.style("padding", "10px");
				
	billdiv.append("h5")
				.attr("class", "bill-info")
				.attr("id", "summary")
				.text(function(d, i) {
					return d.current_status_description;
					})
				.style("padding", "10px");
					
				
}

function showNews(i) {
		var info = $.parseJSON(i);
		console.log(info);
		billdiv.style("display", "none");
		
		newsdiv = billcontainer.append("div")
							.attr("class", "newsdiv")
							.style("overflow-y", "scroll");
		
		var moddata = info.d.results;
		
	if (browser != "msie" && browser != "Netscape") {
		
					
		var d = newsdiv.selectAll("div")
				.data(moddata)
				.enter()
				.append("div");
					
		var a = d.append("a")
				.attr("href", function(d, i) {
						return d.Url;
					});

		
		a.append("h4")
					.text(function(d, i) {
							console.log(d.Source);
							return d.Source;
						})
					.style("font-weight", "bold")
					.style("padding", "10px")
					.style("padding-top", "12px")
					.style("background-color", "#CCC");
		
		a.append("h3")
					.text(function(d, i) {
						return d.Title;
						})
					.style("text-align", "left")
					.style("font-weight", "bold")
					.style("color", "#666666")
					.style("padding", "7px");
					
		a.append("h5")
					.text(function(d, i) {
						return d.Description;
					})
					.style("text-align", "left")
					.style("overflow-y", "scroll")
					.style("padding", "7px");
					
				
	} else if (browser == "Netscape") {
		
		
		
	}
}
