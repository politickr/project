<?php

    // configuration
    require("../includes/config.php"); 

    // if form was submitted
	if( !empty($_SESSION["user"]["senator1id"]) || !empty($_SESSION["user"]["senator2id"]) || !empty($_SESSION["user"]["repid"]))
	{
		 $Congressmen = getSavedReps($_SESSION["user"]["senator1id"],$_SESSION["user"]["senator2id"],$_SESSION["user"]["repid"]);
		 if($Congressmen === NULL)
        {
            apologize("There was an error in retrieving your representatives.");
        }
        else
        {
            render("index_form.php", ["Congressmen" => $Congressmen]);
        }            
		
	}
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["address"]))
        {
            apologize("You must provide an address.");
        }

        $Congressmen = getReps($_POST["address"]);

        if($Congressmen === NULL)
        {
            apologize("Congressmen NOT FOUND");
        }
        else
        {
            render("index_form.php", ["Congressmen" => $Congressmen]);
        }            
    }
    else
    {
        // else render form
        render("search_form.php", ["title" => "Find Your Representatives"]);
    }

?>
