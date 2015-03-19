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
        $pre=getPreState($DBmain,$class,$id);
	if($class=='must')
		$idName = 'mID'; 
	else if($class=='recommend')
		$idName = 'rID'; 
	else if($class=='editor')
		$idName = 'eID'; 

	$result = $DBmain->query("SELECT * FROM `{$class}` WHERE `{$idName}` = {$id}; "); 
	$row = $result->fetch_array(MYSQLI_BOTH); 
?>
<script>
    var table="<?php echo $class;?>";
    var id="<?php echo $id;?>";
    var start_date_change='<?php echo $row['startTime'];?>';
    var end_date_change='<?php echo $row['startTime'];?>';
    var imageURL='<?php echo $row['imageURL'];?>';
    var URL='<?php echo $row['URL'];?>';
    <?php 
    if($class=='editor'||$class=='must'){
	echo "var titleText='{$row['titleText']}';\n";
	echo "var contentText='{$row['contentText']}';\n";
    }
    if($class=='recommend')
	echo "var text='{$row['text']}';\n";
    ?>
    var post_state=<?php
            if($pre%2==0)
                echo $pre==2?1:0;
            else if($pre%2==1){
                if($pre>2)
                    echo '1';
                else
                    echo '0';
            }
            ?>;
    $(document).ready(function() {
            $( "#starttime" ).datetimepicker({
                            dateFormat: 'yy-mm-dd', 
                            showSecond: true, 
                            timeFormat: 'HH:mm:ss',
                            onClose:function(current_time){
                                start_date_change=current_time;
                            }
                    }); 
            $( "#endtime" ).datetimepicker({
                            dateFormat: 'yy-mm-dd', 
                            showSecond: true, 
                            timeFormat: 'HH:mm:ss',
                            onClose:function(current_time){
                                end_date_change=current_time;
                            }
                    });
                    
            $('select#state')[0].selectedIndex= post_state;
                
            $('select#state').change(function(){
                post_state=$("select#state")[0].selectedIndex;
            });
            $('input#titleText').change(function(){
                titleText=$('input#titleText').val();
            });
            $('input#contentText').change(function(){
                contentText=$('input#contentText').val();
            });
            $('input#text').change(function(){
                text=$('input#text').val();
            });
            $('input#URL').change(function(){
                URL=$('input#URL').val();
            });
    }); 
    
    var Submit=function(op_type){
        var URLs="edit.php";
        
        var opt_data={<?php ajaxDataList($class);?>};
        if(confirm("sure to "+op_type+"?")){
            $.ajax({
                url:URLs,
                type:"POST",
                dataType: 'text',
                data:opt_data,
                success: function(msg){
                    alert(op_type+" success "+msg);
                    $('div#test').text(msg);
            window.location.href="index.php";
                },
                error:function(){
                    alert(op_type+" error");
                }
            });
        }
    }
    
</script>
<table class="detail">
    <div id='test'></div>
<tr><td>ID</td><td><?php echo $id; ?></td></tr>
<tr><td>開始時間</td><td>
        
        <input class="textbox" id="starttime" type="text" name="starttime" value="<?php echo $row['startTime']; ?>" readonly />
<tr><td>結束時間</td><td>
        <input class="textbox" id="endtime" type="text" name="endtime" value="<?php echo $row['endTime']; ?>" readonly />
<?php 
if ($row['imageURL']!=NULL && $row['imageURL']!="") 
	echo "<tr><td>圖片檔案</td><td><img src='{$row['imageURL']}'></td><td><input class='textbox' type='file' name='img' /></td></tr>"; 
        
if($class=='must' || $class=='editor'){
	echo "<tr><td>標題</td><td><input id='titleText' value='{$row['titleText']}'></td></tr>"; 
	echo "<tr><td>描述</td><td><input id='contentText' value='{$row['contentText']}'></td></tr>"; 
}
else if($class=='recommend')
	echo "<tr><td>描述</td><td><input id='text' value='{$row['text']}'></td></tr>";	
?>
<tr><td>超連結</td><td><input id='URL' value='<?php echo $row['URL']; ?>'></td></tr>
<tr><td>狀態</td><td>
        <select id="state">
            <?php
                if($pre%2==0){
                    echo '<option value="0">公開</option>';
                }
                else if($pre%2==1) echo '<option value="1">焦點</option>';
            ?>
            <?php ?>
            <option value="2">隱藏</option>
        </select>
</td></tr>
<tr>
    <td>操作</td><td><a class="operator" onClick='Submit("remove")'>移除</a></td>
    <td><a class="operator" onClick='Submit("edit")'>編輯</a></td>
</tr>
</table>
</fieldset>
</div>
<!-- detail end -->

<?php
	require_once('footer.php'); 
?>
</html>
