<?php 

  //$search_val = $_POST["search_value"];
  $search_val = $_POST["search_value"];
  $sub_srch = substr($search_val, 0,3);
  $business_name="";
  //SELECT name FROM person_tbl WHERE name REGEXP 'mar';

  /* $joinn = "SELECT a.b_id,a.b_name,a.admin,a.cat_id,b.region,b.city,b.subcity,b.l_id,b.additional_detail FROM business a,location b WHERE a.b_id = b.b_id AND (a.b_name REGEXP '$sub_srch' || b.region REGEXP '$sub_srch' || b.city REGEXP '$sub_srch' || b.subcity REGEXP '$sub_srch' || b.additional_detail REGEXP '$sub_srch')";*/


  $joinn = "SELECT a.b_id,a.b_name,a.admin,a.cat_id,b.region,b.city,b.subcity,b.l_id,b.additional_detail FROM business a,location b WHERE a.b_id = b.b_id AND (a.b_name LIKE '$sub_srch%' || a.b_name LIKE '%$sub_srch%' || b.region LIKE '%$sub_srch%' || b.region LIKE '$sub_srch%' || b.city LIKE '$sub_srch%' || b.city LIKE '%$sub_srch%' || b.subcity LIKE '$sub_srch%' || b.subcity LIKE '%$sub_srch%' || b.additional_detail LIKE '$sub_srch%' || b.additional_detail LIKE '%$sub_srch%')";

  $joinn_qry = mysqli_query($cnct,$joinn);
  if(!$joinn_qry){
    die('Could not get the location data: ' . mysql_error());
  }
  while($row = mysqli_fetch_assoc($joinn_qry)):

    $business_id = "{$row['b_id']}";
    $location_id = "{$row['l_id']}";
    $region = "{$row['region']}";
    $city = "{$row['city']}";
    $subcity = "{$row['subcity']}";
    // $sefer = "{$row['unique_name']}"; // unique name or 'sefer' name
    $additional_detail = "{$row['additional_detail']}";
    $business_name = getBusinessName($business_id,$cnct)[0];
    $cat_id = getBusinessName($business_id,$cnct)[1];
    $cat_name = getCategory($cat_id,$cnct);

    $profile_img_id = getProfile($business_id,0,$cnct);
    $profile_txt = getProfile($business_id,1,$cnct);
    $profile_img_src = getProImg($profile_img_id,$cnct);
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

<?php 
  if($business_name == ""):
?> 
  <div class="container-fluid h-100"><p>No Match Found! please search again!</p></div>

<?php endif ?>