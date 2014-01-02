<?php

    //configuration
    require("../includes/config.php"); 
    
    //if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["symbol"]))
        {
            apologize("You need to provide a company in order to sell shares of it");    
        }
        
        //searches to see if user has the said stock
        $result = query("SELECT * FROM Portfolio WHERE id = ?", $_POST["symbol"], $_SESSION["id"]);
        
        //if user provided a stock they don't have
        if ($result != false)
        {
            apologize("Stop selling stocks you don't have bro");
        }
        else
        {
        //searches up value of each share of stock
        $stock = lookup($_POST["symbol"]);
        
        //finds shares that the user has of the said company
        $shares = query("SELECT shares FROM Portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);  
        
        //sets price of return of stock sell
        $profit = ($stock["price"] * $shares[0]["shares"]); 
        
        //updates user's account balance
        query("UPDATE users SET cash = cash + ? WHERE id = ?", $profit, $_SESSION["id"]);
         
        //deletes rows (company stocks) from portfolio
        query("DELETE FROM Portfolio WHERE id = ? AND symbol = ?", $_SESSION["id"], $stock["symbol"]);        

        //inserts entry into history table
        query("INSERT INTO History (symbol, shares, price, dateandtime, buysell) VALUES(?, ?, ?, NOW(), ?)", $stock["symbol"], $shares[0]["shares"], $stock["price"], "sell");         
     
        }
        
        
        redirect("/");
    }
    
    else
    {
        render("sell_form.php", ["title" => "Sell"]);
    }
?>
