<?php	/* standard function definitions */

/* To get the IP address of client */
function getIP() {
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

/* Log, Need Database (MYSQL) */
function setLog($DBlink, $type="info", $content, $user){
	$ip = getIP(); 
	$url = $_SERVER['REQUEST_URI']; 
	$DBlink->query("INSERT INTO `log`(`type`, `msg`, `user`, `site`, `IP`) VALUES ('{$type}', '{$content}', '{$user}', '{$url}', '{$ip}'); "); 
}

/* alert */
function alert($msg) {
	echo "<script>alert('{$msg}')</script>"; 	
}

/* location */
function locate($url) {
	echo "<script> window.location.href='{$url}'; </script>"; 
}

?>
