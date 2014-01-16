<?php
require("../includes/config.php");

if (isset($_SESSION["user"])) {
	
	  $bill = $_GET['id'];
	  $userOp = $_GET['op'];
	  
	  
	  $votes = $_SESSION["user_votes"];
	  
	  
	  $temp = "#".$bill;
	  $votes[$temp] = $userOp;
	  $_SESSION["user_votes"] = $votes;
	  
	  $tempsplitVotes = array("Y" => array(), "N" => array());
	  
	  
	  foreach($votes as $key => $val) {
		  if (strcmp($val, "Y") == 0) {
		  	array_push($tempsplitVotes["Y"], $key);
		  } else {
			array_push($tempsplitVotes["N"], $key);
		  }
	  }
	  
	  $_SESSION["user_split_votes"] = $tempsplitVotes;
	  query("UPDATE users SET votes = ? WHERE username = ?", serialize($votes), $_SESSION["username"]);
	  
	  
} else {
	echo "failure";
}
	
?>
