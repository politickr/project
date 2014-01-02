<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))    
        {
            apologize("Please provide a company name");
        }
        
        $stock = lookup($_POST["symbol"]);
            
        if ($stock === false)
        {
            apologize("Company doesn't exist");
        }
        else
        {
        render("quotetemplate.php", ["stock" => $stock]);        
        }
    }
    else 
    {
        render("quote_form.php", ["title" => "Quote"]);
    }


?>
