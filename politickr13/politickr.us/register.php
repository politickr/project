<?php

    // configuration
    require("../includes/config2.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //if the username or password or confirm password fields are empty
        if (empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmation"])) 
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
           		$_POST["username"] = $_POST["email"];
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
				 //inserts username, hash, email, representative ids into database
				if(empty($_POST['updatefreq'])) {
				
					$temp = new User($_POST['username'], $_POST['email'], $RepProfiles[0]['person']['id'], $RepProfiles[1]['person']['id'], $RepProfiles[2]['person']['id'], 0);
					
					$x = query("INSERT INTO users (username, hash, email, senator1id, senator2id, repid, updatefreq, object) VALUES(?, ?, ?, ?, ?, ?, ?)", $temp->getName(), crypt($_POST["password"]), $temp->getEmail(), $RepProfiles[0]['person']['id'], $RepProfiles[1]['person']['id'], $RepProfiles[2]['person']['id'], 0, serialize($temp));
				}
				else
				{
					$temp = new User($_POST['username'], $_POST['email'], $RepProfiles[0]['person']['id'], $RepProfiles[1]['person']['id'], $RepProfiles[2]['person']['id'], $_POST['updatefreq']);
					
					$x = query("INSERT INTO users (username, hash, email, senator1id, senator2id, repid, updatefreq, object) VALUES(?, ?, ?, ?, ?, ?, ?)", $temp->getName(), crypt($_POST['password']), $temp->getEmail(), $RepProfiles[0]['person']['id'], $RepProfiles[1]['person']['id'], $RepProfiles[2]['person']['id'], $temp->getVoteThreshold(), serialize($temp));
				}
			}
			else
			{
				if(empty($_POST['updatefreq']))
				{
				//inserts username, hash, email, into database
				$temp = new User($_POST['username'], $_POST['email'], "", "", "", 0);
				
				$x = query("INSERT INTO users (username, hash, email, updatefreq, object) VALUES(?, ?, ?, ?, ?)", $temp->getName(),crypt($_POST["password"]), $_POST["email"], serialize($temp));
				
				}
				else
				{
					$temp = new User($_POST['username'], $_POST['email'], "", "", "", $_POST['updatefreq']);
					$x = query("INSERT INTO users (username, hash, email, updatefreq, object) VALUES(?, ?, ?, ?, ?)", $temp->getName(),crypt($_POST["password"]), $_POST["email"], serialize($temp));

				}
			}
             if ($x === false)
			{
				//reject input
                apologize("Sorry, input failed.");
           	}
 
             $rows = query("SELECT LAST_INSERT_ID() AS id");
               
             $id = $rows[0]["id"];
             $_SESSION["id"] = $id;
               
           
             redirect("/");                                  
           
                      
        }
    }        
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

?>
