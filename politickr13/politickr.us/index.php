<?php

    // configuration
    require("../includes/config.php"); 
    
/*    
    //draws data from database
    $rows = query("SELECT senator1id, senator2id, repid FROM users WHERE id = ?", $_SESSION["id"]);
    
    //defines $positions
    
    $positions = [];
    
    //creates table
    foreach($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "sharevalue" => $row["shares"] * $stock["price"]
            ];
        }
    
    }
 */

		// render homepage
		render("homepage_form.php", ["title" => "Politickr"]);

?>
