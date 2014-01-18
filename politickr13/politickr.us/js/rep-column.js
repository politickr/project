
			
			var container = d3.select('#rep-column').append('div')
    			.attr('id','my-reps-container');
	
			var svg = container.append("svg")
				.attr("width", 200)
				.attr("height", 735);
			
			var g = svg.selectAll("g")
    			.data(data)
  				.enter()
  				.append("g")
    			.attr("y", function(d, i) {
					return i * 245;
				})
				.attr("x", 0);
			
			var a = g.append("a")
				.attr("class", "rep-anchor")
				.on("click", function(d, i) {
					update(i);
					
					d3.select(".left-arrow")
  					.style("margin-top", function() {
						if (i == 0) {
							return '10%';
						} else if (i == 1) {
							return '40%';	
						} 
						return '75%';
					});
				});
				
				
			a.append("rect")
				.attr("width", 150)
				.attr("height", 220)
				.attr("y", function(d, i) {
					return i * 245 + 10;
				})
				.attr("x", 10)
				.attr("fill", "transparent")
				.style("stroke", function(d, i) {
					if (d.party == "Democrat") {
						return "#0064FF";
					} else if (d.party == "Republican") {
						return "#C00";	
					} 
					return "#CCC";
				})
				.style("stroke-linejoin", "round")
				.style("stroke-width", "5px");
				
				
			g.append("image")
				.attr("class", "rep-img")
				.attr("xlink:href", function(d, i) {
					return d.photourl;	
				})
				.attr("height", 100)
				.attr("width", 120)
				.attr("y", function(d, i) {
					return i * 245 + 30;
				})
				.attr("x", 25);
			
			
			a.append("text")
				.attr("x", 30)
				.attr("y", function(d, i) {
					return i * 245 + 150;
				})
				.attr("width", 150)
				.attr("height", 21)
				.text(function(d, i) {
					return d.firstname + " " + d.lastname;
				})
				.style("font-weight", "bold");
				
				
			a.append("text")
				.attr("x", 30)
				.attr("y", function(d, i) {
					return i * 245 + 181;
				})
				.attr("width", 150)
				.attr("height", 21)
				.text(function(d, i) {
					if (d.district != "0") {
						return "Representative for";
					}
					var level = d.description.substring(0, 
									d.description.indexOf(" "));
					return level + " " + "Senator";
				})
				.style("font-size", 12);
			
			
			a.append("text")
				.attr("x", 30)
				.attr("y", function(d, i) {
					return i * 245 + 202;
				})
				.attr("width", 150)
				.attr("height", 21)
				.text(function(d, i) {
					if (d.district != "0") {
						return "District " + d.district + ", " + d.state;
					}
					var state = d.description.substring(d.description.lastIndexOf(" "));
					return "from " + state;
				})
				.style("font-size", 12);
				
	
				