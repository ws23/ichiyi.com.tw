<?php require_once(dirname(__FILE__) . "/../config.php"); ?>
<!Doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="<?php echo $URLPv. "img/" . $iconName; ?>" type="image/x-icon">
  <link rel="icon" href="<?php echo $URLPv . "img/" . $iconName; ?>" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="title" content"<?php echo $titleName; ?>">
  <meta name="description" content="">
  <meta name="author" content="臺灣愛奇藝股份有限公司">

  <title><?php echo $titleName; ?></title>

  <link href="<?php echo $URLPv; ?>lib/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <script src="<?php echo $URLPv; ?>lib/jquery/jquery-1.11.2.js"></script>
  <script src="<?php echo $URLPv; ?>lib/bootstrap/js/bootstrap.js"></script>
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
  <?php require_once(dirname(__FILE__) . "/../../lib/std.php"); ?> 
  
 </head>

<!-- preprocess start -->

<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0]; 
		if(d.getElementById(id))	
			return; 
		js = d.createElement(s); 
		js.id = id; 
		js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=748904491889773&version=v2.0"; 
		fjs.parentNode.insertBefore(js, fjs); 
	}(document, 'script', 'facebook-jssdk')); 
</script>


<?php
    setLog($DBmain, 'info', 'into index(mobile)', ''); 
    $now = date('Y-m-d H:o:s', time());
	include_once(dirname(__FILE__) . "/../../analyticstracking.php");     
    require_once(dirname(__FILE__) . '/../../lib/updateState.php'); 
?>
<!-- preprocess end -->


<!-- header start -->
<body role="ducument">

		<!-- Fixed navbar -->
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="index.php"><img class="logo" src="<?php echo $URLPv . "img/" . $logoName; ?>"/></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="#must">今日必看</a></li>
							<li><a href="#recommend">精彩推薦</a></li>
							<li><a href="#editor">小編狂推</a></li>
							<li><a href="https://www.facebook.com/pps.iqiyi">粉絲專頁</a></li>
							<li><a href="mailto:service@iqiyi.com.tw">聯絡我們</a></li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</nav>

		<!-- Fixed navbar -->

<!-- header end -->

<!-- body start -->

<div class="container">
<div class="jumbotron">
	<!-- 今日必看 start -->
<div class="page-header">
<a name="must"></a>
<p>今日必看</p>
<div class="row">
<table class="table table-hover">
<thead>
<tr>
	<th colspan="2">
	<?php
		$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 1 ORDER BY `startTime` DESC LIMIT 1; "); 
		$row = $result->fetch_array(MYSQLI_BOTH); 
	?>
		<a href="<?php echo $row['URL']; ?>">
			<img src="<?php echo $URLPv . $row['imageURL']; ?>" class="img-thumbnail"/><br />
			<strong>&nbsp;&nbsp;<?php echo $row['titleText']; ?></strong><br />
			&nbsp;&nbsp;<?php echo $row['contentText']; ?>
		</a>
		<div class="emphasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
	</th>
</tr>
</thead>
<tbody>
<?php
	$result->free(); 
	$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT 6; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)){
	?>
<tr>
	<td class="col-xs-2 col-sm-2">
		<a href="<?php echo $row['URL']; ?>">
			<img src="<?php echo $URLPv . $row['imageURL']; ?>" class="img-thumbnail"/>
		</a>
	</td>
	<td class="col-xs-3 col-sm-3">
		<a href="<?php echo $row['URL']; ?>">
			<strong><?php echo $row['titleText']; ?></strong><br />
			<?php echo $row['contentText']; ?>
		</a>
		<div class="emphasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
	</td>
</tr>
	<?php
	}
?>
</tbody>
</table>
</div>
</div>
	<!-- 今日必看 end -->

	<!-- 精彩推薦 start -->
<div class="page-header">
<a name="recommend"></a>
<p>精彩推薦</p>
<div class="row">
<table class="table table-hover">
<thead>
<tr>
	<th class="col-xs-1 col-sm-1">
	<?php
		$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 1 ORDER BY `startTime` DESC LIMIT 1; "); 
		$row = $result->fetch_array(MYSQLI_BOTH); 
	?>
		<a href="<?php echo $row['URL']; ?>">
		<img src="<?php echo $URLPv . $row['imageURL']; ?>" class="img-thumbnail"/><br />
			&nbsp;&nbsp;<?php echo $row['text']; ?>
		</a>
	</th>
</tr>
</thead>
<tbody>
<?php
	$result->free(); 
	$result = $DBmain->query("SELECT * FROM `recommend` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT 6; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)){
	?>
<tr>
	<td class="col-xs-2 col-sm-2">
		<a href="<?php echo $row['URL']; ?>">
			&nbsp;&nbsp;<?php echo $row['text']; ?>
		</a>
	</td>
</tr>
	<?php
	}
?>
</tbody>
</table>
</div>
</div>
	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->
<div class="page-header">
<a name="editor"></a>
<p>小編狂推</p>
<div class="row">
<table class="table table-hover">
<tbody>
<?php
	$result->free(); 
	$result = $DBmain->query("SELECT * FROM `editor` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT 12; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)){
	?>
<tr>
	<td class="col-xs-2 col-sm-2">
		<a href="<?php echo $row['URL']; ?>">
			<img src="<?php echo $URLPv . $row['imageURL']; ?>" class="img-thumbnail"/>
		</a>
	</td>
	<td class="col-xs-3 col-sm-3">
		<a href="<?php echo $row['URL']; ?>">
			<strong><?php echo $row['titleText']; ?></strong><br />
			<?php echo $row['contentText']; ?>
		</a>
		<div class="empasize-color"><?php echo getFacebookLikeFormatLink($row['URL'], "button_count"); ?></div>
	</td>
</tr>
	<?php
	}
?>
</tbody>
</table>
</div>
</div>
	<!-- 小編狂推 end -->
</div>
<!-- body end -->

<!-- footer start -->
<div class="page-header">
<h6 class="text-center">臺灣愛奇藝股份有限公司</h6>
<h6 class="text-center"><a href="mailto:service@iqiyi.com.tw">service@iqiyi.com.tw</a></h6>
</div>
<!-- footer end -->
</div>
</body>
</html>
