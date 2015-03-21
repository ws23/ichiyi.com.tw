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
			<h1>今日必看</h1><p><?php
			$result = $DBmain->query("SELECT * FROM `title` WHERE state<2 order by tID DESC limit 6; "); 
                        $i=0;
                        while ($row = $result->fetch_array(MYSQLI_BOTH)) {
                            if($i>0)
                                echo '/';
                            echo '<a href="'.$row['URL'].'">';
                            echo $row['titleText'];
                            echo '</a>';
                            $i++;
                        }
				?></p>
			<hr />
		<div class="body-must-left">
		<?php 
			$result->free();
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 1 ORDER BY `startTime` DESC limit 1; "); 
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
				<td class="emphasize-color" rowspan="2" >
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
                        $row_number=2;
                        $col_number=3;
                        $result_limit=$row_number*$col_number;
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT ".$result_limit."; "); 
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
				$arr[] = $row; 
			}
		?>
			<table>
	<?php	for($i=0; $i<2; $i++) {
                    echo '<tr>';
                    for($j=0;$j<3;$j++){
                        echo '<th>';
                        if(isset($arr[$i*3+$j]))
                            echo "<a href='{$arr[$i*3+$j]['URL']}'><img src='{$arr[$i*3+$j]['imageURL']}' /></a>";
                        echo '</th>';
                    }
                    echo '</tr>';
                    echo '<tr>';
                    for($j=0;$j<3;$j++){
                        echo '<td>';
                        if(isset($arr[$i*3+$j]))
                            echo "<h2><a href='{$arr[$i*3+$j]['URL']}'>{$arr[$i*3+$j]['titleText']}</a></h2>";
                        echo '</td>';
                    }
                    echo '</tr>';
                    echo '<tr>';
                    for($j=0;$j<3;$j++){
                        echo '<td>';
                        if(isset($arr[$i*3+$j])){
                            echo "<p><a href='{$arr[$i*3+$j]['URL']}'>{$arr[$i*3+$j]['contentText']}</a></p>";
                            echo getFacebookLikeFormatLink($arr[$i*3+$j]['URL'],"button_count");
                        }
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                ?>
			</table>
		</div>
	</div>
	<!-- 今日必看 end -->
	
	<!-- 精彩推薦 start -->
	<div class="body-recommend">
		<h1>精彩推薦</h1>
		<hr />
		<?php
                        $i=0;
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 1 ORDER BY `startTime` DESC limit 1; "); 
			$row = $result->fetch_array(MYSQLI_BOTH);
                        if(isset($row)){
                            echo '<a href="'.$row['URL'].'"><img src="'.$row['imageURL'].'" /></a>';
                            echo '<h2><a href="'.$row['URL'].'">'.$row['text'].'</a></h2>';
                            $i=1;
                        }
                        
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 0 ORDER BY `startTime` DESC limit 9; "); 
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
				$arr2[] = $row; 
			}
			for(; $i<9; $i++) { if (isset($arr2[$i]['URL'])||isset($arr2[$i]['text'])){?>
			<p><a href="<?php echo $arr2[$i]['URL']; ?>"><?php $n=$i+1; echo $n.". ".$arr2[$i]['text']; ?></a></p>
                        <?php }} ?>
	</div>
	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->
	<div class="body-editor">
		<h1>小編狂推</h1>
		<hr />
		<table>
		<?php
			$result->free(); 
                        $row_number=2;
                        $col_number=6;
                        $result_limit=$row_number*$col_number;
			$result = $DBmain->query("SELECT * FROM `editor` where state<2 ORDER BY `startTime` DESC LIMIT ".$result_limit.";");
			while($row = $result->fetch_array(MYSQLI_BOTH)) {
                            if($row['state']<2)
				$arr3[] = $row;
			}
		?>
	<?php
        for($i=0; $i<2; $i++) {
            echo '<tr>';
            for($j=0; $j<6; $j++) {
                if(isset($arr3[$i*6+$j]))
                    echo "<th><a href='{$arr3[$i*6+$j]['URL']}'><img src='{$arr3[$i*6+$j]['imageURL']}' /></a></th>";
            }
            echo '</tr>';
            echo '<tr>';
            for($j=0;$j<6;$j++){
                if(isset($arr3[$i*6+$j]))
                    echo "<td><h2><a href='{$arr3[$i*6+$j]['URL']}'>{$arr3[$i*6+$j]['titleText']}</a></h2></td>";
            }
            echo '</tr>';
            echo '<tr>';
            for($j=0;$j<6;$j++){
                if(isset($arr3[$i*6+$j])){
                    echo "<td><p><a href='{$arr3[$i*6+$j]['URL']}'>{$arr3[$i*6+$j]['contentText']}</a></p>";
                    echo getFacebookLikeFormatLink($arr3[$i*6+$j]['URL'],"button_count");
                    echo '</td>';
                }
            }
            echo '</tr>';
        }	?>
		</table>	
	</div>
	<!-- 小編狂推 end -->
</div>
<!-- 首頁內容 end -->
<?php
	require_once('footer.php'); 
?>
</html>
