<?php

class Legislator {
	
	public $id;
	public $votes, $users;
	
	public function __construct($i) {
		$id = $i;
		$votes = new SplObjectStorage();
		$users = new SplObjectStorage();
	}
	/** Addes a vote object to this legislator. */
	public function addVote($v) {
		$votes -> attach($v);	
	}
	
	/** Called when a user follows this legislator, storing the user
	object in THIS. */
	public function addUser($u) {
		$users -> attach($u);
	}
	
	/** Called when a users stops following this legislator. */
	public function removeUser($u) {
		$users -> detach($u);	
	}
	
	
}
?>