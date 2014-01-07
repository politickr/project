<?php

class User {
	public $name, $email, $senOne, $senTwo, $rep;
	private $voteThreshold;
	public $following, $actualReps; 
	
	public function __construct($n, $e, $one, $two, $r, $v) {
		$this -> name = $n;
		$this -> email = $e;
		$this -> senOne = $one;
		$this -> senTwo = $two;
		$this -> rep = $r;
		$this -> voteThreshhold = $v;
		$this -> following = new SplObjectStorage();
		$this -> actualReps['senatorOne'] = $senOne;
		$this -> actualReps['senatorTwo'] = $senTwo;
		$this -> actualReps['rep'] = $rep;
		$this -> following -> attach($senOne);
		$this -> following -> attach($senTwo);
		$this -> following -> attach($rep);
	}
	
	public function follow($representative) {
		$this -> following -> attach($representative);
	}
	
	public function unfollow($representative) {
		$this -> following -> detach($representative);
	}
	
	public function getName() {
		return $this -> name;
	}
	
	public function getReps() {
		return $this -> actualReps;
	}
	
	public function getEmail() {
		return $email;	
	}
	
	public function getVoteThreshold() {
		global $voteThreshold;
		return $voteThreshold;	
	}
	
}

?>