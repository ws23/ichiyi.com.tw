<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="title" content"愛奇藝臺灣官方網站">
    <meta name="description" content="">
    <meta name="author" content="臺灣愛奇藝股份有限公司">

    <title>愛奇藝臺灣官方網站</title>

    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
	<link href="index.css" rel="stylesheet">
	<script src="jquery/jquery-1.11.2.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>

	<?php require_once('std.php'); ?> 
  </head>

  <body class="outliner">
	<!-- preprocess start-->
	<div id="fb-root"></div>

	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementByTagName(s)[0]; 
			if(d.getElementById(id)) return; 
			js = d.createElement(s); 
			js.id = id; 
			js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=748904491889773&version=v2.0"; 
			fjs.parentNode.insertBefore(js, fjs); 
		}(document, 'script', 'facebook-jssdk')); 
	</script>
<?php
	setLog($DBmain, 'info', 'into index', ''); 
	$now = date('Y-m-d H:o:s', time());
	
	require_once('updateState.php'); 
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
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img class="logo" src="img/logo.png"/></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">愛奇藝臺灣官方網站</a></li>
           <!-- <li><a href="#"></a></li>
            <li><a href="#"></a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

	<!-- header end -->

<!-- 首頁內容 start -->
<div class="body">
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

		<div class="content-focus">
		<?php
			$result->free(); 
			$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 1 ORDER BY `startTime` DESC LIMIT 1; ");
			$row = $result->fetch_array(MYSQLI_BOTH); 
		?>
			<a href="<?php echo $row['URL']; ?>"><img src="<?php echo $row['imageURL']; ?>" /></a>
			<h3><a href="<?php echo $row['URL']; ?>"><?php echo $row['titleText']; ?></a></h2>
		</div>
	</div>

                        
<!-- 首頁內容 end -->
<?php
	require_once('footer.php'); 
?>	
</html>

