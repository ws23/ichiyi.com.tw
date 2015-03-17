<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="index.css" />
<?php
	require_once('header.php'); 
	setLog($DBmain, 'info', 'into index', ''); 
	$now = date('Y-m-d H:i:s', time()); 

	require_once('updateState.php'); 
?>
<!-- 首頁內容 start -->
<div class="body">
    <div class="body-about">
        <h1>關於我們</h1>
        <hr>
        NOTHING
    </div>
</div>
<!-- 首頁內容 end -->
<?php
	require_once('footer.php'); 
?>
</html>
