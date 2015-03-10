<?php session_start(); 
	require_once('std.php');

	/* check login correct or not */
	$userName = $DBmain->real_escape_string($_POST['userID']); 
	$userPW = $DBmain->real_escape_string($_POST['password']);
	
	if( $userName!=$_POST['userID'] || $userPW!=$_POST['password'] ) {
		alert('請不要輸入奇怪的東西，請重新輸入。'); 
		setLog($DBmain, "warning", "escape_string: {$_POST['userID']}, {$_POST['password']}". ""); 
		locate('adminLogin.php'); 
	}

	$result = $DBmain->query("SELECT * FROM `user` WHERE `userName` = '{$userName}'; "); 
	$row = $result->fetch_array(MYSQLI_BOTH); 
	if( $row['userName']!=$userName ) {
		alert('使用者名稱不存在，請重新輸入。'); 
		setLog($DBmain, "warning", "userName do not exist: {$userName}", ""); 
		locate('adminLogin.php'); 
	}
	else if( $row['password']==md5($userPW) ) {
		setLog($DBmain, "info", "Login Success!!", $userName);
		$_SESSION['USERNAME'] = $userName; 
		$_SESSION['NICKNAME'] = $row['nickName']; 
		$_SESSION['EMAIL'] = $row['email']; 
		$_SESSION['AUTH'] = $row['authority']; 
		locate('adminInterface.php'); 
	}
	else {
		alert('使用者密碼錯誤，請重新輸入。'); 
		setLog($DBmain, "warning", "password error: {$userPW}", $userName); 
		locate('adminLogin.php'); 
	}
	
	$result->free(); 
	require_once('stdEnd.php'); 
?>
