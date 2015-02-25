<?php	/* standard function definitions */

	require_once("conf.php"); 
// Utilities
	// To get the IP address of client
	static function getIP(){
		if(!empty($_SERVER['REMOTE_ADDR']))
			$ip = $_SERVER['REMOTE_ADDR'];
		if(!empty($_SERVER['HTTP_X_FORWADED_FOR'])) {
			$ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']); 
			if($ip) {
				array_unshift($ips, $ip); 
				$ip = false; 
			}
			for($i=0; $i<count($ips); $i++) {
				if(!eregi("^(10|172.16|192.168).", $ips[$i])) {
					$ip = $ips[$i]; 
					break;	
				}
			}
		}
		return $ip; 
	}

	// To get the hostname with script path
	static function getHostName() {
		$httpURL = "http"; 
		if($_SERVER['HTTPS'] == "on") 
			$httpURL .= "s"; 
		$httpURL .= "://"; 
		$httpURL .= $_SERVER['SERVER_NAME']; 
		if($_SERVER['SERVER_PORT'] != 80) 
			$httpURL .= ":" . $_SERVER['SERVER_PORT']; 
		$httpURL .= $GLOBALS['ScriptPath']; 
		if(substr($httpURL, strlen($httpURL)-1) != '/')
			$httpURL .= '/'; 

		return $httpURL; 
	}


// Database (MYSQL)




// Log	
	static function setLog(){
			
	}

?>
