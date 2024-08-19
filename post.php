<?php
include "post_submit.php";
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
 submitPost($cnct);
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
        <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="drop.css">
        <script type="text/javascript" src="bootstrap-4.1.3/js/bootstrap.js"></script>
        <title>Advertise</title>
      </head>
  <body class="bg-light">
      <div class="container-fluid sticky-top">     
          <a class="pl-2 pl-md-5 ml-1 ml-md-5 font-weight-bold font-italic" href="index.php" style="text-decoration: underline; font-size: 2.5rem; color: #999999;">
              <span style="color:#39ac73;">Bi</span>sAd
          </a>
      </div>
      <div class="w-100">
          <div style="height: 35px; background-color: #39ac73;"></div>
          <div class="bg-dark" style="height: 3px;"></div>
      </div>
      <div class="container" align="center">
        <form class="form-horizontal mt-5 p-4 bg-white"enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="myForm" role="form">
            <label class="form-text" for="detail"><strong class="h3">Write something here:</strong></label>
            <textarea class="form-control col-11 col-sm-7" name="pst_txt" rows="10"></textarea>
            <label class="form-text" for="detail"><strong class="h3">Post pictures(optional) below:</strong></label>
            <input type="file" name="upload"><br>
            <input type="submit" name="submit" class="btn btn-outline-primary btl-lg m-2" value="Continue">
        </form>
      </div>
  </body>
</html>