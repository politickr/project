<?php

class User {
	public $name, $email, $senOne, $senTwo, $rep, $voteThreshold;
	public $following; 
	
	function __construct($n, $e, $one, $two, $r, $v) {
		$name = $n;
		$email = $e;
		$senOne = $one;
		$senTwo = $two;
		$rep = $r;
		$voteThreshhold = $v;
		$following = new SplObjectStorage();
		$following -> attach($senOne);
		$following -> attach($senTwo);
		$following -> attach($rep);
	}
	
	function follow($representative) {
		$following -> attach($representative);
	}
	
	function unfollow($representative) {
		$following -> detach($representative);
	}
	
	function getName() {
		return $name;
	}
	
}

?>