<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
	
   if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["address"]))
        {
            apologize("You must provide an address.");
        }

        $ids = getReps($_POST["address"]);

        if($ids === NULL)
        {
            apologize("Congressmen NOT FOUND");
        }
        else
        {
			$repinformation;
			foreach($ids as $id)
			{
				$repinformation[$id] = query("SELECT * FROM representatives WHERE govtrackid = ?", $id);
			}
            render("index_form.php", ["repinformation" => $repinformation]);
        }            
    }
    else
    {
        // else render form
        render("search_form.php", ["title" => "Find Your Representatives"]);
    }

?>
