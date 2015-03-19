<?php
session_start();
require_once 'std.php';
$user_id=$_SESSION['USERNAME'];
$table=$_POST['table'];
$prikey=$_POST['id'];

if($_GET['type']=='add'){
    
}
if($_POST['type']=='edit' && checkUser($DBmain,$user_id)){
    echo 'POST';
    setLog($DBmain, "info","edit data (".$table.")",$user_id);
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $state=$_POST['state'];
    $imageURL=$_POST['imageURL'];
		$imgURL = "img/{$now}-{$_FILES['img']['name']}"; 
    $URL=$_POST['URL'];
    switch ($table) {
        case "must":
            $mID=$_POST['mID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            $pre_state=getPreState($DBmain,$table,$mID);
            $new_state='';
            if($pre_state%2==1)
                $new_state=$state==1?3:1;
            if($pre_state%2==0)
                $new_state=$state==0?2:0;
            updateMust($DBmain,$mID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$new_state);
            break;
        case "recommend":
            $rID=$_POST['rID'];
            $text=$_POST['text'];
            $pre_state=getPreState($DBmain,$table,$rID);
            $new_state='';
            if($pre_state%2==1)
                $new_state=$state==1?3:1;
            if($pre_state%2==0)
                $new_state=$state==0?2:0;
            updateRecommend($DBmain,$rID,$startTime,$endTime,$imageURL,$text,$URL,$new_state);
            break;
        case "editor":
            $eID=$_POST['eID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            $pre_state=getPreState($DBmain,$table,$eID);
            $new_state='';
            if($pre_state%2==1)
                $new_state=$state==1?3:1;
            if($pre_state%2==0)
                $new_state=$state==1?2:0;
            updateEditor($DBmain,$eID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$new_state);
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
    setLog($DBmain, "info","remove data (".$table.")",$user_id);
    removeArticle($DBmain, $table, $prikey);
//    locate("index.php");
}

?>
