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

        $Congressmen = getReps($_POST["address"]);

        if($Congressmen === NULL)
        {
            apologize("Congressman NOT FOUND");
        }
        else
        {
            render("my_reps.php", ["Congressmen" => $Congressmen]);
        }            
    }
    else
    {
        // else render form
        render("frontpage_form.php", ["title" => "Enter Address"]);
    }

?>
