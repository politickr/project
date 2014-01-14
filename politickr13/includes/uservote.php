<?php

$bill = $_GET['id'];
$userOp = $_GET['userOpinion'];
$prevVotes = $_SESSION["user_votes"];

$repblob = query("SELECT upvotes FROM users WHERE username = ?", $_SESSION['user']);
query("UPDATE representatives SET object = ? WHERE govtrackid = ?", $updatedrep, $repid);

?>
