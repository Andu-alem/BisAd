<?php 
  include 'db_connect.php';
  //get a
  function registration($cnct){
      $region = $city = $subcity = $sefer = $additional_detail = $username = $email = $password = $confirm = $company = $category = $business_id = $profile = "";

          
      if(isset($_POST['submit']) && !empty($_POST['region']) && !empty($_POST['city']) && !empty($_POST['subcity']) && !empty($_POST['add_detail']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm']) && !empty($_POST['company']) && !empty($_POST['catagory']) && !empty($_POST['detail'])){

        $region = $_POST["region"];
        $city = $_POST["city"];
        $subcity = $_POST["subcity"];
        //$sefer = $_POST["unique_name"];
        $additional_detail = $_POST["add_detail"];
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];
        $company = $_POST["company"];
        $category = $_POST["catagory"];
        $profile = $_POST["detail"];
        $instnType = $_POST["instnType"];

        $fileName = $_FILES["upload"]["name"];
        $fileType = $_FILES["upload"]["type"];
        $fileSize = $_FILES["upload"]["size"];
        $fileTempName = $_FILES["upload"]["tmp_name"];


        setFirmType($instnType,$cnct);
        $firmKind = getFirmType($instnType,$cnct);

        if($password == $confirm){
          $pass = md5($password);
            //$admin_id = getUser($username,$pass,$email,$cnct);
            $admin_id = setUser_and_get_id($username,$pass,$phone,$email,$cnct);
        }else{
          echo "Password Doesn't match";
        }

        setCategory($category,$cnct);
        $cat_id = getCategoryId($category,$cnct);

        setBusiness($company,$admin_id,$cat_id,$firmKind,$cnct);
        $business_id = getBusiness($cat_id,$admin_id,$cnct);

        setLocation($business_id,$region,$city,$subcity,$additional_detail,$cnct);
        //$location_id = getLocationId($business_id,$cnct);

        $img_id = setImage_get_id($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct);
        //$img_id = getImage($business_id,$cnct);

        setProfile($business_id,$img_id,$profile,$cnct);
      }else{
        echo 'please fill properly';
      }
  }

  function user_registration($cnct){
    $username = $email = $password = $confirm = $user_id = "";
    if(isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm'])){
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm"];

        $id_qry = "SELECT u_id FROM user WHERE email = '$email'";
        $count_qry = mysqli_query($cnct,$id_qry);
        $number_of_row = mysqli_num_rows($count_qry);
        if($number_of_row > 0){
          return;
        }

        if($password == $confirm){
          $pass = md5($password);
            //$admin_id = getUser($username,$pass,$email,$cnct);
            $user_id = setUser_and_get_id($username,$pass,$phone,$email,$cnct);
            session_start();
            $_SESSION['user_id'] = $user_id;
            header('location:business_registration.php');
        }else{
          echo "Password Doesn't match";
        }
    }
  }

  function business_registration($cnct){
    $region = $city = $subcity = $sefer = $additional_detail = $company = $category = $business_id = $profile = "";

          
      if(isset($_POST['submit']) && !empty($_POST['region']) && !empty($_POST['city']) && !empty($_POST['subcity']) && !empty($_POST['add_detail']) && !empty($_POST['company']) && !empty($_POST['catagory'])){

        session_start();
        $user_id = $_SESSION['user_id'];
        $region = $_POST["region"];
        $city = $_POST["city"];
        $subcity = $_POST["subcity"];
        //$sefer = $_POST["unique_name"];
        $additional_detail = $_POST["add_detail"];
        $company = $_POST["company"];
        $category = $_POST["catagory"];
        $profile = $_POST["detail"];
        $instnType = $_POST["instnType"];

        $fileName = $_FILES["upload"]["name"];
        $fileType = $_FILES["upload"]["type"];
        $fileSize = $_FILES["upload"]["size"];
        $fileTempName = $_FILES["upload"]["tmp_name"];


        setFirmType($instnType,$cnct);
        $firmKind = getFirmType($instnType,$cnct);

        setCategory($category,$cnct);
        $cat_id = getCategoryId($category,$cnct);

        setBusiness($company,$user_id,$cat_id,$firmKind,$cnct);
        $business_id = getBusiness($cat_id,$user_id,$cnct);
        $_SESSION['business_id'] = $business_id;

        setLocation($business_id,$region,$city,$subcity,$additional_detail,$cnct);
        //$location_id = getLocationId($business_id,$cnct);

        $img_id = setImage_get_id($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct);
        //$img_id = getImage($business_id,$cnct);

        setProfile($business_id,$img_id,$profile,$cnct);
      }else{
        echo 'please fill properly';
      }
  }

  //insert user/admin data
  function setUser_and_get_id($username,$password,$phone,$email,$cnct){
    //echo $username."   ".$password.$email."<br>";
    //$cnct = mysqli_connect('localhost','root','','infoweb');
    $insert = "INSERT INTO user(u_name,phone,email,password) VALUES('$username','$phone','$email','$password')";
    $insert_qry = mysqli_query($cnct,$insert);
      if(!$insert_qry){
          die('Could Not Insert into user' . mysql_error());
      }else{
        //returns the inserted user id
        return mysqli_insert_id($cnct);
      }
  }

  //to get admin id
  function getUser($username, $password, $email,$cnct){
    $user_id = "SELECT u_id FROM user WHERE u_name = '$username' AND password = '$password' AND email = '$email'";
    $user_qry = mysqli_query($cnct,$user_id);
      if(!$user_qry)
      {
          die('Could not get user data: ' . mysql_error());
      }
      $user_row = mysqli_fetch_array($user_qry);
      return $user_row[0];
  }

  //to set/insert business category
  function setCategory($category,$cnct){
    //insert if not exist or no the same data is exist
    $row_count = checkCat($category,$cnct);
    if($row_count == 0){
      $insert = "INSERT INTO businesscategory(cat_name) VALUES('$category')";
      $insert_qry = mysqli_query($cnct,$insert);
        if(!$insert_qry){
            die('Could Not Insert into category' . mysql_error());
        }
    }
  }

  //to get category id
  function getCategoryId($category,$cnct){
    $cat = "SELECT cat_id FROM businesscategory WHERE cat_name = '$category'";
    $cat_qry = mysqli_query($cnct,$cat);
    if(!$cat_qry)
    {
        die('Could not get category data: ' . mysql_error());
    }
    $cat_row = mysqli_fetch_array($cat_qry);
    return $cat_row[0];
  }

  //to check cat row no
  function checkCat($category,$cnct){
    $cat = "SELECT cat_id FROM businesscategory WHERE cat_name = '$category'";
    $cat_qry = mysqli_query($cnct,$cat);
    if(!$cat_qry)
    {
        die('Could not get cat id data: ' . mysql_error());
    }
    $cat_row = mysqli_num_rows($cat_qry);	
    return $cat_row;
  }

  //to set business/institution/company
  function setBusiness($b_name,$admin,$category,$firmKind,$cnct){
    $insert = "INSERT INTO business(b_name,cat_id,admin,firm_kind) VALUES('$b_name','$category','$admin','$firmKind')";
    $insert_qry = mysqli_query($cnct,$insert);
    if(!$insert_qry){
        die('Could Not Insert into business' . mysql_error());
    }
  }

  //to get business id
  function getBusiness($cat_id, $admin,$cnct){
    $b_id = "SELECT b_id FROM business WHERE cat_id = '$cat_id' AND admin = '$admin'";
    $b_qry = mysqli_query($cnct,$b_id);
      if(!$b_qry)
      {
          die('Could not get business id data: ' . mysql_error());
      }
      $b_row = mysqli_fetch_array($b_qry);
      return $b_row[0];
  }

  //to set business/institution/company type kind
  function setFirmType($institution_kind,$cnct){
    $insert = "INSERT IGNORE INTO institution(inst_kind) VALUES('$institution_kind')";
    $insert_qry = mysqli_query($cnct,$insert);
    if(!$insert_qry){
        die('Could Not Insert into institution' . mysql_error());
    }
  }


  //to get firm type id
  function getFirmType($type_name,$cnct){
    $b_id = "SELECT i_id FROM institution WHERE inst_kind = '$type_name'";
    $b_qry = mysqli_query($cnct,$b_id);
      if(!$b_qry)
      {
          die('Could not get inst id data: ' . mysql_error());
      }
      $b_row = mysqli_fetch_array($b_qry);
      return $b_row[0];
  }
  //to insert location info
  function setLocation($b_id,$region, $city, $subcity,$additional_detail,$cnct){
    $insert = "INSERT INTO location(region, city, subcity,additional_detail,b_id) VALUES('$region','$city','$subcity','$additional_detail','$b_id')";
    $insert_qry = mysqli_query($cnct,$insert);
      if(!$insert_qry){
          die('Could Not Insert into Location' . mysql_error());
      }
  }

  //to get location id
  function getLocationId($b_id,$cnct){
    $l_id = "SELECT l_id FROM location WHERE b_id = '$b_id'";
    $l_qry = mysqli_query($cnct,$l_id);
      if(!$l_qry)
      {
          die('Could not getlocation  data: ' . mysql_error());
      }
      $b_row = mysqli_fetch_array($l_qry);
      return $b_row[0];
  }

  //to insert profile image
  function setImage_get_id($business_id,$fileName,$fileType,$fileSize,$fileTempName,$cnct){
    $currentDir = getcwd();
      $uploadDir = "/uploads/";
      $uploadPath = $currentDir.$uploadDir."/imgs/".$business_id.basename($fileName);
      $upload = move_uploaded_file($fileTempName,$uploadPath);
              //insert the image path intothe database
      $upldPath = "uploads/imges/".$business_id.basename($fileName);
      $insrt_img = "INSERT INTO image(b_id,img_name) VALUES('$business_id','$upldPath')";
      $img_qry = mysqli_query($cnct,$insrt_img);
      if(!$img_qry){
          die('Could Not Insert into Images'.mysql_error());
      }else{
        //returns currently inserted image id
        return mysqli_insert_id($cnct);
      }
  }

  //to get image id
  function getImage($b_id,$cnct){
    $img_id = "SELECT img_id FROM image WHERE b_id = '$b_id'";
    $img_qry = mysqli_query($cnct,$img_id);
      if(!$img_qry)
      {
          die('Could not get image data ' . mysql_error());
      }
      $img_row = mysqli_fetch_array($img_qry);
      return $img_row[0];
  }

  ///inssert business profile text
  function setProfile($b_id,$img_id,$profile,$cnct){
    $insert = "INSERT INTO profile(b_id,img_id,profile_text) VALUES('$b_id','$img_id','$profile')";
    $insert_qry = mysqli_query($cnct,$insert);
    if(!$insert_qry){
        die('Could Not Insert into profile' . mysql_error());
    }
  }

?>