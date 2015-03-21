<?php
session_start();
require_once 'std.php';
$user_id=$_SESSION['USERNAME'];
$table=$_POST['table'];
$prikey=$_POST[getPriKeyFieldName($table)];
if($_GET['type']=='add'){
    
}
if($_POST['type']=='edit' && checkUser($DBmain,$user_id)){
    
    setLog($DBmain, "info","edit data (".$table.") ".getPriKeyFieldName($table)."=".$prikey,$user_id);
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $state=$_POST['state'];
    $pre_state=getPreState($DBmain,$table,$prikey);
    $new_state='';
    if($pre_state>3){
            $state=$pre_state;
    }
    else{
            if($pre_state%2==1)
                $new_state=($state==0)?1:3;
            if($pre_state%2==0)
                $new_state=($state==0)?0:2;
    }
    $URL=$_POST['URL'];
    if($state%2==0){
        $file=$_SESSION['upload_progress_'.intval($_POST['PHP_SESSION_UPLOAD_PROGRESS'])];
		$now = date('Y-m-d', time()); 
			$imgURL = "img/{$now}-{$file['name']}"; 
			move_uploaded_file($file['tmp_name'], $imgURL); 
    $imageURL=$_POST['imageURL'];
    }
//		$imgURL = "img/{$now}-{$_FILES['img']['name']}"; 
    switch ($table) {
        case "must":
            $mID=$_POST['mID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateMust($DBmain,$mID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$new_state);
            break;
        case "recommend":
            $rID=$_POST['rID'];
            $text=$_POST['text'];
            updateRecommend($DBmain,$rID,$startTime,$endTime,$imageURL,$text,$URL,$new_state);
            break;
        case "editor":
            $eID=$_POST['eID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateEditor($DBmain,$eID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$new_state);
            break;
        case 'title':
            $titleText=$_POST['titleText'];
            $pre_state=getPreState($DBmain,$table,$prikey);
            updateTitle($DBmain,$prikey,$titleText,$URL,$new_state);
            break;
//        case "user":
//            $uID=$_POST['uID'];
//            $userName=$_POST['userName'];
//            $password=$_POST['password'];
//            $nickName=$_POST['nickName'];
//            $email=$_POST['email'];
//            $authority=$_POST['authority'];
//            updateUser($DBmain,$uID,$userName,$password,$nickName,$email,$authority);
//            break;
        default:
            break;
    }
}
if($_POST['type']=='remove' && checkUser($DBmain,$user_id)){
    setLog($DBmain, "info","remove data (".$table.") ".getPriKeyFieldName($table)."=".$prikey,$user_id);
    removeArticle($DBmain, $table, $prikey);
//    locate("index.php");
}

?>
