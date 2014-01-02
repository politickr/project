<?php
    
    // configuration
    require("../includes/config.php");

    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //if the username or password field is empty
        if (empty($_POST["username"]) || empty($_POST["newpassword"])) 
        {
           //rejects input 
           apologize("Please fill in both fields"); 
        }
        
        //searches up username in SQL and inserts new password (replaces old hash)
        query("INSERT INTO users (username, hash, cash) VALUES (?, ?, 0) ON DUPLICATE KEY UPDATE hash = VALUES(hash)", $_POST["username"], crypt($_POST["newpassword"]));
        
        redirect("/");      
        
    }
    else
    {
        // else render form
        render("password_form.php", ["title" => "Password"]);
          
    }


?>

