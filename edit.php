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
if($_SESSION['type']=='edit'){
    setLog($DBmain, "info","update data (".$table.")",$user_id);
    switch ($table) {
        case "must":
            $mID=$_POST['mID'];
            $startTime=$_POST['startTime'];
            $endTime=$_POST['endTime'];
            $imageURL=$_POST['imageURL'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            $URL=$_POST['URL'];
            $state=$_POST['state'];
            updateMust($DBlink,$mID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state);
            break;
        case "recommend":
            $rID=$_POST['rID'];
            $startTime=$_POST['startTime'];
            $endTime=$_POST['endTime'];
            $imageURL=$_POST['imageURL'];
            $text=$_POST['text'];
            $URL=$_POST['URL'];
            $state=$_POST['state'];
            updateRecommend($DBlink,$rID,$startTime,$endTime,$imageURL,$text,$URL,$state);
            break;
        case "editor":
            $eID=$_POST['eID'];
            $startTime=$_POST['startTime'];
            $endTime=$_POST['endTime'];
            $imageURL=$_POST['imageURL'];
            $titleText=$_POST['titleText'];
            $contentText=$_POST['contentText'];
            $URL=$_POST['URL'];
            $state=$_POST['state'];
            updateEditor($DBlink,$eID,$startTime,$endTime,$imageURL,$titleText,$contentText,$URL,$state);
            break;
        case "user":
            $uID=$_POST['uID'];
            $userName=$_POST['userName'];
            $password=$_POST['password'];
            $nickName=$_POST['nickName'];
            $email=$_POST['email'];
            $authority=$_POST['authority'];
            updateUser($DBlink,$uID,$userName,$password,$nickName,$email,$authority);
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
