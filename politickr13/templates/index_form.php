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
			print("<a href='display.php?id=".$reps[0]['govtrackid']."'><img src=".$reps[0]['photourl']." width='150px'> </a><br>");
			print("<a href='display.php?id=".$reps[0]['govtrackid']."'>".$reps[0]['firstname']." ".$reps[0]['lastname']."</a><br>");
			print("{$reps[0]["description"]}<br>"); 
			print("{$reps[0]["party"]}");
			print("</div>");  
			$i = $i + 1;
		}
		
		print('</div>');
		print('</div>');
		print('<div class="col-lg-2">');
		print('</div>');		
		print('</div>');
		
  
	echo '<script>';
	echo '<svg width="5cm" height="4cm" version="1.1"';
    echo 'xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">';
	
	echo '</svg>';
	echo 'd3.selectAll(.rep).style("display", "none")';
	echo 'd3.selectAll(.img).style("height", 150px);'; 
	
	echo '</script>';
	
	
		
?>
