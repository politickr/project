<?php
    //configuration
    require("../includes/config.php");
    
    //renders display HTML form
    $billinfo = getBillInfo($_GET['bill']);
   
    $totalplusbill = 0; //$_GET['totalplusbill'];
    $totalminusbill = 0;// $_GET['totalminusbill'];
    $totalotherbill = 0; // $_GET['totalotherbill'];
    
    render("bill_form.php", ["billinfo" => $billinfo, "totalplusbill" => $totalplusbill, "totalminusbill" => $totalminusbill, "totalotherbill" => $totalotherbill]);


?>
