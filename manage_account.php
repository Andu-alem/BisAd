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
    <title>Advertise</title>
  </head>
  <body class="bg-light container">
        
      <div class="container border-bottom row">
          <div class="pl-3 col-7 col-sm-6 pl-4">     
              <a class="pl-2 pl-md-5 ml-1 ml-md-5 font-weight-bold font-italic" href="index.php" style="text-decoration: underline; font-size: 2.5rem; color: #999999;">
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
          <!-- <div class="w-100">
              <div style="height: 35px; background-color: #39ac73;"></div>
              <div class="bg-dark" style="height: 3px;"></div>
          </div> -->
      </div>

      <div class="container" align="center">
        <form class="form-group col-10 col-sm-6 bg-white mt-5 p-4" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" enctype="multipart/form-data">
            <label>what do you want to change</label><br>
            <input class="form-control" type="name" name="username" placeholder="username"><br>
            <input class="form-control" type="email" name="email" placeholder="email"><br>
            <input class="form-control" type="password" name="password" placeholder="password"><br>
            <input class="form-control" type="password" name="confirm" placeholder="confirm"><br>
            <input class="btn btn-md btn-outline-secondary" type="submit" name="change" value="Update">
        </form>
      </div>

</body>
</html>