<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
	<style>
		img {
			width: 180px; 
			height: 101px; 
		}
		img.focus {
			width: 380px; 
			height: 270px; 	
		}
	</style>
<?php
	require_once('header.php'); 
	if(!isset($_SESSION['USERNAME'])){
		setLog($DBmain, 'warning', 'No authority', '');
		alert('尚未登入，請登入。'); 
		locate('adminLogin.php');	
	} 
?>

<!-- detail start -->
<div class="login">
<fieldset>
<?php
	$class = $DBmain->real_escape_string($_GET['class']); 
	$id = $DBmain->real_escape_string($_GET['id']); 
	
	if($class=='must')
		$idName = 'mID'; 
	else if($class=='recommend')
		$idName = 'rID'; 
	else if($class=='editor')
		$idName = 'eID'; 

	$result = $DBmain->query("SELECT * FROM `{$class}` WHERE `{$idName}` = {$id}; "); 
	$row = $result->fetch_array(MYSQLI_BOTH); 
?>
<table class="detail">
<tr><td>ID</td><td><?php echo $id; ?></td></tr>
<tr><td>開始時間</td><td><?php echo $row['startTime']; ?></td></tr>
<tr><td>結束時間</td><td><?php echo $row['endTime']; ?></td></tr>
<?php 
if ($row['imageURL']!=NULL && $row['imageURL']!="") 
	echo "<tr><td>圖片檔案</td><td><img src='{$row['imageURL']}'></td></tr>"; 
if ($row['titleText']!=NULL && $row['titleText']!="")
	echo "<tr><td>標題</td><td>{$row['titleText']}</td></tr>"; 
if ($row['contentText']!=NULL && $row['contentText']!="")
	echo "<tr><td>描述</td><td>{$row['contentText']}</td></tr>"; 
if ($row['text']!=NULL && $row['text']!="")
	echo "<tr><td>描述</td><td>{$row['text']}</td></tr>";	
?>
<tr><td>超連結</td><td><?php echo $row['URL']; ?></td></tr>
<tr><td>狀態</td><td>
<?php
if($row['state']==1)
	echo "焦點"; 
else if($row['state']==0)
	echo "公開"; 
else
	echo "隱藏"; 
?>
</td></tr>
<tr><td>操作</td><td>施工中！</td></tr>
</table>
</fieldset>
</div>
<!-- detail end -->

<?php
	require_once('footer.php'); 
?>
</html>
