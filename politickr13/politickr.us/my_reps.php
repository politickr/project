<?php
require("../includes/config.php"); 

if( !empty($_SESSION["user"]["senator1id"]) || !empty($_SESSION["user"]["senator2id"]) || !empty($_SESSION["user"]["repid"]))
	{
		 $order = array( 0 => $_SESSION["user"]["senator1id"],
						1 => $_SESSION["user"]["senator2id"],
						2 => $_SESSION["user"]["repid"],
						);
		 $repinformation = getSavedReps($order);
		 
		 if($repinformation === NULL)
        {
            apologize("There was an error in retrieving your representatives.");
        }
        else
        {
            render("index_form.php",  ["repinformation" => $repinformation]);
        }            
		
	}
	
	else  if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["address"]))
        {
            apologize("You must provide an address.");
        }
		 $_SESSION["address"] = $_POST["address"];

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
	else if (!empty($_SESSION["address"]))
	{
		 $ids = getReps($_SESSION['address']);

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