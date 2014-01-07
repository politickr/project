<?php
    //configuration
    require("../includes/config.php");
    
    //renders display HTML form
    $billinfo = getBillInfo($_GET['id']);
   	
    $totalplusbill = $_GET['totalplusbill'];
    $totalminusbill = $_GET['totalminusbill'];
    $totalotherbill = $_GET['totalotherbill'];
    
    render("bill_form.php", ["billinfo" => $billinfo, "totalplusbill" => $totalplusbill, "totalminusbill" => $totalminusbill, "totalotherbill" => $totalotherbill]);


?>
