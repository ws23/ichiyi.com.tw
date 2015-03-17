<?php 
	session_start(); 
	require_once('std.php'); 
	$now = date('Y-m-d H:i:s', time()); 
	
	$result = $DBmain->query("SELECT * FROM `must`; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		$start = $row['startTime']; 
		$end = $row['endTime']; 
		$state = $row['state']; 

		if($state<2) { // origin public
			if($start > $now || $end < $now) {
				$stateN = $state+2; 
				$DBmain->query("UPDATE `must` SET `state` = {$stateN} WHERE `mID` = {$row['mID']}; "); 
				setLog($DBmain, 'debug', "Set `must`: {$row['mID']} to private; ", $_SESSION['USERNAME']); 
			}
		}	
		else if($state<4) {	// origin private
			if($start <= $now && $end >= $now) {
				$stateN = $state-2; 
				$DBmain->query("UPDATE `must` SET `state` = {$stateN} WHERE `mID` = {$row['mID']}; "); 
				setLog($DBmain, 'debug', "Set `must`: {$row['mID']} to public; ", $_SESSION['USERNAME']); 
			}
		}
	}
	$result->free(); 

	$result = $DBmain->query("SELECT * FROM `recommend`; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		$start = $row['startTime']; 
		$end = $row['endTime']; 
		$state = $row['state']; 

		if($state<2) { // origin public
			if($start > $now || $end < $now) {
				$stateN = $state+2; 
				$DBmain->query("UPDATE `recommend` SET `state` = {$stateN} WHERE `rID` = {$row['rID']}; "); 
				setLog($DBmain, 'debug', "Set `recommend`: {$row['rID']} to private; ", $_SESSION['USERNAME']); 
			}
		}
		else if($state<4) {	// origin private
			if($start <= $now && $end >= $now) {
				$stateN = $state-2; 
				$DBmain->query("UPDATE `recommend` SET `state` = {$stateN} WHERE `rID` = {$row['rID']}; "); 
				setLog($DBmain, 'debug', "Set `recommend`: {$row['rID']} to public; ", $_SESSION['USERNAME']);
			}
		}
	}
	$result->free(); 

	$result = $DBmain->query("SELECT * FROM `editor`; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		$start = $row['startTime']; 
		$end = $row['endTime']; 
		$state = $row['state']; 

		if($state<2) { // origin public
			if($start > $now || $end < $now) {
				$stateN = $state+2; 
				$DBmain->query("UPDATE `editor` SET `state` = {$stateN} WHERE `eID` = {$row['eID']}; "); 
				setLog($DBmain, 'debug', "Set `editor`: {$row['eID']} to private; ", $_SESSION['USERNAME']); 
			}
		}
		else if($state<4) {	// origin private
			if($start <= $now && $end >= $now) {
				$stateN = $state-2; 
				$DBmain->query("UPDATE `editor` SET `state` = {$stateN} WHERE `eID` = {$row['eID']}; "); 
				setLog($DBmain, 'debug', "Set `editor`: {$row['eID']} to public; ", $_SESSION['USERNAME']);
			}
		}
	}
	$result->free(); 
?>
