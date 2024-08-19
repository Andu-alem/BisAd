<?php
    $words = "my name is andualem fereja";
    $line = "Vi is the greatest word processor ever created!";
    $ll = "gre";
    // perform a case-Insensitive search for the word "Vi"
    if (preg_match("/\b$ll.*\b/i", $line, $match)) {
        print "Match found!";
    }


    $search_val = $_POST["search_value"];
    $sub_srch = substr($search_val, 0,3);

    $location = "SELECT * FROM location";
    $loc_qry = mysqli_query($cnct,$location);
    if(!$loc_qry){
        die('Could not get the location data: ' . mysql_error());
    }
    while($row = mysqli_fetch_assoc($loc_qry)):
          $business_id = "{$row['b_id']}";
       	  $location_id = "{$row['l_id']}";
          $region = "{$row['region']}";
          $city = "{$row['city']}";
          $subcity = "{$row['subcity']}";
          $sefer = "{$row['unique_name']}"; // unique name or 'sefer' name
          $additional_detail = "{$row['additional_detail']}";

          if((preg_match("/\b$sub_srch.*\b/i", $city,$match))||(preg_match("/\b$sub_srch.*\b/i", $region,$match))||(preg_match("/\b$sub_srch.*\b/i", $subcity,$match))||(preg_match("/\b$sub_srch.*\b/i", $sefer,$match))||(preg_match("/\b$sub_srch.*\b/i", $additional_detail,$match))):
            	 $business_name = getBusinessName($business_id,$cnct)[0];
            	 $cat_id = getBusinessName($business_id,$cnct)[1];
            	 $cat_name = getCategory($cat_id,$cnct);

            	 $profile_img_id = getProfile($business_id,0,$cnct);
            	 $profile_txt = getProfile($business_id,1,$cnct);
            	 $profile_img_src = getProImg($profile_img_id,$cnct);

?>





    <div class="col-sm-6 col-md-4 col-lg-4 col-xl-4 p-0">
        <div class="list-group card">
            <div class="row">

                <?php 
                  if($profile_img_src != ""){
                      echo '<span class="col-6"><img class="card-img w-100" style="height:100px;"  src="'. $profile_img_src.'" alt="">
                                   <h5><section><small class="text-secondary">'. $cat_name.'</small></section></h5></span>';
                   } 
                ?>
                <span class="col-6">
                  <h4 class="text-dark"><?php echo $business_name; ?>
                    <!-- <section>
                      <small class="text-secondary"><?php echo $cat_name; ?>
                      </small>
                    </section> -->
                  </h4>
                  <section>
                      <form class="" action="business_page.php" method="post">
                          <input type="text" name="hold" value="<?php echo $business_id; ?>" hidden>
                          <input type="submit" class="btn btn-outline-info btn-sm" name="submit" value="show detail">
                      </form>
                  </section>
                </span>
            </div>
            <div class="panel-footer">
                <strong class="text-uppercase">Location:</strong>
                <h6 class="text-capitalise text-secondary"><?php echo $city; ?><small><strong ><?php echo $subcity.", "?></strong></small></h6>
                <strong class="text-secondary">
                  <i><?php echo $additional_detail; ?></i>
                </strong>
            </div>
        </div>
    </div>
  <?php endif ?>
<?php endwhile ?>
