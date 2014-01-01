<?php

class Legislator {
	
	public $id;
	public $votes, $users;
	
	function __construct($i) {
		$id = $i;
		$votes = new SplObjectStorage();
		$users = new SplObjectStorage();
	}
	/** Addes a vote object to this legislator. */
	function addVote($v) {
		$votes -> attach($v);	
	}
	
	/** Called when a user follows this legislator, storing the user
	object in THIS. */
	function addUser($u) {
		$users -> attach($u);
	}
	
	/** Called when a users stops following this legislator. */
	function removeUser($u) {
		$users -> detach($u);	
	}
	
	
}
?>