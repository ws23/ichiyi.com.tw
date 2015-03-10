<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
<?php 
	require_once('header.php'); 
	if(!isset($_SESSION['USERNAME'])) {
		alert('登入逾時，請重新登入。'); 
		setLog($DBmain, 'warning', 'Login timeout. ', ""); 
		locate('adminLogin.php'); 
	}

?>

<script>
function admin(name){
	document.getElementsByClassName('must')[0].style.display = "none"; 
	document.getElementsByClassName('recommend')[0].style.display = "none"; 
	document.getElementsByClassName('editor')[0].style.display = "none"; 
	document.getElementsByClassName('change')[0].style.display = "none"; 

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
</script>  

<!-- Admin interface start -->
<?php setLog($DBmain, 'info', 'into adminInterface', $_SESSION['USERNAME']);  ?>
<h2>嗨！<?php echo $_SESSION['NICKNAME']; ?>！歡迎回來！</h2>
<hr />
<h3>請問您想進行什麼樣的操作呢？</h3>
<select onchange="selectAdmin(this.value)">
	<option value="choose" selected>選擇……</option>
	<option value="logout">登出</option>
	<option value="change">更換密碼</option>
	<option value="must">管理「今日必看」</option>
	<option value="recommend">管理「精彩推薦」</option>
	<option value="editor">管理「小編狂推」</option>
</select>

<div class="must">
<hr />
<!-- must start -->
<form enctype="multipart/form-data" action="adminOpt.php" method="post">
	<label>焦點資訊</label>
		<input class="radio" type="radio" name="focus" value="true"><label>是</label></input>
		<input class="radio" type="radio" name="focus" value="false" checked><label>否</label></input><br />
	<label>發佈時間</label>
		<input class="textbox" type="text" name="startTime" />
		<label> ~ </label>
		<input class="textbox" type="text" name="endTime" /><br />
	<label>標題文字</label>
		<input class="textbox" type="text" name="title" /><br />
	<label>描述文字</label>
		<input class="textbox" type="text" name="description" /><br />
	<label>網站連結</label>
		<input class="textbox" type="text" name="url" /><br />
	<label>圖片上傳</label>
		<input class="textbox" type="file" name="mustIMG" /><br />
	<input type="submit" value="submit" /> 
		<input type="reset" value="reset" />
</form>
<!-- must end -->
</div>

<div class="recommend">
<hr />
<!-- recommend start -->
recommend; 
<!-- recommend end -->
</div>

<div class="editor">
<hr />
<!-- editor start -->
<form action="adminOpt.php" method="post">
 
<!-- editpr end -->
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

<!-- Admin interface end -->
<?php require_once('footer.php'); ?>
