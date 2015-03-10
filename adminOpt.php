<?php
	session_start();
	require_once('std.php'); 

	if(isset($_POST['originPW'])) { // change password
		$password = $DBmain->real_escape_string($_POST['originPW']);
		$newPW = $DBmain->real_escape_string($_POST['newPW']);  
		$checkPW = $DBmain->real_escape_string($_POST['checkPW']); 

		$result = $DBmain->query("SELECT * FROM `user` WHERE `userName` = '{$_SESSION['USERNAME']}'; ");  
		$row = $result->fetch_array(MYSQLI_BOTH); 

		if( $password!=$_POST['originPW'] || $newPW!=$_POST['newPW'] || $checkPW!=$_POST['checkPW'] ) {
			alert('密碼更換失敗，請確認您輸入之資料。'); 
			setLog($DBmain, 'warning', "escape_string: {$_POST['originPW']}, {$_POST['newPW']}, {$_POST['checkPW']}", $_SESSION['USERNAME']); 
		}
		else if($newPW!=$checkPW) {
			alert('兩次新密碼輸入內容不一。'); 
			setLog($DBmain, 'warning', 'difference between two. ', $_SESSION['USERNAME']); 
		}
		else if($row['password']==md5($password)) {
			setLog($DBmain, 'debug', "UPDATE `user` SET `password` = md5('$newPW') WHERE `userName` = '{$_SESSION['USERNAME']}'; ", $_SESSION['USERNAME']); 
			$DBmain->query("UPDATE `user` SET `password` = md5('$newPW') WHERE `userName` = '{$_SESSION['USERNAME']}'; "); 
			alert('密碼更換成功。'); 
			setLog($DBmain, 'info', 'Password changed!!', $_SESSION['USERNAME']); 
		}
		else {
			alert('密碼更換失敗，請確認您輸入之資料。'); 
			setLog($DBmain, 'warning', "password error", $_SESSION['USERNAME']); 
		}
		
		locate('adminInterface.php'); 
	}
	/*else if(isset()) { // manage 'must'
		
	}
	else if(isset()) {	// manage 'recommend'
		
	}
	else if(isset()) {	// manage 'editor'
		
	}
*/
	require_once('stdEnd.php');
?>
