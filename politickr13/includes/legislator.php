<?php

class Legislator {
	
	private $id;
	private $votes, $users;
	
	public function __construct($i) {
		global $id;
		$id = $i;
		global $votes;
		global $users;
		$votes = new SplObjectStorage();
		$users = new SplObjectStorage();
	}
	/** Addes a vote object to this legislator. */
	public function addVote($v) {
		global $votes;
		$votes -> attach($v);	
	}
	
	/** Called when a user follows this legislator, storing the user
	object in THIS. */
	public function addUser($u) {
		global $users;
		$users -> attach($u);
	}
	
	/** Called when a users stops following this legislator. */
	public function removeUser($u) {
		global $users;
		$users -> detach($u);	
	}
	
	public function getID() {
		global $id;
		return $id;
	}
	
	
}
?>