  <?php
   include 'retrive.php';

   $cat = "SELECT * FROM businesscategory";
   $catqry = mysqli_query($cnct,$cat);
   if (!$catqry) {
     //die('Could not get category info'.mysql_error());
   }
   ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
      <head>
          <link rel="shortcut icon" href="img/bisadlogo.PNG" type="text/img">
          <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha512-iQQV+nXtBlmS3XiDrtmL+9/Z+ibux+YuowJjI4rcpO7NYgTzfTOiFNm09kWtfZzEB9fQ6TwOVc8lFVWooFuD/w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha512-n6dYFOG599s4/mGlA6E+YLgtg9uPTOMDUb0IprSMDYVLr0ctiRryPEQ8gpM4DCMlx7M2G3CK+ZcaoOoJolzdCg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
          <link rel="stylesheet" type="text/css" href="css/style.css">  
          <link rel="stylesheet" type="text/css" href="css/web_style.css"> 
          <title>Bisads</title>
      </head>
  <body>

      <div class="container-fluid p-1 pl-sm-4 bg-light">
          <a class="navbar-brand" href="#"><h4 style="color: #39ac73;">Wellcome To this web</h4></a>
      </div>
    <!-- Navigtion -->
      <div class="container-fluid bg-dark sticky-top border-bottom s-top" style="" id="s_top">
        <div class="row">
          <div class="col-1 d-sm-none" data-toggle="modal" data-target="#sideMenuModal">
            <span class="menu-icon d-sm-none" style="top: 7px"></span>
          </div>
          <div class="col-5 col-md-5">
                <a class="pl-md-5 ml-md-5 font-weight-bold font-italic" href="index.php" style="text-decoration: underline; font-size: 1.5rem; color: #999999;">
                  <span style="color:#39ac73;">Bi</span>sAd 
                </a>
            </div>
            <div class="col-5 col-md-7 w-100 pl-1 pl-sm-3 pr-3" style="">
                  <div class="pt-1" style="align-items:center; ">
                      <form class="form-row search-form" role = "form" name="form1" method="post" action="index.php">
                          <input class="form-control search" type="search" name="search_value" onfocus="this.placeholder='';" onblur="this.placeholder='Search spacific place'" placeholder="Search spacific place">
                          <input type="submit" class="submit-btn text-white" name="search" value="" style="background: url('img/icon-search.png') no-repeat; background-position: center;">
                      </form>
                  </div>
            </div>
        </div>
      </div>
      <!-- Modal: for side menu used for selecting catagory -->
      <div id="sideMenuModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm float-left m-0">
          <div class="modal-content">
            <div class="modal-header">
              <h3>Select By Catagory</h3>
              <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            </div>
            <div class="modal-body">
              <ul class="list-inline-item list-unstyled p-1">
                  
                  <?php
                    $cat = "SELECT * FROM businesscategory";
                    $catqry = mysqli_query($cnct,$cat);
                    if (!$catqry) {
                      die('Could not get category info'.mysql_error());
                    }
                    while($catrow = mysqli_fetch_assoc($catqry)):
                      $catid = "{$catrow['cat_id']}";
                      $catname = "{$catrow['cat_name']}";
                   ?>
                    <li class="text-dark">
                      <form id="cat_form"></form>
                      <a class="text-dark" href="index.php?catid=<?php echo $catid; ?>"><?php echo $catname; ?></a>
                    </li>
                    <?php endwhile ?>
              </ul>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="close" data-dismiss="modal">Close</button> -->
            </div>
          </div>
        </div>
      </div>


      
      <div class="container-fluid rounded d-sm-none" style="background-color: #39ac73;">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-0 col-xl-0 text-white">
              <p class="text-white">
                <h5>Make your work/service available for everyone!</h5>
              </p>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 row mb-1">
            <span class="ml-3 mt-lg-3 col-5">
              <a href="registration.php">
                <button type="button" class="btn btn-outline-light btn-sm">Register Here..</button>
              </a>
            </span>
            
            <span class="ml-3 mt-lg-3 col-5">
              <a href="busiadmin_page.php">
                <button type="button" class="btn btn-outline-light btn-sm">Goto your page..</button>
              </a>
            </span>
          </div>
        </div>
      </div>


      <div class="container-fluid position-relative" style="min-height: 500px;">
        <div class="row">
          <div class="col-0 col-sm-5 col-md-2 col-lg-2 border-right position-relative leftmenu">
            <div class="position-absolute" id="leftmenu">
              <h4 class="h6 text-center font-weight-bold pt-2">Select By Catagory</h4>
              <hr class="p-0">
              <ul class="list-inline-item list-unstyled p-1">
                  
                  <?php
                    $cat = "SELECT * FROM businesscategory";
                    $catqry = mysqli_query($cnct,$cat);
                    if (!$catqry) {
                      die('Could not get category info'.mysql_error());
                    }
                    while($catrow = mysqli_fetch_assoc($catqry)):
                      $catid = "{$catrow['cat_id']}";
                      $catname = "{$catrow['cat_name']}";
                   ?>
                    <li class="text-dark">
                      <form id="cat_form"></form>
                      <a class="text-dark" href="index.php?catid=<?php echo $catid; ?>"><?php echo $catname; ?></a>
                    </li>
                    <?php endwhile ?>
              </ul>
            </div>
          </div>


          <div class="col-12 col-xs-11 col-sm-8 col-md-7 col-lg-7 mt-3" style="">
            <div class="row">

              
            <?php
                // if users are searching using  placename
                if(isset($_POST['search'])&&$_POST["search_value"]!=""){
                  // write a search match and display back to the user code Here
                  //include 'search_result.php';
                include 'searchResult.php';

                }else if((isset($_POST['catid'])&& $_POST['catid'] != "")||(isset($_GET['catid'])&& $_GET['catid'] != "")){
                      //echo "yeeees";
                include 'catagoryshow.php';
                }
                else{
                    $business = "SELECT * FROM business ORDER BY b_id DESC";
                    $business_qry = mysqli_query($cnct,$business);
                    if(!$business_qry)
                    {
                      die('Could not get business data: ' . mysql_error());
                    }

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
                       // unique name or 'sefer' name
                      $additional_detail = $location_array[4];// for more detail info about the address

                      //echo "this is location info: ".$location_id."    ".$region."  ".$city."  ".$subcity."   ".$sefer."     ".$additional_detail."<br>";

                       /*
                       //if geo coordinate is needded
                        $coordinate_array = getCoordinate($location_id,$cnct);
                        $latitude = $coordinate_array[0];
                        $longitude = $coordinate_array[1];
                        */

              ?>


              <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 p-1">
                  <div class="" style="overflow: hidden;">
                    <div class="row">

                          <?php 
                                if($profile_img_src != ""){
                                    echo '<span class="col-5 col-sm-6 col-xs-5 col-md-5 col-lg-6"><a href="'.$profile_img_src.'"><img class="card-img w-100" style="height:100Px"  src="'. $profile_img_src.'" alt=""></a></span>';
                                } 
                          ?>
                      <span class="col-7 col-sm-6 col-xs-7 col-md-7 col-lg-6">
                          <h6 class="text-dark black-text">
                            <?php echo $business_name; ?>
                          </h6>
                        <section class="cat-name-sm">
                            <small class="text-secondary font-italic h6"><?php echo $cat_name; ?>
                           </small>
                        </section>
                        <section class="mt-sm-0">
                          <form class="" action="business_page.php" method="post">
                            <input type="text" name="hold" value="<?php echo $business_id; ?>" hidden>
                            <input type="submit" class="btn btn-link btn-sm detail-btn page-link font-weight-bold" name="submit" style="color: #39ac73;" value="See More....">
                          </form>
                        </section>
                      </span>
                    </div>

                    <div>
                        <?php 
                            echo '<section class="ml-1 font-italic"><strong class="cat-name-lg text-secondary text-capitalize">'. $cat_name.'</strong></section>'; 
                        ?>
                    </div>

                    <div class="location-aria" style="font-size: 0.7rem">
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
          <?php } ?>

            </div>
          </div>

          <div class="col-0 col-md-3 col-lg-3 p-2 w-auto position-relative d-none d-sm-block">
              <div class="rounded position-fixed">
                <div class="p-3" style="background-color: #39ac73;">
                    <div class="">
                          <h5 class="text-white">Make your work/service available for everyone!</h5>
                    </div>
                    <div class="m-4">
                      <span class="ml-3 mt-lg-3">
                        <a href="registration.php">
                          <button type="button" class="btn btn-outline-light btn-sm">Register Here..</button>
                        </a>
                      </span>












                      
                      <span class="ml-3 mt-lg-3">
                        <a href="busiadmin_page.php">
                          <button type="button" class="btn btn-outline-light btn-sm">Goto your page..</button>
                        </a>
                      </span>
                    </div>
                  </div>
                  <div id="myCarousel" class="carousel slide mt-2" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                      <li data-target="#myCarousel" data-slide-to="3"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">
                        <img class="" src="img/a.jpg" alt="China">
                        <div class="carousel-caption">
                          <h3 class="text-dark">Promotion</h3>
                          <p class="text-dark">Promote your business by registering...</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="" src="img/b.jpg" alt="China">
                        <div class="carousel-caption">
                            <h3 class="text-dark">Bisad</h3>
                            <p class="text-dark">Nicest place to find things around you</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="" src="img/c.jpg" alt="China">
                        <div class="carousel-caption">
                            <h3 class="text-dark">Connections</h3>
                            <p class="text-dark">Make connections with people...</p>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <img class="" src="img/d.jpg" alt="China">
                        <div class="carousel-caption">
                            <h3 class="text-dark">Accessible</h3>
                            <p class="text-dark">Make your business accessable for eveyone</p>
                        </div>
                      </div>
                    </div>

                    <!-- Left and Right control -->
                      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
                      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon"></span></a>
                  </div> 
                </div> 
            </div>
        </div>
      </div>

      <div>
          <?php 
            //  $ip = $_SERVER['REMOTE_ADDR'];
            // $port = $_SERVER['REMOTE_PORT'];
            //  $url = $_SERVER['SCRIPT_URI'];
            // $name = $_SERVER['SCRIPT_NAME'];
            // echo "The ip is : ".$ip." and ".$port." and ".$url." AND ".$name; 
          ?>
      </div>

      <footer class="container-fluid w-100">
              <div class="row text-center">
                  <div class="col-12">
                      <hr class="light">
                      <h5 class="text-white">&copy; All Rights Are Reserved.</h5>
                  </div>
              </div>
      </footer>

      <script type="text/javascript">
        function srch(){
          //alert("hello");
          document.getElementById("form-slct").submit();
        }
        function cat_show(arg) {
           //alert(arg);
           var form = document.getElementById("cat_form");
           form.setAttribute("action","index.php");
           form.setAttribute("method", "get");
           var inp = document.createElement("input");
           inp.setAttribute("type","text");
           inp.setAttribute("name","catid");
           inp.setAttribute("value",arg);
           form.appendChild(inp);
          // form.submit();
           document.getElementById("cat_form").submit();
        }
        
        if(matchMedia){
          const mp = window.matchMedia("(max-width: 576px)");
          mp.addListener(WidthChange);
          WidthChange(mp);
              
        }
        function WidthChange(mp){
          if(mp.matches){
            //document.getElementById("cat-option").style.display = "block"; 
            document.getElementById("leftmenu").style.display = "none";      
          }else{
            //document.getElementById("cat-option").style.display = "none";
            document.getElementById("leftmenu").style.display = "block";      
          }
        }

        if(window.addEventListener){
            window.addEventListener("scroll", function () {fix_sidemenu(); });
        }

        function scrolltop(){
          var top=0;
          if(typeof(window.pageYOffset) == "number"){
              top = window.pageYOffset;
          }else if (document.body && document.body.scrollTop) {
              top = document.body.scrollTop;
          }else if (document.documentElement && document.documentElement.scrollTop){
              top = document.documentElement.scrollTop;
          }
          return top;
        }
    
        function fix_sidemenu(){
          var sTop = scrolltop();

          if(sTop <= 10){
            document.getElementById("s_top").style.position = "";
          }else if(sTop > 10){
            //document.getElementById("s_top").style.position = "fixed";
          }
          if(sTop < 80){
            document.getElementById("leftmenu").style.top = '';
            document.getElementById("leftmenu").style.paddingTop = "0rem"; 
          }
          if(sTop >= 80){
            document.getElementById("leftmenu").style.top = "0";
            document.getElementById("leftmenu").style.paddingTop = "3.3rem";
            //document.getElementById("leftmenu").style.position = "fixed";
            document.getElementById("leftmenu").style.transition = "0s";
          }
        }
      </script>
  </body>
</html>
