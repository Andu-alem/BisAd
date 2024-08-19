<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
        <script type="text/javascript" src="angular-1.7.8/angular.js">
        </script>
        <title></title>
    </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-blue bg-info">
          <div class="container-fluid">
              <a class="navbar-brand text-capitalize text-white bg-info" href="myWeb.php"><h1>Wellcome To this web</h1></a>
              <a class="nav-link nav-tabs text-uppercase text-white bg-info" href="myWeb.php">Back</a>
          </div>
      </nav>

      <div class="row">
          <?php
              include 'db_connect.php';
              $get_val = $_POST['hold'];
              $shw_detail = "SELECT * FROM advertisements WHERE ad_code='$get_val'";
              $detail_qry = mysqli_query($cnct,$shw_detail);
              if(!$detail_qry )
              {
                die('Could not get data: ' . mysql_error());
              }
              $row = mysqli_fetch_assoc($detail_qry);
                    $adv_code = "{$row['ad_code']}";
                    $firm_name = "{$row['name']}";
                    $bsns_type = "{$row['type']}";
                    //while($row = mysqli_fetch_array($retval, MYSQL_ASSOC))
                    $detail = "{$row['description']}";
                    $address = "{$row['address']}";
                  //  echo "<br>".$firm_name.$bsns_type;
          ?>
          <div class="container-fluid col-md-6 col-lg-6">
                <h2 class="text-justify"><?php echo $firm_name; ?></h2>
                <h4><?php echo $bsns_type; ?></h4>
                <p><?php echo $detail; ?></p>
                <p><?php echo $address; ?></p>
          </div>
          <?php
              $get_img = "SELECT image,video FROM multimedia WHERE ad_code = '$adv_code'";
              $mml_qrry = mysqli_query($cnct,$get_img);
              while($row2 = mysqli_fetch_assoc($mml_qrry)){
                $imgg = "{$row2['image']}";
                $vidd = "{$row2['video']}";
          ?>
          <div class="container-fluid col-md-6">

              <?php if(($imgg != '')&&($vidd =='')){?>
                  <img class="card-img w-75 h-50";"  src="<?php echo $imgg; ?>" alt=''>'
              <?php }elseif(($imgg == '')&&($vidd != '')){?>
                  <iframe class='embed-responsive-item w-75' src='<?php echo $vidd; ?>'></iframe>
                <?php } ?>
          </div>
          <?php  }
          ?>
      </div>
  </body>
</html>
