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
	document.getElementsByClassName('co-branding')[0].style.display = "none"; 
	document.getElementsByClassName('ad')[0].style.display = "none"; 
	document.getElementsByClassName('must')[0].style.display = "none"; 
	document.getElementsByClassName('recommend')[0].style.display = "none"; 
	document.getElementsByClassName('editor')[0].style.display = "none"; 
	document.getElementsByClassName('change')[0].style.display = "none"; 
	document.getElementsByClassName('add')[0].style.display = "none"; 
	document.getElementsByClassName('slogan')[0].style.display = "none"; 

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
        $("input.block").on('click',function(){
            var block=$("input.block:checked").val();
            $("div.add-ini").show();
            $('div.add-focus').show();
            $('div.add-time').show();
            $('div.add-title').show();
            $('div.add-description').show();
            $('div.add-url').show();
            $('div.add-img').show();
            if(block=="must"){
                $("input[name='title']").attr('maxlength','12');
                $("input[name='description']").attr('maxlength','14');
                $("div.add-title > input[name='url']").attr('maxlength','255');
                $("input[name='url']").attr("placeholder","長度限制255");
                $("input[name='title']").attr("placeholder","長度限制12");
                $("input[name='description']").attr("placeholder","長度限制14");
            }
            if(block=='recommend'){
                $("div.add-title > input[name='title']").attr('maxlength','12');
                $("div.add-title > input[name='description']").attr('maxlength','11');
                $("div.add-title > input[name='url']").attr('maxlength','255');
                $("input[name='url']").attr("placeholder","長度限制255");
                $("input[name='title']").attr("placeholder","長度限制12");
                $("input[name='description']").attr("placeholder","長度限制11");
                $('div.add-title').hide();
                if($('div.add-focus:checked').val()=='false')
                    $('div.add-img').hide();
            }
            if(block=='editor'){
                $("div.add-title > input[name='title']").attr('maxlength','12');
                $("div.add-title > input[name='description']").attr('maxlength','14');
                $("div.add-title > input[name='url']").attr('maxlength','255');
                $("input[name='url']").attr("placeholder","長度限制255");
                $("input[name='title']").attr("placeholder","長度限制12");
                $("input[name='description']").attr("placeholder","長度限制14");
                $('div.add-focus').hide();
            }
            if(block=='title'){
                $('div.add-focus').hide();
                $('div.add-time').hide();
                $('div.add-description').hide();
                $('div.add-img').hide();
                $("div.add-title > input[name='title']").attr('maxlength','11');
                $("div.add-title > input[name='url']").attr('maxlength','255');
                $("input[name='url']").attr("placeholder","長度限制255");
                $("input[name='title']").attr("placeholder","長度限制11");
            }
            if(block=='ad'||block=='co-branding'){
                $('div.add-focus').hide();
                $('div.add-time').hide();
                $('div.add-title').hide();
                $('div.add-description').hide();
                $("div.add-title > input[name='url']").attr('maxlength','255');
                $("input[name='url']").attr("placeholder","長度限制255");
            }
        } );
});

function checkEmpty(){
    if($("input[name='description']").val()!=''&&$("input[name='url']").val()!=''){
        if($("input[name='title']").val()!=''&&$('input[name="img"]').val()!='')
            return true;
        else if($('input.block:checked').val()=='recommend'&&!($('input[name="focus"]:checked').val()=='true'^$('input[name="img"]').val()!=''))
            return true;
    }
    else if($('input.block:checked').val()=='title'&&$("input[name='title']").val()!=''&&$("input[name='url']").val()!='')
        return true;
    var str='';
    if($("input[name='title']").is(':visible')&&$("input[name='title']").val()=='')
        str+='標題文字 ';
    if($("input[name='description']").is(':visible')&&$("input[name='description']").val()=='')
        str+='描述文字 ';
    if($("input[name='url']").is(':visible')&&$("input[name='url']").val()=='')
        str+='網站連結 ';
    if($("input[name='img']").is(':visible')&&$("input[name='img']").val()=='')
        str+='圖片上傳 ';
    if(str=='')
        return true;
    alert(str+"不能是空的");
    return false;
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
	<option value="slogan">管理「今日必看」右側連結</option>
	<option value="must">管理「今日必看」</option>
	<option value="recommend">管理「精彩推薦」</option>
	<option value="editor">管理「小編狂推」</option>
        <option value='ad'>管理「廣告」</option>
        <option value='co-branding'>管理「聯名網站」</option>
</select>

<div class="add">
<form action="adminOpt.php" method="post" enctype="multipart/form-data" onsubmit="return checkEmpty();">
<div class="add-block">
	<label>上傳區塊</label>
		<input type="radio" class="block" name="add-type" value="must" ><label>今日必看</label></input>
		<input type="radio" class="block" name="add-type" value="recommend" ><label>精彩推薦</label></input>
		<input type="radio" class="block" name="add-type" value="editor" ><label>小編狂推</label></input>
		<input type="radio" class="block" name="add-type" value="title" ><label>今日必看右側文字</label></input>
		<input type="radio" class="block" name="add-type" value="ad" ><label>廣告</label></input>
		<input type="radio" class="block" name="add-type" value="co-branding" ><label>聯名網站</label></input><br />
</div>
<div class="add-ini">
<div class="add-focus">
	<label>焦點資訊</label>
		<input class="radio" type="radio" name="focus" value="true" onclick="checkblock()"><label>是</label></input>
		<input class="radio" type="radio" name="focus" value="false" onclick="checkblock()" checked><label>否</label></input><br />
</div>
<div class="add-time">
	<label>發佈時間</label>
		<input class="textbox" id="starttime" type="text" name="starttime" value="<?php echo date('Y-m-d H:i:s', time()); ?>" readonly />
		<label> ~ </label>
		<input class="textbox" id="endtime" type="text" name="endtime" value="<?php echo date('Y-m-d H:i:s', time()+60*60*24); ?>" readonly /><br />
</div>
<div class="add-title">
	<label>標題文字</label>
		<input class="textbox" type="text" name="title" /><br />
</div>
<div class="add-description">
	<label>描述文字</label>
		<input class="textbox" type="text" name="description" /><br />
</div>
<div class="add-url">
	<label>網站連結</label>
		<input class="textbox" type="text" name="url" /><br />
</div>
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
	$result = $DBmain->query("SELECT * FROM `recommend` where state<4 ORDER BY `startTime` DESC; "); 
	
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
        $result->free();
	$now = date('Y-m-d H:i:s', time()); 
	$result = $DBmain->query("SELECT * FROM `must` where state<4 ORDER BY `startTime` DESC; "); 
	
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
        $result->free();
	$now = date('Y-m-d H:i:s', time()); 
	$result = $DBmain->query("SELECT * FROM `editor` where state<4 ORDER BY `startTime` DESC; "); 
	
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


<div class="slogan">
<?php
        $result->free();
	$result = $DBmain->query("SELECT * FROM `title` where state<4 ORDER BY `tID` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>標題</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['tID']}</td><td>{$row['titleText']}</td>"; 
		if($row['state']<=1)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=title&id={$row['tID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<div class='ad'>
<?php
        $result->free();
	$result = $DBmain->query("SELECT * FROM `ad` where state<4 ORDER BY `aID` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>超連結</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['aID']}</td><td>{$row['URL']}</td>"; 
		if($row['state']<=1)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=ad&id={$row['aID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<div class='co-branding'>
<?php
        $result->free();
	$result = $DBmain->query("SELECT * FROM `co-branding` where state<4 ORDER BY `cID` DESC; "); 
	
	echo '<table>'; 
	echo '<tr><th>ID</th><th>超連結</th><th>狀態</th><th>操作</th></tr>'; 
	while($row = $result->fetch_array(MYSQLI_BOTH)) {
		echo '<tr>'; 
		echo "<td>{$row['cID']}</td><td>{$row['URL']}</td>"; 
		if($row['state']<=1)
			echo '<td>公開</td>'; 
		else
			echo '<td>隱藏</td>'; 
		echo "<td><a href='detail.php?class=co-branding&id={$row['cID']}'>編輯/刪除</a></td>"; 
		echo '</tr>'; 
	}
	echo '</table>'; 
?>
</div>

<!-- Admin interface end -->
<?php require_once('footer.php'); ?>
