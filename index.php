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
	<!-- 今日必看 start -->
	<div class="body-must">
			<h1>今日必看</h1>
			<p>	<?php
					echo "施工中"; 
					for($i=1;$i<6;$i++)
						echo ", 施工中";
				?>
			</p>
			<hr />
		<div class="body-must-left">
		<?php 
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 1 ORDER BY `startTime` DESC; "); 
			$row = $result->fetch_array(MYSQLI_BOTH); 
		?>
			<table>
			<tr>
				<th colspan="2">
                                    <?php
                                        $href=$row['URL'];
                                        echo '<a href='.$href.'>';
                                        echo '<img src='.$row['imageURL'].' /></a><br/>';
                                    ?>
				</th>
			</tr>
			<tr>
				<td>
					<h2><a href="<?php echo $row['URL']; ?>"><?php echo $row['titleText']; ?></a></h2>
				</td>
				<td rowspan="2">
					給FB按讚~<br/>
                                        <?php echo getFacebookLikeFormatLink($href);?>
				</td>
			</tr>
			<tr>
				<td>
					<p><a href="<?php echo $row['URL']; ?>"><?php echo $row['contentText']; ?></a></p>
				</td>
			</tr>
			</table>
		</div>
		<div class="body-must-right">
		<?php
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 0 ORDER BY `startTime` DESC; "); 
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
				$arr[] = $row; 
			}
		?>
			<table>
	<?php	for($i=0; $i<2; $i++) {	?>
				<tr>
		<?php	for ($j=0; $j<3; $j++) {	?>
					<th>
                                            <a href="<?php echo $arr[$i*3+$j]['URL']; ?>"><img src="<?php echo $arr[$i*3+$j]['imageURL']; ?>" /></a>
                                        </th>
		<?php 	}	?>
				</tr>
				<tr>
		<?php	for ($j=0; $j<3; $j++) {	?>
					<td>
                                            <h2><a href="<?php echo $arr[$i*3+$j]['URL']; ?>"><?php echo $arr[$i*3+$j]['titleText']; ?></a></h2>
                                        </td>
		<?php	}	?>
				</tr>
				<tr>
		<?php	for ($j=0; $j<3; $j++) { 	?>
					<td><p><a href="<?php echo $arr[$i*3+$j]['URL']; ?>"><?php echo $arr[$i*3+$j]['contentText']; ?></a></p>
                                            <?php echo getFacebookLikeFormatLink($arr[$i*3+$j],"button_count");?>
                                        </td>
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
		<?php
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 1 ORDER BY `startTime` DESC; "); 
			$row = $result->fetch_array(MYSQLI_BOTH);
		?>
		<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $row['imageURL']; ?>" /></a>
		<h2><a href="<?php echo $row['URL']; ?>"><?php echo $row['text']; ?></a></h2>
		<?php 
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 0 ORDER BY `startTime` DESC; "); 
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
				$arr2[] = $row; 
			}
			for($i=0; $i<9; $i++) { ?>
			<p><a href="<?php echo $arr2[$i]['URL']; ?>"><?php echo $arr2[$i]['text']; ?></a></p>
		<?php } ?>
	</div>
	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->
	<div class="body-editor">
		<h1>小編狂推</h1>
		<hr />
		<table>
		<?php
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `editor` ORDER BY `startTime` DESC ; "); 
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
				$arr3[] = $row; 	
			}
		?>
	<?php for($i=0; $i<2; $i++) {	?>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<th><a href="<?php echo $arr3[$i*6+$j]['URL']; ?>"><img src="<?php echo $arr3[$i*6+$j]['imageURL']; ?>" /></a></th>	
	<?php	}	?>
			</tr>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<td><h2><a href="<?php echo $arr3[$i*6+$j]['URL']; ?>"><?php echo $arr3[$i*6+$j]['titleText']; ?></a></h2></td>
	<?php	}	?>
			</tr>
			<tr>
	<?php	for($j=0; $j<6; $j++) {	?>
				<td><p><a href="<?php echo $arr3[$i*6+$j]['URL']; ?>"><?php echo $arr3[$i*6+$j]['contentText']; ?></a></p>
                                <?php echo getFacebookLikeFormatLink($arr[$i*3+$j],"button_count");?>
                                </td>	
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
