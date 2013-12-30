<?php

    //configuration
    require("../includes/config.php"); 
    
    //if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //if user did not provide symbol
        if (empty($_POST["symbol"]))
        {
            apologize("You need to provide a company in order to buy shares of it");    
        }
        
        //if user does not provide valid symbol
        $stock = lookup($_POST["symbol"]);
        
        if ($stock === false)
        {
            apologize("Company was not found");
        }
        
        //if user does not provide positive integer number of shares to buy
        if (!preg_match("/^\d+$/", $_POST["shares"] || $_POST["shares"] == 0))
        {        
            apologize("Please provide a valid number of shares (Hint: you can't buy 0 or half a share)");
        }
        
        //checks if user has enough money
        $cash = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        
        if ($cash[0]["cash"] < $_POST["shares"] * $stock["price"])
        {
            apologize("You're too poor for this");
        }
        
        //now that user has bought stock, subtract value from account
        $cost = ($_POST["shares"] * $stock["price"]);
        
        query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
         
        //searches to see if user has the said stock
        $result = query("SELECT * FROM Portfolio WHERE id = ?", $_POST["symbol"], $_SESSION["id"]);
        
        //inserts shares into table IF they already have it
        if ($result == false)
        {
            query("INSERT INTO Portfolio (id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);    
        
            //inserts entry into history table
            query("INSERT INTO History (symbol, shares, price, dateandtime, buysell) VALUES(?, ?, ?, NOW(), ?)", $_POST["symbol"], $_POST["shares"], $stock["price"], "buy");         
     
        }
        else if ($result != false)
        {
            //inserts shares into table IF they don't have it
           query("INSERT INTO Portfolio (id, symbol, shares) VALUES(?, ?, ?)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]); 
       
            //inserts entry into history table
            query("INSERT INTO History (symbol, shares, price, dateandtime, buysell) VALUES(?, ?, ?, NOW(), ?)", $_POST["symbol"], $_POST["shares"], $stock["price"], "buy");         
     
        }
        
        redirect("/");
        
    }
    else
    {
        render("buy_form.php", ["title" => "Buy"]);
    }  
    
?>
