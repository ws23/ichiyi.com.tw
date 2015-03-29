<?php
    session_start();
    require_once 'std.php';
    $user_id=$_SESSION['USERNAME'];
    $file=$_FILES['image'];
    $pattern='/^.*\.(png|jpg)$/i';
    $file_name=$file['name'];
    $id=$_POST['id'];
    $table=$_POST['table'];
    $pre_state=getPreState($DBmain,$table,$id);
    
    //$flag only has three number
    //0:SUCCESS UPLOAD
    //1:FAIL TO UPLOAD , FILE TYPE ERROR , IMAGE SIZE ERROR
    //2:ILLEGAL UPLOADING
    //
    $flag=-1;
    
    if(preg_match($pattern,$file_name)&&checkUser($DBmain,$user_id)){
        $now = date('Y-m-d', time());
        $imgURL = "img/test{$now}-{$file['name']}";
        move_uploaded_file($file['tmp_name'], $imgURL);
        $image_size=  getimagesize($imgURL);

        if($table=='recommend'){
            switch ($pre_state%2) {
                case 1:
                    if(!isFocusImageSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 380 * 270.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                default:
                    if(!unlink($imgURL)) $flag=2;
                    else $flag=1;
                    break;
            }
        }

        if($table=='editor'){
            switch ($pre_state%2) {
                case 0:
                    if(!isImageSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 180 * 101.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                default:
                    if(!unlink($imgURL)) $flag=2;
                    else $flag=1;
                    break;
            }
        }

        if($table=='must'){
            switch ($pre_state%2) {
                case 0:
                    if(!isImageSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 180 * 101.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                case 1:
                    if(!isFocusImageSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 380 * 270.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                default:
                    if(!unlink($imgURL)) $flag=2;
                    else $flag=1;
                    break;
            }
        }
        
        if($table=='ad'){
            switch ($pre_state%2) {
                case 0:
                    if(!isAdSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 728 * 90.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                default:
                    if(!unlink($imgURL)) $flag=2;
                    else $flag=1;
                    break;
            }
        }
        
        if($table=='co-branding'){
            switch ($pre_state%2) {
                case 0:
                    if(!isCoBrandingSizeLegal($image_size[0],$image_size[1])){
                        if(!unlink($imgURL)) $flag=2;
                        else echo '圖片尺寸應為 90 * 90.';
                        break;
                    }
                    else
                        $flag=0;
                    break;
                default:
                    if(!unlink($imgURL)) $flag=2;
                    else $flag=1;
                    break;
            }
        }
        
        if($flag==0){
            uploadImage($DBmain,$table,$id,$imgURL);
            setLog($DBmain, "info", 'file be uploaded : '.$file['name'], $user_id);
            echo '圖片上傳成功';
        }
        else if($flag==1){
            setLog($DBmain, 'warning', "This state ({$pre_state}) can\'t use a image in this table (".$table.")", $user_id);
            echo '這個狀態不能上傳檔案';
        }
        else if($flag==2){
            setLog($DBmain, 'warning', 'Uploaded illegal file can\'t be deleted : '.$file['name'], $user_id);//can't remove illegal file
            echo 'error';
        }
        
    } 
    else{
        setLog($DBmain, 'warning', 'Illegal file can\'t be uploaded : '.$file['name'], $user_id);
        echo '上傳檔案應為圖檔';
    }
    
    require_once('stdEnd.php');
?>
