<?php session_start(); ?>
<?php require_once(dirname(__FILE__) . '/../config.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝臺灣官方網站</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
<?php
	require_once(dirname(__FILE__) . '/../lib/header.php'); 
	if(isset($_SESSION['USERNAME']))
		locate('index.php'); 
?>

<!-- Login start -->
<div class="login">
<fieldset>
	<form action="admin.php" method="post">
		<label>username: <label/>
			<input class="textbox" type="text" name="userID" /><br />
		<label>password: <label/>
			<input class="textbox" type="password" name="password" /><br />
		<input type="submit" value="Login" />
			<input type="reset" value="Reset" />
	</form>
</fieldset>
</div>
<!-- Login end -->

<?php
	require_once(dirname(__FILE__) . '/../lib/footer.php'); 
?>
</html>
