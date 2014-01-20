
var outerContainer = d3.select('#votefeed-column').append("div")
						.attr("id", "outer-container")
						.attr("class", "outer-container");

outerContainer.append("div")
				.attr("class", "left-arrow");
				
						
var fixedContainer = outerContainer.append("div")
					.attr('id','fixed-container')
					.attr("class", "fixed-container")
					.style("float", "right")
					.style("overflow-y", "scroll");
					

					
var container = fixedContainer.append("div")
					.attr("id", "fade-container")
					.style("width", "100%");		
						
var userY = userVotes.Y;
var userN = userVotes.N;
	
function update(num) {
	
	
	// Put PHP array of votes into javascript variable
	container.selectAll(".row").remove();
	
	var data = temp[num];
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
	
			
	

	var rows = container.selectAll("div")
    		.data(moddata)
  			.enter()
  			.append("div")
			.attr("class", "row vote-row no-margin")
			.attr("id", function(d, i) {
				return "row" + i;	
			})
			.style("height", "110px");
		
				
	var svgColTemp = rows.append("div")
					.attr("class", "col-xs-3");
					
	var svgCol = svgColTemp.append("svg")
					.attr("width", 110)
					.attr("height", 100);
					
	var textColTemp = rows.append("a")
					.attr("class", "col-xs-9 textCol")
					.on("click", function(d, i) {
							highlightBill(i);
							$.ajax({
								url: 'bill.php',
								type: 'GET',
								data: { id: d.vote.related_bill,
										 totalplusbill: d.vote.total_plus,
										 totalminusbill: d.vote.total_minus,
										 totalotherbill: d.vote.total_other },
								success: function (data) {
									console.log(data);
									updateBillInfo(data);
								}
							});
							console.log("ajax called");
						});
						
	var textCol = textColTemp.append("div")
							.attr("height", "100px");
	/*
	a.append("rect")
				.attr("width", 650)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("id", "rect-background");
			*/
				
	svgCol.append("rect")
				.attr("class", "vote")
				.attr("width", 60)
				.attr("height", 100)
				.attr("x", 0)
				.attr("y", 0)
				.attr("fill", function(d, i) {
					if (d.option.value == "Yea") {
						return "#00F100";
						}
					return "#F10000";
					});
	
					
	
	svgCol.append("text")
				.attr("id", "month")
				.attr("x", 5)
				.attr("y", 45)
				.style("color", "#FFFFFF")
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					var month = date.substring(5, 7);
					var day = date.substring(8, 10);
					var hour = parseInt(date.substring(11, 13)) % 12;
					
					return months[month] + " " + day;
					})
				.style("color", "#FFFFFF");
				
	svgCol.append("text")
				.attr("id", "year")
				.attr("x", 5)
				.attr("y", 65)
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					
					return year;
					})
				.style("color", "#FFFFFF");
				
	svgCol.append("rect")
				.attr("width", 50)
				.attr("height", 100)
				.attr("x", 60)
				.attr("y", 0)
				.attr("fill", "#EEE");
			
					
					
	var aUpvote = svgCol.append("a")
				.on("click", function(d, i) {
					d3.text("uservote.php?id=" + d.id + "&op=Y", function() {
						console.log("upvote for " + d.id);
						});
						
					d3.select("#up" + d.id)
						.style("opacity", 1);
					
					userY.push("#" + d.id);
					
					var index = userN.indexOf("#" + d.id);
					if (index >= 0) {
						userN.splice(index, 1);
					}
						
					d3.select("#down" + d.id)
						.style("opacity", .25);
				});
					
	aUpvote.append("image")
		.attr("id", function(d, i) {
					return "up" + d.id;
				})
    	.attr("xlink:href","/img/smiley-face.svg")
		.attr("class", "support-vote")
		.attr("x", 70)
		.attr("y", 10)
    	.attr("width", 30)
    	.attr("height", 30)
		.style("opacity", .25);
			
	var aDownvote = svgCol.append("a")
				.on("click", function(d, i) {
					d3.text("uservote.php?id=" + d.id + "&op=N", function() {
						console.log("downvote for " + d.id);
						});
						
					d3.select("#down" + d.id)
						.style("opacity", 1);
						
					userN.push("#" + d.id);
					
					var index = userY.indexOf("#" + d.id);
					if (index >= 0) {
						userY.splice(index, 1);
					}
						
					d3.select("#up" + d.id)
						.style("opacity", .25);
				});
				
	aDownvote.append("image")
		.attr("id", function(d, i) {
					return "down" + d.id;
				})
    	.attr("xlink:href","/img/frown-face.svg")
		.attr("class", "oppose-vote")
		.attr("x", 70)
		.attr("y", 60)
    	.attr("width", 30)
    	.attr("height", 30)
		.style("opacity", .25);
					
				
	for (var i = 0; i < userY.length; i++) {
			var s = userY[i];
			d3.select("#up" + s.substring(1, s.length))
				.style("opacity", 1);
	}
	
	for (var i = 0; i < userN.length; i++) {
			var s = userN[i];
			d3.select("#down" + s.substring(1, s.length))
				.style("opacity", 1);
	}
	
	textCol.append("h4")
			.text(function(d, i) {
				return d.vote.question;
			})
			.style("max-height", "100px");
			
	
}
var curSelectedRow = "#0";

function highlightBill(id) {
	
	var plus = id + 1;
	console.log("plus = " + plus);
	
	container.select("#row-fill").remove();
	container.select("#row-selected")
				.attr("id", curSelectedRow); 
	
	/*container.insert("div", "#row" + plus)
				.attr("class", "row vote-row no-margin")
				.attr("id", "row-fill")
				.style("height", "115px");*/
	
	var r = d3.select("#row" + id)
				.attr("id", "row-selected");
	
	console.log("r = " + r);
	curSelectedRow = "row" + id;
}



// JavaScript Document