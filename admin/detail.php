<?php session_start(); ?>
<?php require_once(dirname(__FILE__) . "/../config.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>愛奇藝股份有限公司</title>
	<meta name="title" content="愛奇藝" />
	<link type="text/css" rel="stylesheet" href="admin.css" />
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo $URLPv; ?>lib/jquery/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo $URLPv; ?>lib/jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo $URLPv; ?>lib/jquery/jquery-ui-timepicker-addon.css" />
    <script src="<?php echo $URLPv; ?>lib/jquery/jquery-ui.js"></script>
    <script src="<?php echo $URLPv; ?>lib/jquery/jquery-ui-sliderAccess.js"></script>
    <script src="<?php echo $URLPv; ?>lib/jquery/jquery-ui-timepicker-addon.js"></script>
	
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
	require_once(dirname(__FILE__) . '/../lib/header.php'); 
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
        $idName=getPriKeyFieldName($class);
//	if($class=='must')
//		$idName = 'mID'; 
//	else if($class=='recommend')
//		$idName = 'rID'; 
//	else if($class=='editor')
//		$idName = 'eID'; 

	$result = $DBmain->query("SELECT * FROM `{$class}` WHERE `{$idName}` = {$id}; "); 
	$row = $result->fetch_array(MYSQLI_BOTH); 
        if($row['state']>3){
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: {$URLPv}index.php");
            }
?>
<script>
    var table="<?php echo $class;?>";
    var id="<?php echo $id;?>";
    var start_date_change='<?php echo $row['startTime'];?>';
    var end_date_change='<?php echo $row['endTime'];?>';
    var imageURL='<?php echo $URLPv . $row['imageURL'];?>';
    var image_width="<?php echo getImageWidth($class,$pre);?>";
    var image_height="<?php echo getImageHeight($class,$pre);?>";
    var URL='<?php echo $row['URL'];?>';
    <?php
    if($class=='editor'||$class=='must'||$class=='title'){
	echo "var titleText='{$row['titleText']}';\n";
	echo "var contentText='{$row['contentText']}';\n";
    }
    if($class=='recommend')
	echo "var text='{$row['text']}';\n";
    ?>
    var post_state=<?php
        echo $row['state']>1?1:0;
            ?>;
                
    var files;
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
            
            $("#fileupload").change(function (e) {
            var F = this.files;
            readImage(F[0]);
            });
            
    }); 
    
// Grab the files and set them to our variable
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
    };
    
    var SubmitImage=function(){
    
	$("#SubmitImage").submit(function(e)
	{
		var formData = new FormData(this);
                formData.append('table',table);
                formData.append('id',id);
		var formURL = $(this).attr("action");
		$.ajax(
		{
			url : formURL,
			type: "POST",
			data:  formData,
			contentType: false,
                        processData:false,
                        cache: false,
			success:function(data) 
			{
                            alert(data);
			},
			error: function() 
			{
			}
		});
	    e.preventDefault();	//STOP default action
	    e.unbind();
	});
		
	$("#SubmitImage").submit(); //SUBMIT FORM
    };
    
    function readImage(file) {

        var reader = new FileReader();
        var image  = new Image();

        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
            image.src    = _file.target.result;              // url.createObjectURL(file);
            image.onload = function() {
                var w = this.width,
                    h = this.height;
                if(w!=image_width||h!=image_height){
                    alert("圖片尺寸應為 "+image_width+" * "+image_height);
                    $("#SubmitImageButton").attr('disabled', true);
                }
                else
                    $("#SubmitImageButton").attr('disabled', false);
            };
            image.onerror= function() {
                alert('Invalid file type: '+ file.type);
            };      
        };

    }
    
</script>
<div id="test"></div>
<table class="detail">
<tr><td>ID</td><td><?php echo $id; ?></td></tr>
        <?php
        if($class!='title'&&$class!='ad'&&$class!='co-branding')
echo <<<END
            
<tr><td>開始時間</td><td>
        <input class="textbox" id="starttime" type="text" name="starttime" value="{$row['startTime']}" readonly />
<tr><td>結束時間</td><td>
        <input class="textbox" id="endtime" type="text" name="endtime" value="{$row['endTime']}" readonly />
END;
        ?>
<?php 
if ($class!='title'||($class=='recommend'&&$row['state']%2!=0)){
	echo "<tr><td>圖片檔案</td><td><img src='{$URLPv}{$row['imageURL']}'></td>";
        echo "<td><form id='SubmitImage' method='post' action='image.php' >";
        echo "<input id='fileupload' type='file' name='image' value='{$row['imageURL']}'/><input id='SubmitImageButton' type='button' onClick='SubmitImage();' value='上傳圖片' /></form></td></tr>"; 
}
if($class=='must' || $class=='editor'){
	echo "<tr><td>標題</td><td><input id='titleText' name='titletext' value='{$row['titleText']}'></td></tr>"; 
	echo "<tr><td>描述</td><td><input id='contentText' name='contenttext' value='{$row['contentText']}'></td></tr>"; 
}
else if($class=='recommend')
	echo "<tr><td>描述</td><td><input id='text' value='{$row['text']}'></td></tr>";	
else if($class=='title')
	echo "<tr><td>標題</td><td><input id='titleText' value='{$row['titleText']}'></td></tr>"; 
?>
<tr><td>超連結</td><td><input id='URL' name='url' value='<?php echo $row['URL']; ?>'></td></tr>
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
    <td>操作</td><td><input type="button" class="operator" onClick='Submit("remove")' value="移除"></td>
    <td><input type="button" class="operator" onClick='Submit("edit")' value="編輯"></td>
</tr>
</table>
</fieldset>
</div>
<!-- detail end -->

<?php
	require_once(dirname(__FILE__) . '/../lib/footer.php'); 
?>
</html>
