<?php
 /*
 might need this:
  <?php 
if( !isset($_SESSION['last_access']) || (time() - $_SESSION['last_access']) > 60 ) 
   $_SESSION['last_access'] = time(); 
?> 
 
 */
    // configuration
    require("../includes/config2.php"); 
 
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
 
        // query database for user
        $rows = query("SELECT * FROM users WHERE username = ?", $_POST["username"]);
 
        // if we found a user, check password
        if (count($rows) == 1)
        {
            // take first (and only) row
            $row = $rows[0];
 
            // compare hash of user's input against hash that's in database
            if (crypt($_POST["password"], $row["hash"]) == $row["hash"])
            {
                //update timestamp in sql database
                query("UPDATE users SET ts = ? WHERE username = ?", NOW(), $row['username']);
                // remember that user's now logged in by storing user's ID in session
                $_SESSION["user"] = $row;
                // redirect to portfolio
                redirect("/");
            }
        }
 
        // else apologize
        apologize("Invalid username and/or password.");
    }
    else
    {
        // else render form
        render("login_form.php", ["title" => "Log In"]);
    }
 
?>
