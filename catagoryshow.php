<div class="container-fluid col-12 col-sm-11 col-md-11 col-lg-10">
  <div class="row">


    <?php
    //include 'retrive.php';
     if(isset($_POST["catid"])&&$_POST["catid"]  != ""){
        $catagory_id = $_POST["catid"];
     } else {
      $catagory_id = $_GET["catid"];
     }

    $business = "SELECT * FROM business WHERE cat_id = '$catagory_id'";
    $business_qry = mysqli_query($cnct,$business);
    if(!$business_qry)
    {
    die('Could not get data: ' . mysql_error());
    }
    // if users are searching using  placename
    if(isset($_POST['search'])&&$_POST["search_value"]!=""){
      $search_val = $_POST["search_value"];
       // write a search match and display back to the user code Here
       //
      echo $search_val;
    }else{

      while($row = mysqli_fetch_assoc($business_qry)):
        $business_id = "{$row['b_id']}";
        $business_name = "{$row['b_name']}";
        $business_type = "{$row['cat_id']}";

          //echo $business_id."  ".$business_name."  ".$business_type."<br>";

        $cat_name = getCategory($business_type,$cnct);// fetch catagory name
        $profile_img_id = getProfile($business_id,0,$cnct);
        $profile_txt = getProfile($business_id,1,$cnct);
        $profile_img_src = getProImg($profile_img_id,$cnct);

            //echo "<br>"."show me profile src:  ".$profile_img_src."<br>";

        $location_array = getLocation($business_id,$cnct);
        $location_id = $location_array[0];
        $region = $location_array[1];
        $city = $location_array[2];
        $subcity = $location_array[3]; // unique name or 'sefer' name
        $additional_detail = $location_array[4];// for more detail info about the address

          //echo "this is location info: ".$location_id."    ".$region."  ".$city."  ".$subcity."   ".$sefer."     ".$additional_detail."<br>";

       /*
       //if geo coordinate is needded
        $coordinate_array = getCoordinate($location_id,$cnct);
        $latitude = $coordinate_array[0];
        $longitude = $coordinate_array[1];
        */

          ?>

          <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4 p-1">
              <div class="card" style="overflow: hidden;">
                  <div class="row">

                      <?php 
                            if($profile_img_src != ""){
                                echo '<span class="col-5 col-sm-6 col-xs-5 col-md-5 col-lg-6"><a href="'.$profile_img_src.'"><img class="card-img w-100"  src="'. $profile_img_src.'" alt=""></a></span>';
                            } 
                      ?>
                      <span class="col-7 col-sm-6 col-xs-7 col-md-7 col-lg-6">
                          <h4 class="text-dark black-text">
                            <?php echo $business_name; ?>
                          </h4>
                        <section class="cat-name-sm ">
                            <small class="text-secondary h5"><?php echo $cat_name; ?>
                           </small>
                        </section>
                        <section class="mt-3 mt-sm-0">
                          <form class="" action="business_page.php" method="post">
                            <input type="text" name="hold" value="<?php echo $business_id; ?>" hidden>
                            <input type="submit" class="btn btn-link btn-md detail-btn page-link font-weight-bold" name="submit" style="color: #39ac73;" value="See More....">
                          </form>
                        </section>
                      </span>
                  </div>

                  <div>
                      <?php 
                          echo '<section class="ml-1 font-italic"><strong class="cat-name-lg text-secondary text-capitalize">'. $cat_name.'</strong></section>'; 
                      ?>
                  </div>

                  <div class="location-aria">
                      <strong class="text-uppercase">Location:</strong>
                      <span class="text-capitalize text-secondary">
                          <?php echo $city.", "; ?>
                            <small>
                              <strong ><?php echo $subcity?></strong>
                            </small>
                      </span>
                      <br>
                      <strong class="text-secondary font-italic">
                            
                            <?php echo $additional_detail; ?>
                      
                      </strong>
                  </div>
                </div>
            </div>
      <?php endwhile ?>
  <?php } ?>

  </div>
</div>
