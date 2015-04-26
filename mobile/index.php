<!Doctype html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="title" content"愛奇藝臺灣官方網站">
  <meta name="description" content="">
  <meta name="author" content="臺灣愛奇藝股份有限公司">

  <title>愛奇藝臺灣官方網站</title>

  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="index.css" rel="stylesheet">
  <script src="../jquery/jquery-1.11.2.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>

  <?php require_once("../std.php"); ?> 
  
 </head>


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
						<a class="navbar-brand" href="index.php"><img class="logo" src="../img/logo.png"/></a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="index.php">愛奇藝臺灣官方網站</a>
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

<div class="jumbotron">
	<!-- 今日必看 start -->
<div class="page-header">
<a name="must"></a>
<p>今日必看</p>
<div class="row">
<table class="table table-hover">
<thead>
<tr>
	<th class="col-xs-2 col-sm-2"><img src="../img/2015-04-18-mouse.jpg" class="img-thumbnail"/></th>
	<th class="col-xs-3 col-sm-3">我是內文我是內文我是內文我是內文我是內文我是內文我是內文我</th>
</tr>
</thead>
<tbody>
<?php
	$result = $DBmain->query("SELECT * FROM `must` WHERE `state` = 0 ORDER BY `startTime` DESC LIMIT 6; "); 
	while($row = $result->fetch_array(MYSQLI_BOTH)){
	?>
<tr>
	<td class="col-xs-2 col-sm-2">
		<img src="../<?php echo $row['imageURL']; ?>" class="img-thumbnail"/>
	</td>
	<td class="col-xs-3 col-sm-3">
		<a href="<?php echo $row['URL']; ?>">
			<strong><?php echo $row['titleText']; ?></strong><br />
			<?php echo $row['contentText']; ?>
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
	<!-- 今日必看 end -->

	<!-- 精彩推薦 start -->

	<!-- 精彩推薦 end -->

	<!-- 小編狂推 start -->

	<!-- 小編狂推 end -->

</div>
<!-- body end -->

<!-- footer start -->

<!-- footer end -->

</body>
</html>
