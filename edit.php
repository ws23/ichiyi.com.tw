<?php
session_start();
require_once 'std.php';
$user_id=$_SESSION['USERNAME'];
$table=$_POST['table'];
$prikey=$_POST[getPriKeyFieldName($table)];

if($_GET['type']=='add'){
    
}
if($_POST['type']=='edit' && checkUser($DBmain,$user_id)){
    
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
    
    switch ($table) {
        case "must":
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateMust($DBmain,$prikey,$startTime,$endTime,$titleText,$contentText,$URL,$new_state);
            break;
        case "recommend":
            $text=$_POST['text'];
            updateRecommend($DBmain,$prikey,$startTime,$endTime,$text,$URL,$new_state);
            break;
        case "editor":
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateEditor($DBmain,$prikey,$startTime,$endTime,$titleText,$contentText,$URL,$new_state);
            break;
        case 'title':
            $titleText=$_POST['titleText'];
            $pre_state=getPreState($DBmain,$table,$prikey);
            updateTitle($DBmain,$prikey,$titleText,$URL,$new_state);
            break;
        case 'ad':
            $pre_state=getPreState($DBmain,$table,$prikey);
            updateAd($DBmain,$prikey,$URL,$new_state);
            break;
        case 'co-branding':
            $pre_state=getPreState($DBmain,$table,$prikey);
            updateCoBranding($DBmain,$prikey,$URL,$new_state);
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
    
    setLog($DBmain, "info","edit data (".$table.") ".getPriKeyFieldName($table)."=".$prikey,$user_id);
}
if($_POST['type']=='remove' && checkUser($DBmain,$user_id)){
    removeArticle($DBmain, $table, $prikey);
    
    setLog($DBmain, "info","remove data (".$table.") ".getPriKeyFieldName($table)."=".$prikey,$user_id);
}

require_once('stdEnd.php');
?>
