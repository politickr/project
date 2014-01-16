<h1 class="text-center">My Representatives</h1>
<?php  
		print('<script src=/js/reps.js>');
		print('</script>');
        print('<div class="row">');
		print('<div class="col-lg-2">');
		print('</div>');
		print('<div class="col-lg-8">');
		
		
		$i = 0;
		foreach ( $repinformation as $reps)
		{
			print('<script>');
			echo 'repObj['.$i.']='.$reps[0].';';
			print('</script>');
			print('<div class="col-lg-4 text-center rep">');
			print("<a href='display.php?id=".$reps[0]['govtrackid']."'><img src=".$reps[0]['photourl']." width='120px' height='150px'> </a><br>");
			
			print("<a href='display.php?id=".$reps[0]['govtrackid']."'>".$reps[0]['firstname']." ".$reps[0]['lastname']."</a><br>");
			print("{$reps[0]["party"]}<br>");
			print("{$reps[0]["description"]}<br>");
			print("</div>");  
			$i = $i + 1;
		}
		
		print('</div>');
		print('</div>');
		print('<div class="col-lg-2">');
		print('</div>');		
		print('</div>');
		
		
?>


<div class="row">
	<div class="col-lg-2"></div>
    
	<div class="col-lg-8 text-center" style="min-height: 300px;">
    
        <script>
		
		function changeFeed(id) {
				
		}
		/*
			var data = <?php 
			//$temp = array();
			//foreach($repinformation as $reps) {
			//	array_push($temp, $reps[0]);
			//}
			//echo json_encode($temp);
			?>;
			
			var container = d3.select('body').append('div')
    			.attr('id','my-reps-container');
	
			var svg = container.append("svg")
				.attr("width", 735)
				.attr("height", 300);
			
			var g = svg.selectAll("g")
    			.data(data)
  				.enter()
  				.append("g")
    			.attr("x", function(d, i) {
					return i * 245;
				})
				.attr("y", 0);
			
			var a = g.append("a")
				.attr("class", "rep-anchor")
				.attr("xlink:href", function(d, i) {
					return "display.php?id=" + d.govtrackid;
				});
				
				
			a.append("rect")
				.attr("width", 200)
				.attr("height", 350)
				.attr("x", function(d, i) {
					return i * 245;
				})
				.attr("y", 0)
				.attr("fill", "#CCC");
				
				
			g.append("image")
				.attr("class", "rep-img")
				.attr("xlink:href", function(d, i) {
					return d.photourl;	
				})
				.attr("height", 150)
				.attr("width", 100)
				.attr("x", function(d, i) {
					return i * 245 + 50;
				})
				.attr("y", 10);
			
			
			a.append("text")
				.attr("y", 170)
				.attr("x", function(d, i) {
					return i * 245 + 20;
				})
				.attr("width", 150)
				.attr("height", 21)
				.text(function(d, i) {
					return d.firstname + " " + d.lastname;
				})
				.style("font-size", 20);
				
			a.append("text")
				.attr("y", 191)
				.attr("x", function(d, i) {
					return i * 245 + 20;
				})
				.attr("width", 150)
				.attr("height", 21)
				.text(function(d, i) {
					return d.party;
				})
				.style("font-size", 20);
				
			a.append("text")
				.attr("y", 212)
				.attr("x", function(d, i) {
					return i * 245 + 20;
				})
				.attr("width", 100)
				.attr("height", 21)
				.text(function(d, i) {
					var l = d.description.length;
					
					if (l < 30) {
						return d.description;
					} else {
						var s = d.description.substring(0, 30);
						var index = s.lastIndexOf(" ");
						return s.substring(0, index);
					}
				})
				.style("font-size", 20);
			
			
			a.append("text")
				.attr("y", 233)
				.attr("x", function(d, i) {
					return i * 245 + 20;
				})
				.attr("width", 100)
				.attr("height", 21)
				.text(function(d, i) {
					var l = d.description.length;
					
					if (l >= 30) {
						var prev = d.description.substring(0, 30);
						var indexPrev = prev.lastIndexOf(" ");
						if (l < 60) {
							return d.description.substring(indexPrev, 60);
						} else {
							var s = d.description.substring(0, 60);
							var index = s.lastIndexOf(" ");
							return d.description.substring(indexPrev, index);
						}
					} 
					return "";
				})
				.style("font-size", 20);
				
				
			a.append("text")
				.attr("y", 254)
				.attr("x", function(d, i) {
					return i * 245 + 20;
				})
				.attr("width", 100)
				.attr("height", 21)
				.text(function(d, i) {
					if (d.description.length >= 60) {
						var prev = d.description.substring(0, 60);
						var index1 = prev.lastIndexOf(" ") + 1;
						return d.description.substring(index1, 100);
					}
					return "";
				})
				.style("font-size", 20);
			*/
				
			</script>
            
	</div>
    <div class="col-lg-2"></div>
</div>
            