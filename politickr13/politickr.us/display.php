<?php
    // configuration
   require("../includes/config.php"); 
    
    //puts in govtrack id and renders display form with array of votes returned by getvotes
   $votes = getVotes($_GET['id']);
   render("display_form.php", ["votes" => $votes],["id" => $_GET['id']]);
?>
