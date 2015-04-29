<?php //require_once(dirname(__FILE__) . "/../conf.php"); ?>
	<meta charset="utf-8">
	<link type="text/css" rel="stylesheet" href="<?php echo $URLPv; ?>lib/std.css" />
        
</head>
<body class="outliner">
<?php require_once(dirname(__FILE__) . '/std.php'); ?>
<!-- 頁首區塊 start -->
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

<div class="header">
	<div class="header-logo">
		<p><a href="<?php echo $URLPv; ?>index.php"><img src="<?php echo $URLPv . "img/" . $logoName; ?>" /></a></p>
	</div>
	<div class="header-ad"><?php
            $query='select * from ad where state<2 order by aID desc limit 1;';
            $result=$DBmain->query($query);
            $row=$result->fetch_array(MYSQLI_BOTH);
            echo "<p><a href='{$row['URL']}'><img src='{$URLPv}{$row['imageURL']}' /></a></p>";
        ?>
	</div>
	<div class="header-option"><?php
            $result->free();
            $query='select * from `co-branding` where state<2 order by cID desc limit 1;';
            $result=$DBmain->query($query);
            $row=$result->fetch_array(MYSQLI_BOTH);
            echo "<p><a href='{$row['URL']}'><img src='{$URLPv}{$row['imageURL']}' /></a></p>";
            $result->free();
        ?>
	</div>
</div>
<!-- 頁首區塊 end -->
