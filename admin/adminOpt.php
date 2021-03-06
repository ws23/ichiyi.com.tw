<?php
	session_start();
	require_once(dirname(__FILE__) . '/../lib/std.php'); 

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
		
		locate('index.php'); 
	}
	if(isset($_POST['add-type']) && $_POST['add-type']=='must' ) { 
		$table = 'must'; 
		$start = $DBmain->real_escape_string($_POST['starttime']); 
		$end = $DBmain->real_escape_string($_POST['endtime']); 
		$titleText = $DBmain->real_escape_string($_POST['title']); 
		$contentText = $DBmain->real_escape_string($_POST['description']); 
		$url = $DBmain->real_escape_string($_POST['url']); 
		$state = $_POST['focus'] == "true"? 1 : 0;
		$now = date('Y-m-d', time()); 
		$imgURL = "img/uploads/{$now}-{$_FILES['img']['name']}"; 

		move_uploaded_file($_FILES['img']['tmp_name'], dirname(__FILE__) . "/../" . $imgURL); 
		setLog($DBmain, 'info', 'upload image', $_SESSION['USERNAME']); 
			
		$DBmain->query("INSERT INTO `{$table}` (`startTime`, `endTime`, `imageURL`, `titleText`, `contentText`, `URL`, `state`) VALUES ('{$start}', '{$end}', '{$imgURL}', '{$titleText}', '{$contentText}', '{$url}', '{$state}'); "); 
		setLog($DBmain, 'info', 'insert new data (must)', $_SESSION['USERNAME']); 	
	}
	if(isset($_POST['add-type']) && $_POST['add-type']=='recommend' ) {
		$table = 'recommend'; 
		$start = $DBmain->real_escape_string($_POST['starttime']); 
		$end = $DBmain->real_escape_string($_POST['endtime']); 
		$text = $DBmain->real_escape_string($_POST['description']); 
		$url = $DBmain->real_escape_string($_POST['url']); 
		$state = $_POST['focus'] == "true"? 1 : 0;
		$now = date('Y-m-d', time()); 

		if($_POST['focus']=="true") {
			$imgURL = "img/uploads/{$now}-{$_FILES['img']['name']}"; 
			move_uploaded_file($_FILES['img']['tmp_name'], dirname(__FILE__) . "/../" . $imgURL); 
			setLog($DBmain, 'info', 'upload image', $_SESSION['USERNAME']); 
			$DBmain->query("INSERT INTO `{$table}` (`startTime`, `endTime`, `imageURL`, `text`, `URL`, `state`) VALUES ('{$start}', '{$end}', '{$imgURL}', '{$text}', '{$url}', '{$state}'); "); 
		}
		else {
			$DBmain->query("INSERT INTO `{$table}` (`startTime`, `endTime`, `text`, `URL`, `state`) VALUES ('{$start}', '{$end}', '{$text}', '{$url}', '{$state}'); ");
		}
		setLog($DBmain, 'info', 'insert new data (recommend)', $_SESSION['USERNAME']); 		
	}
	if(isset($_POST['add-type']) && $_POST['add-type']=='editor' ) {
		$table = 'editor'; 
		$start = $DBmain->real_escape_string($_POST['starttime']); 
		$end = $DBmain->real_escape_string($_POST['endtime']); 
		$titleText = $DBmain->real_escape_string($_POST['title']); 
		$contentText = $DBmain->real_escape_string($_POST['description']); 
		$url = $DBmain->real_escape_string($_POST['url']); 
		$state = 0;
		$now = date('Y-m-d', time()); 
		$imgURL = "img/uploads/{$now}-{$_FILES['img']['name']}"; 

		move_uploaded_file($_FILES['img']['tmp_name'], dirname(__FILE__) . "/../" . $imgURL); 
		setLog($DBmain, 'info', 'upload image', $_SESSION['USERNAME']); 
			
		$DBmain->query("INSERT INTO `{$table}` (`startTime`, `endTime`, `imageURL`, `titleText`, `contentText`, `URL`, `state`) VALUES ('{$start}', '{$end}', '{$imgURL}', '{$titleText}', '{$contentText}', '{$url}', '{$state}'); "); 
		setLog($DBmain, 'info', 'insert new data (editor)', $_SESSION['USERNAME']); 	
	}
        if(isset($_POST['add-type']) && $_POST['add-type']=='title'){
                $table='title';
                $titleText = $DBmain->real_escape_string($_POST['title']); 
                $url = $DBmain->real_escape_string($_POST['url']); 
                $state = 0;
		$DBmain->query("INSERT INTO `{$table}` (`titleText`, `URL`, `state`) VALUES ('{$titleText}', '{$url}', '{$state}'); "); 
                echo "INSERT INTO `{$table}` (`titleText`, `URL`, `state`) VALUES ('{$titleText}', '{$url}', '{$state}'); ";
		setLog($DBmain, 'info', 'insert new data (title)', $_SESSION['USERNAME']); 	
        }
        if(isset($_POST['add-type'])&&($_POST['add-type']=='ad'||$_POST['add-type']=='co-branding')){
            $table=$_POST['add-type'];
                $url = $DBmain->real_escape_string($_POST['url']); 
                $state = 0;
		$now = date('Y-m-d', time()); 
		$imgURL = "img/uploads/{$now}-{$_FILES['img']['name']}"; 

		move_uploaded_file($_FILES['img']['tmp_name'], dirname(__FILE__) . "/../" . $imgURL); 
		setLog($DBmain, 'info', 'upload image', $_SESSION['USERNAME']); 
		$DBmain->query("INSERT INTO `{$table}` (`imageURL`, `URL`, `state`) VALUES ('{$imgURL}', '{$url}', '{$state}'); "); 
                echo "INSERT INTO `{$table}` (`imageURL`, `URL`, `state`) VALUES ('{$imgURL}', '{$url}', '{$state}'); ";
		setLog($DBmain, 'info', "insert new data ({$table})", $_SESSION['USERNAME']); 	
        }
	require_once(dirname(__FILE__) . '/../lib/stdEnd.php');
	locate('index.php'); 
?>
