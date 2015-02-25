<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="index.css" />
<?php
	require_once('header.php'); 
?>
<!-- 首頁內容 start -->
<div class="body">
	<!-- 今日必看 start -->
	<div class="body-must">
			<h1>今日必看</h1>
			<p>	<?php
					echo "test"; 
					for($i=1;$i<6;$i++)
						echo ", test";
				?>
			</p>
			<hr />
		<div class="body-must-left">
			<table>
			<tr>
				<th colspan="2">
					<img src="img/logo.png" />
				</th>
			</tr>
			<tr>
				<td>
					<h2>零一二三四五六七八九壹一二三四五六七八九貳一二三四</h2>
				</td>
				<td rowspan="2">
					社群功能啊哈哈
				</td>
			</tr>
			<tr>
				<td>
					<p>零一二三四五六七八九壹一二三四五六七八九貳一二三四五六七八九</p>
				</td>
			</tr>
			</table>
		</div>
		<div class="body-must-right">
			<table>
	<?php	for($i=0; $i<2; $i++) {	?>
				<tr>
		<?php	for ($j=0; $j<3; $j++) {	?>
					<th><img src="img/logo.png" /></th>
		<?php 	}	?>
				</tr>
				<tr>
		<?php	for ($j=0; $j<3; $j++) {	?>
					<td><h2>零一二三四五六七八九壹一</h2></td>	
		<?php	}	?>
				</tr>
				<tr>
		<?php	for ($j=0; $j<3; $j++) { 	?>
					<td><p>零一二三四五六七八九壹一二三</p></td>
		<?php	}	?>
				</tr>
	<?php	}	?>
			</table>
		</div>
	</div>
	<!-- 今日必看 end -->
	
	<!-- 精彩推薦 start -->
	<div class="body-recommend">
		<h1>精彩推薦</h1>
		<hr />
		<img src="img/logo.png" />
		<h2>零一二三四五六七八九壹一</h2>
		<?php for($i=0; $i<9; $i++) { ?>
			<p>零一二三四五六七八九壹</p>
		<?php } ?>
	</div>
	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->
	<div class="body-editor">
		<h1>小編狂推</h1>
		<hr />
		<table>
	<?php for($i=0; $i<2; $i++) {	?>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<th><img src="img/logo.png" /></th>	
	<?php	}	?>
			</tr>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<td><h2>零一二三四五六七八九壹一</h2></td>
	<?php	}	?>
			</tr>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<td><p>零一二三四五六七八九壹一二三</p></td>	
	<?php	}	?>
			</tr>
	<?php	}	?>
		</table>	
	</div>
	<!-- 小編狂推 end -->
</div>
<!-- 首頁內容 end -->
<?php
	require_once('footer.php'); 
?>
</html>
