<?php

class User {
	private $name, $email, $senOne, $senTwo, $rep;
	private $voteThreshold;
	private $following, $actualReps; 
	
	public function __construct($n, $e, $one, $two, $r, $v) {
		global $name, $email, $senOne, $senTwo, $rep, $voteThreshold, $following;
		$name = $n;
		$email = $e;
		$senOne = $one;
		$senTwo = $two;
		$rep = $r;
		$voteThreshhold = $v;
		$following = new SplObjectStorage();
		$actual['senatorOne'] = $senOne;
		$actual['senatorTwo'] = $senTwo;
		$actual['rep'] = $rep;
		$following -> attach($senOne);
		$following -> attach($senTwo);
		$following -> attach($rep);
	}
	
	public function follow($representative) {
		global $following;
		$following -> attach($representative);
	}
	
	public function unfollow($representative) {
		global $following;
		$following -> detach($representative);
	}
	
	public function getName() {
		global $name;
		return $name;
	}
	
	public function getReps() {
		global $actual;
		return $actual;
	}
	
	public function getEmail() {
		global $email;
		return $email;	
	}
	
	public function getVoteThreshold() {
		global $voteThreshold;
		return $voteThreshold;	
	}
	
}

?>