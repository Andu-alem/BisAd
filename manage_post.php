<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
        <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="drop.css">
        </script>
        <title>Advertise</title>
      </head>
  <body>
    <div class="row">
      <div class="pl-3 col-7 col-sm-6 pl-4">     
          <a class="" href="index.php" style="text-decoration: underline; font-size: 4rem; color: #999999;">
              <span style="color:#39ac73;">Bi</span>sAd
          </a>
      </div>
      <div class="col-5 col-sm-6 pt-4 pr-5 text-right">
          <ul class="list-inline">
              <li class="list-inline-item">
                  <a href="busiadmin_page.php" class="h4 text-secondary pr-2">Back</a>
              </li>
              <li class="list-inline-item">
                  <a href="" class="h4 text-secondary">Logout</a>
              </li>
          </ul>
      </div>
      <div class="w-100">
          <div style="height: 35px; background-color: #39ac73;"></div>
          <div class="bg-dark" style="height: 3px;"></div>
      </div>
    </div>

    <?php 
      include 'db_connect.php';
      // session_start();
      // $bId = $_SESSION['business_id'];
  
      $posts = "SELECT * FROM post WHERE b_id = '1' ORDER BY time_stamp DESC";
      $post_qry = mysqli_query($cnct,$posts);
      if(!$post_qry){
        die('Cold not get posts'.mysql_error());
      }
        while($row = mysqli_fetch_assoc($post_qry)):
          $post_text = $row['post_text'];
          $timeStamp = $row['time_stamp'];
          $img_id = $row['img_id'];
    ?>

    <div class="col-12 row pb-3">
        <div class="container-fluid col-md-2 col-lg-2">

        </div>
        <div class="container-fluid border col-11 col-md-8 col-lg-8">
            <p>post date: <?php echo date("F Y, \a\\t g.i a",$timeStamp); ?>
              <span>
                <button>Remove</button>
              </span>
            </p> 
            <p style="white-space: pre-line;"><?php echo $post_text; ?></p>
        </div>

        <div class="container-fluid col-md-2 col-lg-2">

        </div>
    </div>

    <?php endwhile ?>

  </body>
</html>