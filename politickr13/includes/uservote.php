<?php


if (isset($_SESSION["user"]) || true) {
	
	  $bill = $_GET['id'];
	  $userOp = $_GET['op'];
	  
	  
	  $votes = $_SESSION["user_votes"];
	  dump($votes);
	  
	  $temp = "#".$bill;
	  $votes[$temp] = $userOp;
	  $votes["#100000000"] = "test";
	  $_SESSION["user_votes"] = $votes;
	  
	  query("UPDATE users SET votes = ? WHERE username = ?", serialize($votes), $_SESSION["username"]);
	  echo "success";
} else {
	echo "failure";
}
	
?>
