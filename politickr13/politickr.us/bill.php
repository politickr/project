<?php
    //configuration
    require("../includes/config.php");
	
	$b = query("SELECT object FROM bills WHERE id = ?", $_GET['id']);
	
	if ($b == false) {
		$billinfo = getBillInfo($_GET['id']);
    	query("INSERT INTO bills (id, object) VALUES(?, ?)", $_GET['id'], serialize($billinfo));
		echo json_encode($billinfo);
		
	} else {
		$billblob = $b[0]['object'];
		$billinfo = unserialize($billblob);
		echo json_encode($billinfo);
	}
    //renders display HTML form
    
   	
    //$totalplusbill = $_GET['totalplusbill'];
    //$totalminusbill = $_GET['totalminusbill'];
    //$totalotherbill = $_GET['totalotherbill'];
    
    //render("bill_form.php", ["billinfo" => $billinfo, "totalplusbill" => $totalplusbill, "totalminusbill" => $totalminusbill, "totalotherbill" => $totalotherbill]);


?>
