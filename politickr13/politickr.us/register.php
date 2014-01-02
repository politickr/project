<?php

    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //if the username or password or confirm password fields are empty
        if (empty($_POST["password"]) || empty($_POST["confirmation"])) 
        {
           //rejects input 
           apologize("You must provide a username, an email, an address, and a password"); 
        }
        //if password and confirm password DO NOT match
        else if ($_POST["password"] != $_POST["confirmation"])
        {
           //rejects input
           apologize("Oops, re-confirm your password!"); 
        }        
        else
        {
			
           //stores username into variable result
           if(empty($_POST["username"]))
           {
           		$_POST["username"] = $_SESSION["email"];
           }
           
           $result = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
           if ($result != false)
           {
                //reject input
                apologize("Sorry, this username already exists.");
           }
           //retrieves IDs of the representatives of user
		   if(! empty($_POST['address']))
			{
				$RepProfiles = getReps($_POST["address"]);
				if ($RepProfiles === NULL)
				{
					apologize("Invalid Address");
				}
				$repobjects;
				$index= 0;
				foreach($RepProfiles as $govtrackid)
				{
					$result = query("SELECT object FROM representatives WHERE govtrackid = ?", $govtrackid);
					$repobjects[$index] = unserialize($result[0]['object']);
					$index++;
				}
					
				$temp = new User($_POST['username'], $_SESSION['email'], $repobjects[0],$repobjects[1], $repobjects[2], 0);
				$x = query("INSERT INTO users (username, hash, email, senator1id, senator2id, repid, votethreshold, object) VALUES(?, ?, ?, ?, ?, ?, ?, ?)", $temp->getName(), crypt($_POST["password"]), $temp->getEmail(), $RepProfiles[0], $RepProfiles[1], $RepProfiles[2], 0, serialize($temp));
						
			}
			
             if ($x === false)
			{
				//reject input
                apologize("Sorry, input failed.");
           	}
 
             $rows = query("SELECT LAST_INSERT_ID() AS id");
               
             $id = $rows[0]["id"];
             $_SESSION["id"] = $id;
             notify('Registration successful! You are now logged in!');
             //redirect("/");                                  
               
        }
          
	} 
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
