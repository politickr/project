<?php

class Vote {
	public $time, $chamber, $rep, $question;
	public $vote;
	public $up, $down;
	
	function __construct() {
		__construct(0, "", "", "", "", "");
	}
	
	function __construct($v, $r, $ch, $cat, $t, $q) {
		$vote = $v;
		$rep = $r;
		$chamber = $c;
		$question = $q;
		$category = $c;
		$time = $t;
		$up = new SplObjectStorage();
		$down = new SplObjectStorage();
	}
	
	function upvote($user) {
		if ($down->contains($user)) {
			$down->detach($user);
		}
		
		$up->attach($user);
	}
	
	function downvote($user) {
		if ($up->contains($user)) {
			$up->detach($user);
		}
		
		$down->attach($user);
	}
}








?>
