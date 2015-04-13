<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>臺灣愛奇藝官方網站</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
<?php
	require_once('header.php'); 
	if(isset($_SESSION['USERNAME']))
		locate('adminInterface.php'); 
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
	require_once('footer.php'); 
?>
</html>
