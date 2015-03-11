<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
	<link rel="stylesheet" href="jquery/jquery-ui.css" />
	<link rel="stylesheet" href="jquery/jquery-ui-timepicker-addon.css" />
	<script src="jquery/jquery-1.10.2.js"></script>
	<script src="jquery/jquery-ui.js"></script>
	<script src="jquery/jquery-ui-sliderAccess.js"></script>
	<script src="jquery/jquery-ui-timepicker-addon.js"></script>
<?php 
	require_once('header.php'); 
	if(!isset($_SESSION['USERNAME'])) {
		alert('登入逾時，請重新登入。'); 
		setLog($DBmain, 'warning', 'Login timeout. ', ""); 
		locate('adminLogin.php'); 
	}

?>

<script language="javascript">
function admin(name){
	document.getElementsByClassName('must')[0].style.display = "none"; 
	document.getElementsByClassName('recommend')[0].style.display = "none"; 
	document.getElementsByClassName('editor')[0].style.display = "none"; 
	document.getElementsByClassName('change')[0].style.display = "none"; 
	document.getElementsByClassName('add')[0].style.display = "none"; 

	if(name!=null) { 
		var block = document.getElementsByClassName(name)[0]; 
		block.style.display = "block"; 
	}   
}

function selectAdmin(value){
	if(value=="logout") 
		window.location.href="logout.php"; 
	else
		admin(value); 
}
$(document).ready(function() {
	var opt = {
			dateFormat: 'yy-mm-dd', 
			showSecond: true, 
			timeFormat: 'HH:mm:ss' 
		}; 
	$( "#starttime" ).datetimepicker(opt); 
	$( "#endtime" ).datetimepicker(opt); 
}); 

function checkblock() {
	var block = document.getElementsByClassName('block'); 
	var focus = document.getElementsByName('focus'); 

	document.getElementsByClassName('add-ini')[0].style.display = "block"; 
	document.getElementsByClassName('add-focus')[0].style.display = "block"; 
	document.getElementsByClassName('add-title')[0].style.display = "block"; 
	document.getElementsByClassName('add-img')[0].style.display = "block"; 

	if ( block[1].checked && !block[0].checked && !block[2].checked ) {
		document.getElementsByClassName('add-title')[0].style.display = "none"; 	
		if(focus[1].checked)
			document.getElementsByClassName('add-img')[0].style.display = "none"; 
	}

	if ( block[2].checked && !block[0].checked && !block[1].checked )
		document.getElementsByClassName('add-focus')[0].style.display = "none"; 

	if( !block[0].checked && !block[1].checked && !block[2].checked )
		document.getElementsByClassName('add-ini')[0].style.display = "none"; 
}
</script>  

<!-- Admin interface start -->
<?php 
	setLog($DBmain, 'info', 'into adminInterface', $_SESSION['USERNAME']);  
	require_once('updateState.php'); 
?>
<h2>嗨！<?php echo $_SESSION['NICKNAME']; ?>！歡迎回來！</h2>
<hr />
<h3>請問您想進行什麼樣的操作呢？</h3>
<select onchange="selectAdmin(this.value)">
	<option value="choose" selected>選擇……</option>
	<option value="logout">登出</option>
	<option value="change">更換密碼</option>
	<option value="add">新增資訊</option>
	<option value="must">管理「今日必看」</option>
	<option value="recommend">管理「精彩推薦」</option>
	<option value="editor">管理「小編狂推」</option>
</select>

<div class="add">
<form action="adminOpt.php" method="post" enctype="multipart/form-data">
<div class="add-block">
	<label>上傳區塊</label>
		<input type="checkbox" class="block" name="must" value="must" onclick="checkblock()"><label>今日必看</label></input>
		<input type="checkbox" class="block" name="recommend" value="recommend" onclick="checkblock()"><label>精彩推薦</label></input>
		<input type="checkbox" class="block" name="editor" value="editor" onclick="checkblock()"><label>小編狂推</label></input<br />
</div>
<div class="add-ini">
<div class="add-focus">
	<label>焦點資訊</label>
		<input class="radio" type="radio" name="focus" value="true" onclick="checkblock()"><label>是</label></input>
		<input class="radio" type="radio" name="focus" value="false" onclick="checkblock()" checked><label>否</label></input><br />
</div>
	<label>發佈時間</label>
		<input class="textbox" id="starttime" type="text" name="starttime" value="<?php echo date('Y-m-d H:i:s', time()); ?>" readonly />
		<label> ~ </label>
		<input class="textbox" id="endtime" type="text" name="endtime" value="<?php echo date('Y-m-d H:i:s', time()); ?>" readonly /><br />
<div class="add-title">
	<label>標題文字</label>
		<input class="textbox" type="text" name="title" /><br />
</div>
	<label>描述文字</label>
		<input class="textbox" type="text" name="description" /><br />

	<label>網站連結</label>
		<input class="textbox" type="text" name="url" /><br />
<div class="add-img">
	<label>圖片上傳</label>
		<input class="textbox" type="file" name="img" /><br />
</div>
	<input type="submit" value="submit" />
		<input type="reset" value="reset" />
</div>
</form> 
</div>
<div class="change">
<hr />
<!-- change pw start -->
<form action="adminOpt.php" method="post">
	<label>原始密碼</label>
		<input class="textbox" type="password" name="originPW" /><br />
	<label>新密碼</label>
		<input class="textbox" type="password" name="newPW" /><br />
	<label>確認新密碼</label>
		<input class="textbox" type="password" name="checkPW" /><br />
	<input type="submit" value="更換密碼" />
		<input type="reset" value="清除重填" />
</form>
<!-- change pw end -->
</div>

<div class="recommend">
<?php
	$now = date('Y-m-d H:i:s', time()); 
	$result = $DBmain->query("SELECT * FROM `recommend` ORDER BY `startTime` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>開始時間</th><th>結束時間</th><th>標題</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['rID']}</td><td>{$row['startTime']}</td><td>{$row['endTime']}</td><td>{$row['text']}</td>"; 
		if($row['state']==1)
			echo '<td>焦點</td>'; 
		else if($row['state']==0)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=recommend&id={$row['rID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<div class="must">
<?php
	$now = date('Y-m-d H:i:s', time()); 
	$result = $DBmain->query("SELECT * FROM `must` ORDER BY `startTime` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>開始時間</th><th>結束時間</th><th>標題</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['mID']}</td><td>{$row['startTime']}</td><td>{$row['endTime']}</td><td>{$row['titleText']}</td>"; 
		if($row['state']==1)
			echo '<td>焦點</td>'; 
		else if($row['state']==0)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=must&id={$row['mID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<div class="editor">
<?php
	$now = date('Y-m-d H:i:s', time()); 
	$result = $DBmain->query("SELECT * FROM `editor` ORDER BY `startTime` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>開始時間</th><th>結束時間</th><th>標題</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['eID']}</td><td>{$row['startTime']}</td><td>{$row['endTime']}</td><td>{$row['titleText']}</td>"; 
		if($row['state']<=1)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=editor&id={$row['eID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<!-- Admin interface end -->
<?php require_once('footer.php'); ?>
