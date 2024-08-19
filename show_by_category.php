<?php
    //include 'retrive.php';
?>
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
  <body ng-app="myApp" ng-controller="myCont">

    <!-- Navigtion -->
    <nav class="navbar navbar-expand-md navbar-blue bg-info sticky-top fixed-top">
      <div class="container-fluid">
        <a class="navbar-brand text-white bg-info" href="index.php"><h1>Wellcome To this web</h1></a>
        <!---
            <button type="button" class="navbar-toggler" ng-click="myFunc()">
              <span class="navbar-toggler-icon"></span>
          </button>
          <ul ng-show="showMe" class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home</a>
            </li>
          </ul> -->
      </div>
    </nav>

    <!-- Jumbotron -->
    <div class="row container-fluid padding m-sm-auto p-sm-2 pb-2 pb-sm-3 pt-sm-3 bg-dark border rounded">
      <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10 text-white color-white">
          <p class="text-primary"><h5>Do you have your own buissness? Then why dont you advertise here! be available for everyone!</h5></p>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
          <a href="registration.php">
              <button type="button" class="btn btn-outline-light text-white btn-sm">Register Here..</button>
          </a>
      </div>
    </div>


    <div class="row padding positon-fixed">

      <!--
      <div class="container-fluid col-4 col-sm-3 col-md-2 col-lg-2 border-right padding">
      <h4 class="h5 text-center text-white bg-info p-0">Select By Catagory</h4>
      <hr class="p-0">

      <?php
       $cat = "SELECT * FROM businesscategory";
       $catqry = mysqli_query($cnct,$cat);
       if (!$catqry) {
         die('Could not get category info'.mysql_error());
       }
       ?>
      <ul class="list-group list-inline-item list-unstyled align-items-center p-0">
      <?php
       while($catrow = mysqli_fetch_assoc($catqry)):
        $catid = "{$catrow['cat_id']}";
        $catname = "{$catrow['cat_name']}";

       ?>
            <li>
                      <form class="" action="show_by_category.php" method="post">
                      <input type="text" name="catid" value="<?php echo $catid; ?>" hidden>
                      <input type="submit" class="btn btn-outline-secondary btn-sm" name="catname" value="<?php echo $catname; ?>">
                  </form>
             </li>
             <?php endwhile ?>
      </ul>

      </div>
      -->


      <div class="container-fluid col-11 col-sm-9 col-md-10 col-lg-10 padding">
        <div class="row padding">


          <?php
            //include 'retrive.php';

            $catagory_id = $_POST["catid"];

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
                $subcity = $location_array[3];
                $sefer = $location_array[4]; // unique name or 'sefer' name
                $additional_detail = $location_array[5];// for more detail info about the address

                //echo "this is location info: ".$location_id."    ".$region."  ".$city."  ".$subcity."   ".$sefer."     ".$additional_detail."<br>";

                /*
                //if geo coordinate is needded
                $coordinate_array = getCoordinate($location_id,$cnct);
                $latitude = $coordinate_array[0];
                $longitude = $coordinate_array[1];
                */

            ?>

            <div class="col-sm-6 col-md-4 col-lg-3 pb-3 pb-md-3">
              <div class="list-group panel-default card">
                  <div class="row list-group-item-heading">

                        <?php 
                            if($profile_img_src != ""){
                                  echo '<span class="col-6"><img class="card-img w-100" style="height:100px;"  src="'. $profile_img_src.'" alt=""></span>';
                            } 
                        ?>
                      <span class="col-6">
                        <h4 class="text-dark"><?php echo $business_name; ?>
                          <section>
                              <small class="text-secondary"><?php echo $cat_name; ?></small>
                          </section>
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
                      <h6 class="text-capitalise text-secondary"><?php echo $city.", "; ?>
                          <small><strong ><?php echo $subcity.", ".$sefer; ?></strong></small>
                      </h6>
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
    </div>


    <footer>
      <div class="container-fluid padding">
        <div class="row text-center">
          <div class="col-12">
            <hr class="light">
            <h5>More information</h5>
            <hr class="light">
            <p>About us</p>
            <p>Read more</p>
            <p>And more...</p>
          </div>
          <div class="col-12">
            <hr class="light">
            <h5>&copy; All Rights Are Reserved.</h5>
          </div>
        </div>
      </div>
    </footer>

    <script>
        angular.module("myApp",[]).controller("myCont",function($scope){
            $scope.showMe = false;
            $scope.showZero = true;
            $scope.showOne = false;
            $scope.showTwo = false;
            $scope.showThree = false;

            $scope.myFunc = function(){
              $scope.showMe = !$scope.showMe;
            }
            $scope.myItem = function(x){
              if (x==0) {
                $scope.showOne = false;
                $scope.showTwo = false;
                $scope.showThree = false;
                $scope.showZero = true;
              }
              else if(x==1){
              $scope.showZero = false;
              $scope.showTwo = false;
              $scope.showThree = false;
              $scope.showOne = true;}
              else if (x==2) {
                $scope.showOne = false;
                $scope.showZero = false;
                $scope.showThree = false;
                $scope.showTwo = true;
              }
              else if (x==3) {
                $scope.showOne = false;
                $scope.showTwo = false;
                $scope.showZero = false;
                $scope.showThree = true;
              }
            }
          });
    </script>
  </body>
</html>
