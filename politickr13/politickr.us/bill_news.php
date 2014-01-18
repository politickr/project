<?php 

require("../includes/functions.php"); 

if(isset($_GET['billTitle'])) {
	$searchStr = $_GET['billTitle']; 
	echo billNews($searchStr);
} else {
	echo "failure";	
}
	
			
?>