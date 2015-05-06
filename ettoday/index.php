<!DOCTYPE html>
<?php
	$useragent = $_SERVER['HTTP_USER_AGENT'];

	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
			echo "<script>window.top.location.replace('m/index.php')</script>"; 
?>

<?php require_once('config.php');  ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="<?php echo $URLPv . "img/" . $iconName; ?>" type="image/x-icon">
    <link rel="icon" href="<?php echo $URLPv . "img/" . $iconName; ?>" type="image/x-icon">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content"愛奇藝臺灣官方網站">
    <meta name="description" content="">
    <meta name="author" content="臺灣愛奇藝股份有限公司">

    <title><?php echo $titleName; ?></title>

    <link href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="index.css" rel="stylesheet">
	<script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
	<script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>

	<?php require_once(dirname(__FILE__) . '/../lib/std.php'); ?> 
<!-- Begin comScore Tag -->
	<script>
		var _comscore = _comscore || [];
		_comscore.push({ c1: "2", c2: "17985150" });
		(function() {
			var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
			s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
			el.parentNode.insertBefore(s, el);
		})();
	</script>
	<noscript>
		<img src="http://b.scorecardresearch.com/p?c1=2&c2=17985150&cv=2.0&cj=1" />
	</noscript>
<!-- End comScore Tag -->
  </head>

  <body class="outliner">
	<!-- preprocess start-->
<?php include_once("analyticstracking.php") ?>
	<div id="fb-root"></div>

	<script>
	    (function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		    if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			    js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=748904491889773&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

<?php
	setLog($DBmain, 'info', 'into index', ''); 
	$now = date('Y-m-d H:o:s', time());
	
	require_once(dirname(__FILE__) . "/../lib/updateState.php"); 
?>
	<!-- preprocess end -->


	<!-- header start-->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
		  <a class="navbar-brand" href="index.php"><img class="logo" src="<?php echo $URLPv . "img/" . $logoName; ?>"/></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="https://www.facebook.com/pps.iqiyi" target="_blank">
					粉絲團
					<img class="header-like" src="<?php echo $URLPv; ?>img/fblike.png" />
				</a>
			</li>
			<li>
				<div class="fblinkamount"><img class="amount" src="<?php echo $URLPv; ?>img/amount.png" />
				<?php echo getFacebookLikeAmount("http://www.facebook.com/pps.iqiyi"); ?></a>
				</div>
			</li>

            <li><a href="mailto:service@iqiyi.com.tw" target="_blank">聯絡我們</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- header end -->

<!-- 首頁內容 start -->
	
	<!-- 今日必看 start -->
	<div class="must">

		<h1>今日必看</h1>
			<!-- 今日必看右側文字-->
			<p class="must-list">
			<?php
				$result = $DBmain->query("SELECT * FROM `title` WHERE `state` < 2 ORDER BY `tID` DESC LIMIT 6; "); 
				$i = 0; 

				while($row = $result->fetch_array(MYSQLI_BOTH)){
					if($i>0)
						echo ' / '; 
					echo "<a href=\"{$row['URL']}\">{$row['titleText']}</a>"; 
					$i++; 
				}
			?>
			</p>
			
			<hr />

		<!-- 今日必看 焦點 -->
		<div class="content-focus">
		<?php
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 1 ORDER BY `startTime` DESC LIMIT 1; ");
			$row = $result->fetch_array(MYSQLI_BOTH); 
		?>
			<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $URLPv . $row['imageURL']; ?>" /></a>
			<h3><a href="<?php echo $row['URL']; ?>"><?php echo $row['titleText']; ?></a></h3>
			<p><a href="<?php echo $row['URL']; ?>"><?php echo $row['contentText']; ?></a></p>
			<div class="emphasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
			<img class="must-today" src="<?php echo $URLPv; ?>img/today.png">

		</div>

		<!-- 今日必看 col*row 項目 -->
		<?php
			$result->free(); 
			$posWidth = 399; 
			$posHeight = 81;
			$width = 184; 
			$height = 165; 
			$colNum = 3; 
			$rowNum = 2; 
			$limit = $colNum * $rowNum; 
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT {$limit}; ");
			$i = $j = 0; 
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$w = $posWidth + $j*($width+10); 
				$h = $posHeight + $i*($height+10); 
		?>
			<div class="content-formal" style="top: <?php echo $h; ?>px; left: <?php echo $w; ?>px; ">
				<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $URLPv . $row['imageURL']; ?>" /></a>
				<h3><a href="<?php echo $row['URL']; ?>"><?php echo $row['titleText']; ?></a></h3>
				<p><a href="<?php echo $row['URL']; ?>"><?php echo $row['contentText']; ?></a></p>
				<div class="emphasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
			</div>
		<?php
				if($j==$colNum-1){
					$j = 0; 
					$i++; 	
				}
				else {
					$j++; 	
				}
			}
		?>
	</div>
	<!-- 今日必看 end -->

	<!-- 精彩推薦 start-->
	<div class="recommend">
		<h1>精彩推薦</h1>
		<hr />
		<div class="content-recommend">
			<!-- 精彩推薦 焦點 -->
			<?php 
				$result->free();
				$limit = 10;  
				$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 1 ORDER BY `startTime` DESC LIMIT 1; "); 
				$row = $result->fetch_array(MYSQLI_BOTH); 
				if(isset($row)){
					?>
					<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $URLPv . $row['imageURL']; ?>" /></a>
					<h3><a href="<?php echo $row['URL']; ?>"><?php echo $row['text']; ?></a></h3>
					<?php		
					$limit = 6; 
				}

			?>
		
			<hr />
			
			<!-- 精彩推薦 一般 -->
			<?php 
				$result->free(); 
				$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT {$limit}; "); 
				while($row = $result->fetch_array(MYSQLI_BOTH)){
				?>
					<p><a href="<?php echo $row['URL']; ?>"><?php echo $row['text']; ?></a></p>
				<?php	
				}
			?>


		</div>
	</div>
    
	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->
	<div class="editor">
		<h1>小編狂推</h1>
		<hr />
		<!-- col*row 項目 -->
		<?php
			$result->free(); 
			$posWidth = 0; 
			$posHeight = 81;
			$width = 184; 
			$height = 165; 
			$colNum = 6; 
			$rowNum = 2; 
			$limit = $colNum * $rowNum; 
			$result = $DBmain->query("SELECT * FROM `editor` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT {$limit}; ");
			$i = $j = 0; 
			while($row = $result->fetch_array(MYSQLI_BOTH)){
				$w = $posWidth + $j*($width+10); 
				$h = $posHeight + $i*($height+10); 
		?>
			<div class="content-formal" style="top: <?php echo $h; ?>px; left: <?php echo $w; ?>px; ">
				<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $URLPv . $row['imageURL']; ?>" /></a>
				<h3><a href="<?php echo $row['URL']; ?>"><?php echo $row['titleText']; ?></a></h3>
				<p><a href="<?php echo $row['URL']; ?>"><?php echo $row['contentText']; ?></a></p>
				<div class="emphasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
			</div>
		<?php
				if($j==$colNum-1){
					$j = 0; 
					$i++; 	
				}
				else {
					$j++; 	
				}
			}
		?>
	</div>
	<!-- 小編狂推 end -->
<!-- 首頁內容 end -->

<?php
	require_once(dirname(__FILE__) . "/../lib/footer.php"); 
?>	
</html>

