// JavaScript Document<script>

var billcontainer = d3.select('#news-column').append('div')
    					.attr('id','bill-container')
						.style("overflow-y", "scroll")
						.style("max-height", "70%");
						
var billdiv = billcontainer.append("div")
							.attr("id", "billdiv");

function updateBillInfo(i) {
	
	
	var info = [$.parseJSON(i)];
	console.log(info);
	
	billcontainer.select("div").remove();
	
	billdiv = billcontainer.append("div")
							.data(info);
	
										
	
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