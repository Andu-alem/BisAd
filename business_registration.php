<?php
  include "register_sub.php";
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
      business_registration($cnct);
      //header('location:busiadmin_page.php');
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
  <title>Registration</title>
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
        <div class="col-sm-9 pb-3">
          <h5 class="h5 text-dark">Submit Information By Filling The Form Properly</h5>
        </div>

        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="myForm" role="form" novalidate>
          
          <div class="col-sm-8 col-md-6">
            <label class="form-text"><strong>Provide Company/Business/Institution Name & Catagory Information:</strong></label>
          </div>

          <div class="form-group was-valid col-sm-6 col-md-6">
            <label for="">Business/Institution kind</label>
            <select class="form-group" name="instnType" ng-model="instKind" required>
              <option value=""></option>
              <option value="Governmental">Governmental</option>
              <option value="Relegional">Relegional</option>
              <option value="NGO">NGO</option>
              <option value="Business Related">Business Related</option>

               <?php 
               /*
              $firm = "SELECT * FROM institution";
              $firm_qry = mysqli_query($cnct,$firm);
              if(!$firm_qry){
              die('could not get firm kind'.mysql_error());
              }
              while($row = mysqli_fetch_assoc($firm_qry)){
                echo '<option value="'.$row['i_id'].'">'.$row['inst_kind'].'</option>';
              }
              */
              ?>

            </select>
          </div>
          <div class="form-group was-valid col-sm-6 col-md-6">
            <input type="text" class="form-control" placeholder="Company/Firm/Business name" name="company" value="" required>
          </div>

          <div class="form-group col-sm-6 col-md-6">
            <input list="category" class="form-control" placeholder="Buisness/work catagory" name="catagory" value="" required>
            <datalist class="" id="category">
              <option value="Hotel">
              <option value="Cafee and Reastaurant">
              <option value="Church">
              <option value="Clinic">
              <?php 
                $cat = "SELECT cat_name FROM businesscategory ORDER BY cat_name ASC";
                $cat_qry = mysqli_query($cnct,$cat);
                if(!$cat_qry){
                  die('could not get catagory'.mysql_error());
                }
                while($row = mysqli_fetch_assoc($cat_qry)){
                  echo '<option value="'.$row['cat_name'].'">';
                } 
              ?>
            </datalist>
          </div>

          <div class="col-sm-8 col-md-8">
            <label class="form-text"><strong>Company/Business Address Registration:</strong></label>
          </div>
          <div class="form-group col-sm-8 col-md-6">
            <input type="text" list="region" class="form-control" placeholder="Region" name="region" value="" required>
            <datalist class="" id="region">
              <option value="Oromia">
              <option value="Tigray">
              <option value="Amhara">
              <option value="Afar">
              <option value="Somali">
              <option value="Gambela">
              <option value="Benishangul Gumuz">
              <option value="SNNPR">

              <?php 
              /*
              $reg = "SELECT region FROM location ORDER BY region ASC";
              $reg_qry = mysqli_query($cnct,$reg);
              if(!$reg_qry){
              die('could not get catagory'.mysql_error());
              }
              while($row = mysqli_fetch_assoc($reg_qry)){
                echo '<option value="'.$row['cat_name'].'">';
              }
              */
              ?>
            </datalist>
          </div>

          <div class="form-group col-sm-8 col-md-6">
            <input type="text" class="form-control" placeholder="Your City name" name="city" value="" required>
          </div>

          <div class="form-group col-sm-8 col-md-6">
            <input type="text" class="form-control" placeholder="Subcity/ ye sefer sim/ Lisyu sim" name="subcity" value="" required>
          </div>

          <div class="form-group col-sm-6 col-md-6">
            <input type="text" class="form-control" placeholder="additional detail /ye bota techemari zirzir" name="add_detail" value="" required>
          </div>

          <div class="col-sm-8 col-md-6">
            <label class="form-text" for="detail"><strong>Write your buisness profile/promotion here:</strong></label>
          </div>
          <div class="form-group col-sm-6 col-md-6">
            <textarea class="form-control" name="detail" rows="10"></textarea>
          </div>
          <div class="col-sm-8 col-md-6">
            <label class="form-text" for="detail"><strong>Submit profile picture(optional) below:</strong></label>
          </div>
          <div class="form-group form-control-file col-sm-6 col-md-4">
            <input type="file" name="upload" accept="image/*" max="1">
          </div>
          <div class="form-group col-sm-10">
            <input type="submit" name="submit" class="btn btn-outline-secondary" value="Continue">
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
