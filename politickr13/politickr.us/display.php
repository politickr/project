<?php
    // configuration
   require("../includes/config.php"); 
    
    //renders display HTML form
   $votes = getVotes($_GET['id']);
   render("display_form.php", ["votes" => $votes]);
?>
