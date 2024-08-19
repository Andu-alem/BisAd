<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
  <body>
    <?php
      include 'db_connect.php';

      $geolocation = "";
      $slct_advs = "SELECT * FROM advertisements";
      $slct_qry = mysqli_query($cnct,$slct_advs);
      if(!$slct_qry )
      {
        die('Could not get data: ' . mysql_error());
      }
      while($row = mysqli_fetch_assoc($slct_qry)):

          $adv_code = "{$row['ad_code']}";
          $firm_name = "{$row['name']}";
          $bsns_type = "{$row['type']}";
          //while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
          $detail = "{$row['description']}";
          $address = "{$row['address']}";
      // get the location
          $get_loc = "SELECT city,sub_city FROM location WHERE unique_name = '$address'";
          $loc_qry = mysqli_query($cnct,$get_loc);
          $loc_row = mysqli_fetch_array($loc_qry);
        //  echo "<br>".$address.",".$loc_row[0],",".$loc_row[1];
      // get multimedia like image
          $get_img = "SELECT image FROM multimedia WHERE ad_code = '$adv_code'";
          $img_qrry = mysqli_query($cnct,$get_img);
          while($row2 = mysqli_fetch_assoc($img_qrry)):
            $img = "{$row2['image']}";
    ?>

      <div class="">
        <hr>
        <h2><?php echo $firm_name; ?></h2>
        <h3><?php echo $bsns_type; ?></h3><br>
        <img src="<?php echo $img; ?>" alt="">
        <blockquote>
          <?php echo $detail; ?>
        </blockquote>
        <h3>Location: </h3>
        <h2><?php echo $loc_row[0]; ?></h2>
        <strong><?php echo $loc_row[1]; ?></strong>
        <strong>
            <i><?php echo $address; ?></i>
        </strong>
        <form class="" action="showdetail.php" method="post">
            <input type="text" name="hold" value="<?php echo $adv_code; ?>" hidden>
            <input type="submit" name="submit" value="show detail">
        </form>
        <br><br><br>
        <hr>
      </div>
      <?php endwhile ?>
    <?php endwhile ?>
  </body>
</html>
