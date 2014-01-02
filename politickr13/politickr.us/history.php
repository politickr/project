<?php

    //configuration
    require("../includes/config.php"); 
    
    //draws data from history database
    $rows = query("SELECT symbol, shares FROM History WHERE id = ?", $_SESSION["id"]);
    
    //defines $positions
    
    $positions = [];
    
    //creates table
    foreach($rows as $row)
    {
        $positions[] = [
                "id" => $row["id"],
                "symbol" => $row["symbol"],
                "shares" => $row["shares"],
                "price" => $row["price"],
                "dateandtime" => $row["dateandtime"],
                "buysell" => $row["buysell"]  
            ];
    }
     
    // render history
    render("history_form.php", ["positions" => $positions, "title" => "History"]);


?>
