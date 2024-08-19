<?php
  include "user_login.php";
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
    if(user_login($cnct)){
      echo "logged in successfully";
      header('location:busiadmin_page.php');
    } else{
      header('location:login.php');
        echo "password or email error";
    }
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="drop.css">
    <script type="text/javascript" src="angular-1.7.8/angular.js">
    </script>
    <title>Log-in</title>
  </head>
  <body style="overflow-x: hidden;" class="bg-light">
    <div class="container border-bottom bg-light  sticky-top">
      <div class="pl-3">     
        <a class="navbar-brand font-weight-bold font-italic" href="index.php" style="text-decoration: underline; font-size: 2.5rem; color: #999999;"><span style="color:#39ac73;">Bi</span>sAd</a>
      </div>
<!--       <div class="w-90">
        <div style="height: 30px; background-color: #39ac73;"></div>
        <div class="bg-dark" style="height: 3px;"></div>
      </div> -->
    </div>
    <div class="container-fluid" align="center">
      <div class="col-10 col-sm-8 mt-5 p-4 bg-white">

        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="myForm" role="form">
          <div class="col-sm-8 col-md-6">
            <label class="form-text"><strong>User Sign-in:</strong></label>
          </div>

          <div class="form-group col-sm-8 col-md-6">
            <input type="email" class="form-control" placeholder="Email" name="email" value="" required>
          </div>


          <div class="form-group col-sm-8 col-md-6">
            <input type="password" class="form-control" placeholder="Enter Password" name="password" value="" maxlength="8" required>
          </div>

          <div class="form-group col-sm-10">
            <button type="submit" name="login" class="btn btn-outline-secondary" value="Log in">Log in</button>
          </div>
          <div class="form-group col-sm-10">
            Haven't registerd yet? <a href="./registration.php">Register</a>
          </div>
        </form>
      </div>
    </div>
    <script>
    /*angular.module('myApp' , []).controller('formCont' , function($scope){
    //  $scope.catagory = "your buisness catagory";
    });*/
    </script>
  </body>
</html>
