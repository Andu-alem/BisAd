<?php 
    include 'db_connect.php';
    include 'register_sub.php';

    session_start();
    $business_id = $_SESSION['business_id'];


    //to submit posts
    function submitPost($cnct){
        $business_id = $_SESSION['business_id'];
        $pst_txt = $_POST["pst_txt"];
        $time_stmp = time();
            echo $time_stmp."<br>";

        $fileName = $_FILES["upload"]["name"];
        $fileType = $_FILES["upload"]["type"];
        $fileSize = $_FILES["upload"]["size"];
        $fileTempName = $_FILES["upload"]["tmp_name"];



        setImage_get_id($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct);
        $img_id = getImageId($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct);

        $post_id = insertPost($cnct,$business_id,$pst_txt,$time_stmp);
        insertPostImage($cnct, $business_id, $post_id, $img_id);

        echo date("F Y, \a\\t g.i a",  getPostTime($cnct,$business_id)); 
    }

    //insert post into database
    function insertPost($cnct,$b_id,$pst_txt,$time_stmp){
        $insert = "INSERT INTO post(b_id,post_text,post_date) VALUES('$b_id','$pst_txt','$time_stmp')";
        $insert_qry = mysqli_query($cnct,$insert);
        if(!$insert_qry){
            die('Could Not Insert into post' . mysql_error());
        }else{
            return mysqli_insert_id($cnct);
        }
    }

    function insertPostImage($cnct, $b_id, $post_id, $img_id){
        $insert = "INSERT INTO post_img(business_id, post_id, img_id) VALUES('$b_id', '$post_id', '$img_id')";
        $insert_qry = mysqli_query($cnct,$insert);
        if(!$insert_qry){
            die('Could Not Insert into post' . mysql_error());
        }
    }

    //to get image id
    function getImageId($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct){
        $currentDir = getcwd();
        $uploadDir = "/uploads/";
        $uploadPath = $currentDir.$uploadDir."/imgs/".$business_id.basename($fileName);
        $upload = move_uploaded_file($fileTempName,$uploadPath);
        //insert the image path intothe database
        $upldPath = "uploads/imgs/".$business_id.basename($fileName);

        $img_id = "SELECT img_id FROM image WHERE img_name = '$upldPath'";
        $img_qry = mysqli_query($cnct,$img_id);
        if(!$img_qry)
        {
            die('Could not get image data ' . mysql_error());
        }
        $img_row = mysqli_fetch_array($img_qry);
        return $img_row[0];
    }

    //get possst
    function getPostTime($cnct,$b_id){
        $img_id = "SELECT time_stamp FROM post WHERE b_id = '$b_id'";
        $img_qry = mysqli_query($cnct,$img_id);
        if(!$img_qry)
        {
            die('Could not get image data ' . mysql_error());
        }
        $img_row = mysqli_fetch_array($img_qry);
        return $img_row[0]; 
    }
?>
