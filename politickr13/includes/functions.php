<?php

    /**
     * functions.php
     *
     * Politickr.us
     *
     * Helper functions.
     */
	 
	 function updateRepObjects() {
		 
	 }
	 
	 /**
     * Adds a rep. 
     */
    function addRep($repid , $userid)
    {
		//Access user and rep objects stored as blob in seql database
		$repblob = query("SELECT object FROM representatives WHERE govtrackid = ?", $repid);
		$userblob = query("SELECT object FROM users WHERE id = ?", $userid);
		if($repblob == FALSE||$userblob == FALSE)
		{
			apologize("Sorry, an error occurred");
		}
		else
		{
			$rep = unserialize($repblob);
			$user = unserialize($userblob);
			$rep -> addUser($user);
			$user -> follow($rep);
			$updatedrep = serialize($rep);
			$updateduser = serialize($user);
			query("UPDATE representatives SET object = ? WHERE govtrackid = ?", $updatedrep, $repid);
			query("UPDATE users SET object = ? WHERE id = ?", $updateduser, $userid);
		}
       exit;
    } 
	 
    /**
     * Apologizes to user with message.
     */
    function apologize($message)
    {
        render("apology.php", ["message" => $message]);
        exit;
    }

	/****

	* Using the Bing News Search API to take in a bill title and return a json of search results.

	*/
    function billNews($billtitle)
    {
		//acount key
		$acctKey = 'TgKuTsoXDPETmVKSZj/SO/UIQtLWyulJmh8Kj2FPBXU=';
		$query = urlencode("'{$billtitle}'");
		$requestUri = 'https://api.datamarket.azure.com/Bing/Search/News?$format=json&Query='.$query;
		// Encode the credentials and create the stream context.
		$auth = base64_encode("$acctKey:$acctKey");

		$data = array(

			'http' => array(

			'request_fulluri' => true,

			'header' => "Authorization: Basic $auth")

			);

		$context = stream_context_create($data);
		// Get the response from Bing.
		$response = file_get_contents($requestUri, 0, $context);
		return $response;
		exit;
		/*
		$resultStr = ''; 
		// Parse each result according to its metadata type. 
		foreach($jsonObj->d->results as $value) 
		{ 
			switch ($value->__metadata->type) 
			{ 
				case 'WebResult': $resultStr .= "<a href=\"{$value->Url}\">{$value->Title}</a><p>{$value->Description}</p>";
				break; 
				case 'ImageResult': $resultStr .= "<h4>{$value->Title} ({$value->Width}x{$value->Height}) " . "{$value->FileSize} bytes)</h4>" . "<a href=\"{$value->MediaUrl}\">" . "<img src=\"{$value->Thumbnail->MediaUrl}\"></a><br />"; 
				break; 
			}
		}
		*/
	}
	
	 /**
     * Facilitates debugging by dumping contents of variable
     * to browser.
     */
    function dump($variable)
    {
        require("../templates/dump.php");
        exit;
    }
	
	/**
     * Emails someone using php mail(). 
     */
    function emailRep($voteid, $repid, $email, $subject, $body, $save)
    {
        //$to = "recipient@example.com";
		//$subject = "Hi!";
		//$body = "Hi,\n\nHow are you?";
		$username = $_SESSION['user']['username'];
		if (mail($email, $subject, $body,'From: '.$username. '@ politickr.us')) 
		{
			return("<p>Email successfully sent!</p>");
			if($save == TRUE)
			{
				$response = query("INSERT INTO email (user,representative,body,vote) VALUES(?,?,?,?)", $_SESSION['user']['username'],$repid, $body, $voteid);
				if( $response === FALSE)
				{
					apologize("There was an error loading representatives");
				}
			}
		} 
		else 
		{
			return("<p>Email delivery failed…</p>");
		}
        exit;
    }
	
    
     /**
     * Takes in address and returns array the govtrack ids of the representatives at that address.
     */
    function getReps($address)
    {
    	//use google civics api post request for address , get first and last name of reps
    	
    	$postdata = array('address' => $address);
		$opts = array('http' =>array(
								'method'  => 'POST',
								'header'  => 'Content-type: application/json',
								'content' => json_encode($postdata)
								)
					);

		$context  = stream_context_create($opts);
		$gcivicsjson= file_get_contents('https://www.googleapis.com/civicinfo/us_v1/representatives/lookup?key=AIzaSyAHYsujZGNYp0JWhDbyJn5Fol7tuEHNZUg', 'false', $context);
		//turn json to Array object
		$gcivics = json_decode($gcivicsjson,true); 
		
		//Check to see if address was valid
		if ( strcasecmp($gcivics['status'],"success") != 0)
		{
			apologize('Please reenter your address');
		}
		// Find where the representatives are indexed, assign to position variable
		foreach( $gcivics['offices'] as $offices)
		{
			$isitrep = explode(" ", $offices['name']);
			if($offices['name'] == "United States Senate")
			{
				$sen1pos = $offices["officialIds"][0];
				$sen2pos = $offices["officialIds"][1];
				
			}
			// Representative tricker because the title changes for each district, used explode to strcompare
			else if ( (count($isitrep) > 4) && (strcasecmp($isitrep[2], "House") == 0 ) && (strcasecmp($isitrep[3], "of") == 0 ) && (strcasecmp($isitrep[4], "Representatives") == 0 ))
			{
				$reppos=$offices["officialIds"][0];
			}
		}

		//Get representative arrays from position variable index
		$sen1 = $gcivics['officials'][$sen1pos];
		$sen2 = $gcivics['officials'][$sen2pos];
		$rep = $gcivics['officials'][$reppos];
		//get first and last name by taking first and last substrings
		$sen1name = explode(" ", $sen1['name']);
		$sen2name = explode(" ", $sen2['name']); 
		$repname = explode(" ", $rep['name']);
		$s1firstname = $sen1name[0];
		$s1lastname = $sen1name[count($sen1name)-1];
		$s2firstname = $sen2name[0];
		$s2lastname = $sen2name[count($sen2name)-1];
		$repfirstname = $repname[0];
		$replastname = $repname[count($repname)-1];
		//dump($repname) to troubleshoot
	
    	//get JSON from govtrack of all reps (max limit is 600)
        $gtrackRepjson = file_get_contents('https://www.govtrack.us/api/v2/role?current=true&limit=600');
		$gtrackRep = json_decode($gtrackRepjson,true); 
		// keeping track of index could be handy if we make users and don't want to search again.
		$index = 0;
		// iterate through govtrack representative arrays
		$order = array( 0 => array ( 0 => $s1firstname, 1 => $s1lastname, 2 => $sen1pos),
						1 => array ( 0 => $s2firstname, 1 => $s2lastname, 2 => $sen2pos),
						2 => array ( 0 => $repfirstname, 1 => $replastname, 2 => $reppos),
						);
		foreach($order as $placeholder)
		{

			$row= query("SELECT govtrackid FROM representatives WHERE (firstname = ? OR nickname = ?) AND (lastname = ? OR namemod= ?) AND state = ?", $placeholder[0], $placeholder[0], $placeholder[1], $placeholder[1], $gcivics['normalizedInput']['state'] );
			if(isset($gcivics['officials'][$placeholder[2]]['emails'][0]))
			{
				//update seql database and insert photourl
				query("UPDATE representatives SET email = ? WHERE govtrackid = ?", $gcivics['officials'][$placeholder[2]]['emails'][0], $row[0]['govtrackid']);

			}
			if(isset($gcivics['officials'][$placeholder[2]]['photoUrl']))
			{
				//update seql database and insert photourl
				query("UPDATE representatives SET photourl = ? WHERE govtrackid = ?", $gcivics['officials'][$placeholder[2]]['photoUrl'], $row[0]['govtrackid']);

			}
			else
			{
				//if there isn't a photoUrl given, show a picture of cat instead
				query("UPDATE representatives SET photourl = ? WHERE govtrackid = ?", "img/cat.jpg", $row[0]['govtrackid']);
			}
			$reparray[$index] = $row[0]['govtrackid'];
			$index++;
		}
		return $reparray;
        exit;
    }
     /**
     * 
    /* Gets representatives if the user has representatives stored in the SQL database.
	* Takes in array of govtrack ids $ids interates through and returns stored representative information.
	*/
	function getSavedReps( $ids)
	{
		//get JSON from govtrack of all reps (max limit is 600)
		//dump($ids);
		$reparray;
        foreach($ids as $id)
			{
				$reparray[$id] = query("SELECT * FROM representatives WHERE govtrackid = ?", $id);
			}
		//dump($reparray);
		return $reparray; 
		
		
	}
	 /**
     * Takes in a govtrack person id and returns an array of votes .
     */
    function getVotes($id)
    {
    	$limit = 600;
    	//get last 600 votes of representative in JSON format, get various fields including id of related bill
       	$votejson = file_get_contents('http://www.govtrack.us/api/v2/vote_voter/?person='.$id.'&limit='.$limit.'&order_by=-created&fields=vote__id,created,option__value,vote__category,vote__chamber,vote__question,vote__number,vote__related_bill,vote__total_minus,vote__total_plus,vote__total_other,vote__link');
 		$data = json_decode($votejson, true);
		return $votejson;
 		exit; 
    }
    /**
     * Takes in a govtrack bill id and returns bill information.
     */
    
	function getBillInfo ($id)
	{
 		$billjson = file_get_contents('http://www.govtrack.us/api/v2/bill/'.$id.'/?fields=id,bill_type,current_status,current_status_date, current_status_description, is_alive,sponsor,title,thomas_link,titles');
		
 		$billdata=json_decode($billjson,true);
 		$index = count($billdata['titles'])-1;
 		// add summary key
 		$billdata['summary'] = $billdata['titles'][$index][count($billdata['titles'][$index])-1];
 		//dump($billdata);
 		return $billdata;
 		exit;
	}
   
	function notify($message)
    {
        render("notify.php", ["message" => $message]);
        exit;
    }
    /**
     * Logs out current user, if any.  Based on Example #1 at
     * http://us.php.net/manual/en/function.session-destroy.php.
     */
    function logout()
    {
        // unset any session variables
        $_SESSION = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        session_destroy();
    }

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=politickr_db;host=mysql.politickr.us", "politickr13", "LKTkTpDQ");

                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     */
    function redirect($destination)
    {
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
        }

        // exit immediately since we're redirecting anyway
        exit;
    }
	 /**
     * Loads all of the representative info from the govtrack person API to the representatives
     * mySQL table. Empty fields are entered as 0. 
     */
    function load()
    {
    	$gtrackRepjson = file_get_contents('https://www.govtrack.us/api/v2/role?current=true&limit=600');
    	$gtrackRep = json_decode($gtrackRepjson,true); 
		// iterate through govtrack representative arrays
		foreach($gtrackRep['objects'] as $reps)
		{
			foreach($reps as &$elements)
			{
				if(!isset($elements))
				{
					//dump($elements);
					$elements = 0;
				}
			}
			//dump($reps);
			foreach($reps['person'] as &$elements)
			{
				if(empty($elements))
				{
					$elements = 0;
				}
			}
			//dump($reps);
			//if( !empty($reps['person']['namemod']) && !empty($reps['person']['nickname']) && !empty($reps['district']))
			//{
			$str = $reps['person']['id'];
			$followers = array();
			$votes = array();
			$followersblob = serialize($followers);
			$votesblob = serialize($votes);
			
			$x = query("INSERT INTO representatives (lastname, firstname, namemod, nickname, description, party, startdate, enddate, phone, website, title, birthday, link, govtrackid, bioguideid, cspanid, osid,pvsid,twitterid,youtubeid, district, state, followers, votes) VALUES(?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", $reps['person']['lastname'], $reps['person']['firstname'], $reps['person']['namemod'], $reps['person']['nickname'], $reps['description'], $reps['party'], $reps['startdate'], $reps['enddate'], $reps['phone'], $reps['website'], $reps['title'], $reps['person']['birthday'], $reps['person']['link'], $reps['person']['id'], $reps['person']['bioguideid'],$reps['person']['cspanid'],$reps['person']['osid'],$reps['person']['pvsid'],$reps['person']['twitterid'],$reps['person']['youtubeid'],$reps['district'], $reps['state'], $followersblob, $votesblob);
			if($x === false){
				apologize("There was an error loading representatives");
				//dump($reps);
			}
		}
    }
    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
        // if template exists, render it
        if (file_exists("../templates/$template"))
        {
            // extract variables into local scope
            extract($values);

            // render header
            require("../templates/header.php");

            // render template
            require("../templates/$template");

            // render footer
            require("../templates/footer.php");
        }

        // else err
        else
        {
            trigger_error("Invalid template: $template", E_USER_ERROR);
        }
    }

?>
