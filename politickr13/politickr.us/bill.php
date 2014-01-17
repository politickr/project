<?php
    //configuration
    require("../includes/config.php");
	
	$billblob = query("SELECT object FROM bills WHERE id = ?", $_GET['id']);
	
	if ($billblob === false) {
		$billinfo = getBillInfo($_GET['id']);
    	query("INSERT INTO bills (id, object) VALUES(?, ?)", $_GET['id'], serialize(json_encode($billinfo)));
		echo json_encode($billinfo);
	} else {
		$billinfo = unserialize($billblob[0]);
		echo $billinfo;
	}
    //renders display HTML form
    
   	
    //$totalplusbill = $_GET['totalplusbill'];
    //$totalminusbill = $_GET['totalminusbill'];
    //$totalotherbill = $_GET['totalotherbill'];
    
    //render("bill_form.php", ["billinfo" => $billinfo, "totalplusbill" => $totalplusbill, "totalminusbill" => $totalminusbill, "totalotherbill" => $totalotherbill]);


?>
