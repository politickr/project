<?php
require("../includes/config.php");
 $x = email(566,4555,'heiscody@gmail.com','test','test body', true);
 dump($x);
//$rows = query("SELECT firstname FROM representatives WHERE id = ?", 1);
//dump($rows);
//$test = new User('name','heiscody@gmail.com', new Legislator(1), new Legislator(2), new Legislator(3), 2);
//dump($test->getName());
//$x=load();
//dump($x);
?>