
var container = d3.select('#votefeed-column').append('div')
    					.attr('id','container')
						.style("overflow-y", "scroll");
var userY = userVotes.Y;
var userN = userVotes.N;
	
function update(num) {
	
	
	
	// Put PHP array of votes into javascript variable
	
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
	
	container.select("svg")
				.remove();
	
	var svg = container.append("svg")
				.attr("width", 650)
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
			.attr("class", "vote-anchor")
			.on("click", function(d, i) {
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
				
	
	a.append("rect")
				.attr("width", 650)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("id", "rect-background");
				
	a.append("rect")
				.attr("class", "vote")
				.attr("width", 60)
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
					});
	
					
	
	a.append("text")
				.attr("id", "month")
				.attr("x", 5)
				.attr("y", function(d, i) {
					return i * 105 + 50;
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
				.style("color", "#FFFFFF");
				
	a.append("text")
				.attr("id", "year")
				.attr("x", 5)
				.attr("y", function(d, i) {
					return i * 105 + 70;
				})
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					
					return year;
					})
				.style("color", "#FFFFFF");
				
	a.append("rect")
				.attr("width", 50)
				.attr("height", 100)
				.attr("x", 60)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("fill", "#EEE");
					
					
	var aUpvote = g.append("a")
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
		.attr("y", function(d, i) {
			return 105 * i + 10;
		})
    	.attr("width", 30)
    	.attr("height", 30);
			
	var aDownvote = g.append("a")
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
		.attr("y", function(d, i) {
			return 105 * i + 60;
		})
    	.attr("width", 30)
    	.attr("height", 30);
					
				
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
	
	
	if (browser != "msie" && browser != "Netscape") {	
		a.append("foreignObject")
				.attr("id", "votefeedtitle")
				.attr("x", 120) 
				.attr("y", function(d, i) {
						return i * 105;
					})
				.attr("width", 510)
				.attr("height", 100)
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					})
				.style("font-size", 16)
				.style("color", "#000");
				
				
				
				
	} else if (browser == "Netscape") {
		
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 21;
			})
			.attr("width", 510)
			.attr("height", 21)
			.text(function(d, i) {
				var l = d.vote.question.length;
				
				if (l < 40) {
					return d.vote.question;
				} else {
					var s = d.vote.question.substring(0, 40);
					var index = s.lastIndexOf(" ");
					return s.substring(0, index);
				}
			})
			.style("font-size", 16);
			
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 42;
			})
			.attr("width", 510)
			.attr("height", 21)
			.text(function(d, i) {
				var l = d.vote.question.length;
				
				if (l >= 40) {
					var prev = d.vote.question.substring(0, 40);
					var indexPrev = prev.lastIndexOf(" ");
					if (l < 80) {
						return d.vote.question.substring(indexPrev, 80);
					} else {
						var s = d.vote.question.substring(0, 80);
						var index = s.lastIndexOf(" ");
						return d.vote.question.substring(indexPrev, index);
					}
				} 
				return "";
			})
			.style("font-size", 16);
			
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 63;
			})
			.attr("width", 510)
			.attr("height", 21)
			.text(function(d, i) {
				if (d.vote.question.length >= 80) {
					var prev = d.vote.question.substring(0, 80);
					var index1 = prev.lastIndexOf(" ") + 1;
					return d.vote.question.substring(index1, 120) + "...";
				}
				return "";
			})
			.style("font-size", 16);
			
	}
}// JavaScript Document