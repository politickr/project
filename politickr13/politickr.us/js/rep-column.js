
			
			var container = d3.select('#rep-column').append('div')
    			.attr('id','my-reps-container');
	
			var g = container.selectAll("div")
    			.data(data)
  				.enter()
  				.append("div")
				.style("width", "100%")
				.style("height", "30%")
				.style("margin-top", "10%")
				.style("border", "solid 5px")
				.style("border-radius", "5px")
				.style("border-color", function(d, i) {
					if (d.party == "Democrat") {
						return "#0064FF";
					} else if (d.party == "Republican") {
						return "#C00";
					} 
					return "#CCC";
				});
			
			var a = g.append("a")
				.attr("class", "rep-anchor")
				.on("click", function(d, i) {
					$("#fade-container").fadeTo("fast", 0);
					update(i);
					$("#fade-container").fadeTo("slow", 1);
					
					d3.select(".left-arrow")
  					.style("margin-top", function() {
						if (i == 0) {
							return '5%';
						} else if (i == 1) {
							return '45%';	
						} 
						return '85%';
					});
				})
				.style("width", "100%")
				.style("height", "100%");
				
				
				
			a.append("img")
				.attr("class", "rep-img")
				.attr("src", function(d, i) {
					return d.photourl;	
				})
				.attr("height", 120)
				.attr("width", 100)
				.style("margin-top", "10%");
			
			
			a.append("div")
				.text(function(d, i) {
					return d.firstname + " " + d.lastname;
				})
				.style("font-weight", "bold");
				
				
			a.append("div")
				.text(function(d, i) {
					if (d.district != "0") {
						return "Representative for";
					}
					var level = d.description.substring(0, 
									d.description.indexOf(" "));
					return level + " " + "Senator";
				})
				.style("font-size", 12);
			
			
			a.append("div")
				.text(function(d, i) {
					if (d.district != "0") {
						return "District " + d.district + ", " + d.state;
					}
					var state = d.description.substring(d.description.lastIndexOf(" "));
					return "from " + state;
				})
				.style("font-size", 12);
				
	
				