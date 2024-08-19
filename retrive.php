<?php

  //use the below code to get JSON data ouutput
  /*header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");// to get JSON output
  */
  include 'db_connect.php';

  //get all businesses in the database and display for the user
  //this function reeturnss JSON data
  //so we use this function when we want JSON output
  function getAll(){
    $record = "";

    $business = "SELECT * FROM business";
    $business_qry = mysqli_query($cnct,$business);
    if(!$business_qry)
    {
        die('Could not get data: ' . mysql_error());
    }

    while($row = mysqli_fetch_assoc($business_qry)){
      $business_id = "{$row['b_id']}";
      $business_name = "{$row['b_name']}";
      $business_type = "{$row['cat_id']}";
      $cat_name = getCategory($business_type);// fetch catagory name
      $profile_img_id = getProfile($business_id,0);
      $profile_txt = getProfile($business_id,1);
      $profile_img_src = getProImg($profile_img_id);

      $location_array = getLocation($business_id);
      $location_id = $location_array[0];
      $region = $location_array[1];
      $city = $location_array[2];
      $subcity = $location_array[3];
      $sefer = $location_array[4]; // unique name or 'sefer' name
      $additional_info = $location_array[5];// for more detail info about the address

      $coordinate_array = getCoordinate($location_id);
      $latitude = $coordinate_array[0];
      $longitude = $coordinate_array[1];

  //store and return JSON data
    if($record != ""){
      $record .= ',';
    }
    $record .= '{"business_name":"'.$business_name.'",';
    $record .= '{"business_category":"'.$cat_name.'",';
    $record .= '{"img_src":"'.$profile_img_src.'",';
    $record .= '{"profile_text":"'.$profile_txt.'",';
    $record .= '{"region":"'.$region.'",';
    $record .= '{"city":"'.$city.'",';
    $record .= '{"subcity":"'.$subcity.'",';
    $record .= '{"sefer":"'.$sefer.'",';
    $record .= '{"additional_info":"'.$additional_info.'",';
    $record .= '{"latitude":"'.$latitude.'",';
    $record .= '{"longitude":"'.$longitude.'",';

    }
    $record = '{datas:['.$record.']}';
    mysqli_close($cnct);
    return $record;

    //it can also be made to return in associated array form      do next time

  }

  //to get the location of one businesses
  function getLocation($b_id,$cnct){
    $location = "SELECT l_id,region,city,subcity,additional_detail FROM location WHERE b_id = '$b_id'";
    $loc_qry = mysqli_query($cnct,$location);
    if(!$loc_qry)
    {
        die('Could not get the location data: ' . mysql_error());
    }
    $loc_row = mysqli_fetch_array($loc_qry);
    return $loc_row;// returns an array
  }

  //to get geolocation coordinate (latitude and longitude)
  function getCoordinate($loc_id,$cnct){
    $coordinate = "SELECT latitude,longitude FROM coordinate WHERE loc_id = '$loc_id'";
    $coor_qry = mysqli_query($cnct,$coordinate);
    if(!$coor_qry)
    {
        die('Could not get coordinate data: ' . mysql_error());
    }
    $coor_row = mysqli_fetch_array($coor_qry);
    return $coor_row;
  }

  //to get (query for) business catagory
  function getCategory($cat_id,$cnct){
    $cat = "SELECT cat_name FROM businesscategory WHERE cat_id = '$cat_id'";
    $cat_qry = mysqli_query($cnct,$cat);
    if(!$cat_qry)
    {
        die('Could not get catagory data: ' . mysql_error());
    }
    $cat_row = mysqli_fetch_array($cat_qry);
    return $cat_row[0];
  }


  // to get (request) a profile text of one business plus related img id(profile img)
  function getProfile($b_id,$flag,$cnct){
    $profile = "SELECT img_id,profile_text FROM profile WHERE b_id = '$b_id'";
    $pro_qry = mysqli_query($cnct,$profile);
    if(!$pro_qry)
    {
        die('Could not get profile data: ' . mysql_error());
    }
    $pro_row = mysqli_fetch_array($pro_qry);
    //if the request is img_id $flag==0 else return profile text
    if($flag == 0){
      return $pro_row[0];
    }else{
      return $pro_row[1];
    }

  }

  //to get profile image
  function getProImg($img_id,$cnct){
    $img = "SELECT img_name FROM image WHERE img_id = '$img_id'";
    $img_qry = mysqli_query($cnct,$img);
    if(!$img_qry)
    {
        die('Could not get profile image data: ' . mysql_error());
    }
    $img_row = mysqli_fetch_array($img_qry);
    return $img_row[0];
  }

  //echo getAll();

  /// get business name using business id
  function getBusinessName($b_id,$cnct){
    $business = "SELECT b_name,cat_id FROM business WHERE b_id = '$b_id'";
    $business_qry = mysqli_query($cnct,$business);
    if(!$business_qry)
    {
        die('Could not get business name data: ' . mysql_error());
    }
    $b_row = mysqli_fetch_array($business_qry);
    return $b_row;
  }

 ?>
