<?php
session_start();
require_once 'std.php';
$user_id=$_SESSION['USERNAME'];
$table=$_POST['table'];
$prikey=$_POST['id'];
echo $table.'<br/>';
echo $prikey.'<br/>';
echo $_GET['type'].'<br/>';

if($_GET['type']=='add'){
    
}
if($_POST['type']=='edit'){
    echo 'POST';
    setLog($DBmain, "info","update data (".$table.")",$user_id);
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $state=$_POST['state'];
    $imageURL=$_POST['imageURL'];
    $URL=$_POST['URL'];
    switch ($table) {
        case "must":
            $mID=$_POST['mID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateMust($DBmain,$mID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state);
            break;
        case "recommend":
            $rID=$_POST['rID'];
            $text=$_POST['text'];
            updateRecommend($DBmain,$rID,$startTime,$endTime,$imageURL,$text,$URL,$state);
            break;
        case "editor":
            $eID=$_POST['eID'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            updateEditor($DBmain,$eID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state);
            break;
        case "user":
            $uID=$_POST['uID'];
            $userName=$_POST['userName'];
            $password=$_POST['password'];
            $nickName=$_POST['nickName'];
            $email=$_POST['email'];
            $authority=$_POST['authority'];
            updateUser($DBmain,$uID,$userName,$password,$nickName,$email,$authority);
            break;
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
