<?php	/* standard function definitions */

/* To get the IP address of client */
function getIP() {
	if(!empty($_SERVER['REMOTE_ADDR']))
		$ip = $_SERVER['REMOTE_ADDR'];
	if(!empty($_SERVER['HTTP_X_FORWADED_FOR'])) {
		$ips = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']); 
		if($ip) {
			array_unshift($ips, $ip); 
			$ip = false; 
		}
		for($i=0; $i<count($ips); $i++) {
			if(!eregi("^(10|172.16|192.168).", $ips[$i])) {
				$ip = $ips[$i]; 
				break;	
			}
		}
	}
	return $ip; 
}

/* Log, Need Database (MYSQL) */
function setLog($DBlink, $type="info", $content, $user){
	$ip = getIP(); 
	$url = $_SERVER['REQUEST_URI']; 
	$DBlink->query("INSERT INTO `log`(`type`, `msg`, `user`, `site`, `IP`) VALUES ('{$type}', '{$content}', '{$user}', '{$url}', '{$ip}'); "); 
}

/* alert */
function alert($msg) {
	echo "<script>alert('{$msg}')</script>"; 	
}

/* location */
function locate($url) {
	echo "<script> window.location.href='{$url}'; </script>"; 
}

//20150317
function updateUser($DBlink,$uID,$userName,$password,$nickName,$email,$authority){
    $table="user";
    $query="update ".$table." set uID='".$uID."',userName='".$userName."',password='".$password.
            "',nickName='".$nickName."',email='".$email."',authority='".$authority.
            "' where ".getPriKeyFieldName($table)."=".$uID.";";
    $DBlink->query($query);
}

//20150317 neeed to change
function updateMust($DBlink,$mID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state){
    $table="must";
    $query="update ".$table." set mID='".$mID."',startTime='".$startTime."',endTime='".$endTime.
            "',imageURL='".$imageURL."',titleText='".$titleText."',contentText='".$contentText.
            "',URL='".$URL."',state='".$state.
            "' where ".getPriKeyFieldName($table)."=".$mID.";";
    $DBlink->query($query);
}

//20150317 neeed to change
function updateRecommend($DBlink,$rID,$startTime,$endTime,$imageURL,$text,$URL,$state){
    $table="recommend";
    $query="update ".$table." set rID='".$rID."',startTime='".$startTime."',endTime='".$endTime.
            "',imageURL='".$imageURL."',text='".$text.
            "',URL='".$URL."',state='".$state.
            "' where ".getPriKeyFieldName($table)."=".$rID.";";
    $DBlink->query($query);
}

//20150317 neeed to change
function updateEditor($DBlink,$eID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state){
    $table="editor";
    $query="update ".$table." set eID='".$eID."',startTime='".$startTime."',endTime='".$endTime.
            "',imageURL='".$imageURL."',titleText='".$titleText."',contentText='".$contentText.
            "',URL='".$URL."',state='".$state.
            "' where ".getPriKeyFieldName($table)."=".$eID.";";
    $DBlink->query($query);
}

//20150316
function removeArticle($DBlink,$table,$priKey){
    $query="delete from ".$table." where ".getPriKeyFieldName($table)."=".$priKey.";";
    $DBlink->query($query);
}
//20150316
function getPriKeyFieldName($table){
    $field="";
    switch($table){
        case 'editor':
            $field='eID';
            break;
        case 'log':
            $field='lID';
            break;
        case 'main':
            break;
        case 'must':
            $field='mID';
            break;
        case 'recommend':
            $field='rID';
            break;
        case 'user':
            $field="uID";
            break;
    }
    return $field;
}

//20150316
//
//$layout=> "standard","box_count","button_count","button"
//
function getFacebookLikeFormatLink($href,$layout){
    $data_layout="standard";
    if(isset($layout)&&isFacebookLikeDataLayout($layout))$data_layout=$layout;
    return '<div class="fb-like" data-href="'.$href.'" data-width="40" data-layout="'.$data_layout.'" data-action="like" data-show-faces="true" data-share="true"></div>';
}

//20150316
function isFacebookLikeDataLayout($layout){
    switch ($layout){
        case 'standard':
        case 'box_count':
        case 'button_count':
        case 'button':
            return true;
        default :
            return false;
    }
}

//20150316
//need to enhance
function checkUser($DBLink,$user_id){
    if(isset($user_id)){
        $DBLink->query("select * from user where uID='".$user_id."';");
        if($DBLink->num_rows>1){
            setLog($DBlink, $type="warning", "multiple user id : ".$user_id, $user_id);
            return false;
        }
        return true;
    }
    else
        return false;
}



?>
