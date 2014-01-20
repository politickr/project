

<body>
<script src="js/d3.v3.min.js" charset="utf-8"></script>
<script>


</script>
<?php  
		$i = 0;
		$allVotes = array();
		
		foreach ( $repinformation as $reps)
		{
			array_push($allVotes, json_decode(getVotes($reps[0]['govtrackid'])));
			$i = $i + 1;
		}
		
		
?>
<div class="container" style="height:100%">
<div class="row" id="voteinfo-row">
	<div class="col-xs-2" id="rep-column">
    
          <script> var data = <?php 
                  $temp = array();
                  foreach($repinformation as $reps) {
                      array_push($temp, $reps[0]);
              }
                  echo json_encode($temp);
              ?>;
          </script>
  
          <script src="js/rep-column.js"></script>
	
	</div>
	<div class="col-xs-6" id="votefeed-column">
    	
    
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
	var allVotes = <?php echo json_encode($allVotes); ?>;
	//creates a giant SVG of the rep voting record
	
	
	
	var temp = <?php echo json_encode($allVotes) ?>;
	var userVotes = <?php 
		if (isset($_SESSION["user_split_votes"])) {
			echo json_encode($_SESSION["user_split_votes"]);
			
		} else if (!isset($_SESSION["user_split_votes"]) && isset($_SESSION["user"])) {
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
		} else {
			echo json_encode(array("Y" => array(), "N" => array()));
		}
		
		?>;
	
</script>

<script src="js/votefeeds.js"></script>

<script>
	$(document).ready(function() {
				  update(0);	
			  });
</script>

		</div>
        
    	<div class="col-xs-4" id="news-column">
    		<script src="js/billinfo.js"></script>
    	</div>
    </div>
</div>
</body>

