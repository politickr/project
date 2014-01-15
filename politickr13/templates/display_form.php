<body>
<?php $reps = query("SELECT firstname,lastname, photourl FROM representatives WHERE govtrackid = ?", $_GET['id']);?>
<h1 class="text-center"><?php echo ($reps[0]['firstname']." ".$reps[0]['lastname']."'s ");?>Votefeed</h1>
	<div class="col-lg-12 text-center rep">
		<img src="<?php echo $reps[0]['photourl']?> "width='150px'> 
	</div>
<h4 class="text-center">Green is Yea, Red is Nay</h4>

<script type="text/javascript">

	//Detect browser version (different behavior for IE)
	
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
	// Put PHP array of votes into javascript variable
	var data = <?php echo $votes ?>;
	var userVotes = <?php 
		if (isset($_SESSION["user_split_votes"])) {
			echo json_encode($_SESSION["user_split_votes"]);
		} else {
			$tempsplitVotes = array("Y" => array(), "N" => array());
	  
	  
	  		foreach($_SESSION["user_votes"] as $key => $val) {
		  		if (strcmp($val, "Y") == 0) {
		  			array_push($tempsplitVotes["Y"], $key);
		  		} else {
					array_push($tempsplitVotes["N"], $key);
		  		}
	  		}
			
			$_SESSION["user_split_votes"] = $tempsplitVotes;
			echo json_encode($tempsplitVotes);
		}
		?>;
	
	var userY = userVotes.Y;
	var userN = userVotes.N;	
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
	
	//creates a giant SVG of the rep voting record
	var container = d3.select('body').append('div')
    .attr('id','container')
	.style("overflow-y", "scroll");
	
	
	
	var svg = container.append("svg")
				.attr("width", 900)
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
			.attr("xlink:href", function(d, i) {
					return "bill.php?id=" + d.vote.related_bill
										+ "&totalplusbill=" + d.vote.total_plus
										+ "&totalminusbill=" + d.vote.total_minus
										+ "&totalotherbill=" + d.vote.total_other;
				});
				
	
	a.append("rect")
				.attr("width", 900)
				.attr("height", 100)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("x", 0)
				.attr("id", "rect-background");
				
	a.append("rect")
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
					});
	
					
	
	a.append("text")
				.attr("id", "month")
				.attr("x", 20)
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
				.style("font-size", 18)
				.style("color", "#FFFFFF");
				
	a.append("text")
				.attr("id", "year")
				.attr("x", 20)
				.attr("y", function(d, i) {
					return i * 105 + 70;
				})
				.text(function(d, i) {
					var date = d.created;
					var year = date.substring(0, 4);
					
					return year;
					})
				.style("font-size", 20)
				.style("color", "#FFFFFF");
				
	a.append("rect")
				.attr("width", 180)
				.attr("height", 100)
				.attr("x", 720)
				.attr("y", function(d, i) {
					return i * 105;
				})
				.attr("fill", "#EEE");
					
					
	var aUpvote = g.append("a")
				.on("click", function(d, i) {
					d3.text("uservote.php?id=" + d.vote.id + "&op=Y", function() {
						console.log("upvote for " + d.vote.id);
						});
						
					d3.select("#up" + d.vote.id)
						.style("opacity", 1);
						
					d3.select("#down" + d.vote.id)
						.style("opacity", .25);
				});
					
				
	aUpvote.append("circle")
				.attr("id", function(d, i) {
					return "up" + d.vote.id;
				})
				.attr("class", "support-vote")
				.attr("cx", 780)
				.attr("r", 20)
				.attr("cy", function(d, i) {
					return i * 105 + 50;
				})
				.attr("fill", "#00F100");
	
	var aDownvote = g.append("a")
				.on("click", function(d, i) {
					d3.text("uservote.php?id=" + d.vote.id + "&op=N", function() {
						console.log("downvote for " + d.vote.id);
						});
						
					d3.select("#down" + d.vote.id)
						.style("opacity", 1);
						
					d3.select("#up" + d.vote.id)
						.style("opacity", .25);
				});
				
	aDownvote.append("circle")
				.attr("class", "oppose-vote")
				.attr("id", function(d, i) {
					return "down" + d.vote.id;
				})
				.attr("cx", 840)
				.attr("r", 20)
				.attr("cy", function(d, i) {
					return i * 105 + 50;
				})
				.attr("fill", "#F10000");
				
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
				.attr("width", 600)
				.attr("height", 100)
				.text(function(d, i) {
					var q = d.vote.question;
					return q;
					})
				.style("font-size", 20)
				.style("color", "#000");
				
				
				
				
	} else if (browser == "Netscape") {
		
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 21;
			})
			.attr("width", 600)
			.attr("height", 21)
			.text(function(d, i) {
				var l = d.vote.question.length;
				
				if (l < 60) {
					return d.vote.question;
				} else {
					var s = d.vote.question.substring(0, 60);
					var index = s.lastIndexOf(" ");
					return s.substring(0, index);
				}
			})
			.style("font-size", 20);
			
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 42;
			})
			.attr("width", 600)
			.attr("height", 21)
			.text(function(d, i) {
				var l = d.vote.question.length;
				
				if (l >= 60) {
					var prev = d.vote.question.substring(0, 60);
					var indexPrev = prev.lastIndexOf(" ");
					if (l < 100) {
						return d.vote.question.substring(indexPrev, 100);
					} else {
						var s = d.vote.question.substring(0, 100);
						var index = s.lastIndexOf(" ");
						return d.vote.question.substring(indexPrev, index);
					}
				} 
				return "";
			})
			.style("font-size", 20);
			
		a.append("text")
			.attr("id", "vote-title")
			.attr("x", 120)
			.attr("y", function(d, i) {
				return i * 105 + 63;
			})
			.attr("width", 600)
			.attr("height", 21)
			.text(function(d, i) {
				if (d.vote.question.length >= 100) {
					var prev = d.vote.question.substring(0, 100);
					var index1 = prev.lastIndexOf(" ") + 1;
					return d.vote.question.substring(index1, 160);
				}
				return "";
			})
			.style("font-size", 20);
			
	}
	</script>
</body>

