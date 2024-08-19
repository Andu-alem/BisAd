<?php 
    session_start();
    $user_id = $_SESSION['user_id'];
    if(!$user_id){
      header('location:login.php');
       exit();
    }else{
          
        /*$bid_qry = "SELECT b_id FROM user WHERE u_id = '$user_id'";
        $qry = mysqli_query($cnct,$bid_qry);
        if(!$qry)
        {
            die('Could not get business id: ' . mysql_error());
        }
        $b_row = mysqli_fetch_array($qry);
        $business_id = $b_row[0];
        $_SESSION['business_id'] = $business_id;*/
        $business_id = $_SESSION['business_id'];
    }
    include 'retrive.php';
    // $get_val = $_POST['hold'];

    $business = "SELECT b_name,cat_id FROM business WHERE b_id = '$business_id'";
    $business_qry = mysqli_query($cnct,$business);
    if(!$business_qry)
    {
        die('Could not get business data: ' . mysql_error());
    }
    $b_row = mysqli_fetch_array($business_qry);

    //$business_id = '1';
    $business_name = $b_row[0];
    $business_type = $b_row[1];

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
    $additional_detail = $location_array[4];


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
        <script type="text/javascript" src="jquery/jquery.js"></script>
        <script type="text/javascript" src="bootstrap-4.1.3/js/bootstrap.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <title>Advertise</title>
    </head>

  <body>

    <div class="navbar navbar-expand-md container-fluid bg-white row  border-bottom sticky-top" style="padding: 0rem 0.2rem;">
        <div class = "col-9 col-sm-4  pl-5 pl-md-5">
            <a class="navbar-brand font-weight-bold font-italic" href="index.php" style="text-decoration: underline; font-size: 2.5rem; color: #999999;">
                <span style="color:#39ac73;">Bi</span>sAd
            </a>
        </div>
        <div class="col-9 col-sm-6 pt-1">
                <h2 class="text-justify"><?php echo $business_name; ?></h2>
                <h4 class="font-italic text-secondary pl-2"><?php echo $cat_name; ?></h4>
        </div>

        <div class="dropdown col-3 col-sm-2">
            <button class="btn dropdown-toggle" id="menu1" type="button" data-toggle="dropdown" style="background-color: #39ac73;">Tools
                <span class="caret"></span>
            </button>

            <ul class="dropdown-menu dropdown-menu-right bg-secondary" role="menu" aria-labelledby="menu1">
                <li role="presentation">
                <a role="menuitem" tabindex="-1" href="post.php" class="nav-link text-white">Submit post</a>
                </li>
                <li role="presentation">
                <a role="menuitem" tabindex="-1" href="manage_post.php" class="nav-link text-white">Manage Post</a>
                </li>

                <li role="presentation">
                <a role="menuitem" tabindex="-1" href="manage_account.php" class="nav-link text-white">Manage Account</a>
                </li>
                <li role="presentation">
                <a href="post.php" class="nav-link text-white">Edit profile</a>
                </li>
                <li role="presentation">
                <a role="menuitem" tabindex="-1" href="logout.php" class="nav-link text-white">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="container-fluid row mt-1">
        <div class="col-12 col-sm-3 col-md-4 col-lg-4 rightborder position-relative hidden-overflow w-100">
            <div class="fixed-position">
                <div class="mt-1">
                    <strong class="text-uppercase">Location:</strong>
                    <div>
                        <h6 class="text-capitalise text-secondary">
                            <?php echo $city.", "; ?>
                            <small>
                            <strong ><?php echo $subcity.", "?></strong>
                            </small>
                        </h6>
                        <strong class="text-capitalise text-secondary font-italic">
                            <?php echo $additional_detail; ?>
                        </strong>
                    </div>
                    <div>
                        <a href="#map_api">
                            <button type="button" class="btn btn-outline-secondary btn-sm">Follow Using Map</button>
                        </a>
                    </div>
                </div>
                <div class="mt-3">
                    <h6 class="text-capitalise w-100"><strong><i>Company Profile/Short Promotion</i></strong></h6>
                    <div>
                        <p style="white-space: pre-line;"><?php echo $profile_txt; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-6 bg-white">
            <?php 
                if($profile_img_src != "" && $profile_img_src != NULL){
                    echo '<a href="'.$profile_img_src.'"> <img class="card-img w-100";"  src="'.$profile_img_src.'" alt="" style="height: 300px;"></a>';
                }
            ?>
            <?php 
                //$posts = "SELECT * FROM post WHERE b_id = '$get_val'";
                $posts = "SELECT * FROM post WHERE b_id = '$business_id' ORDER BY post_date DESC";
                $post_qry = mysqli_query($cnct,$posts);
                if(!$post_qry){
                    die('Cold not get posts'.mysql_error());
                }
                    while($row = mysqli_fetch_assoc($post_qry)):
                        $post_text = $row['post_text'];
                        $timeStamp = $row['post_date'];
                        $post_id = $row['p_id'];
                        $post_img = "SELECT img_id FROM post_img WHERE post_id = '$post_id'";
                        $post_qry = mysqli_query($cnct,$post_img);
                        if(!$post_qry)
                        {
                            die('Could not get business id data: ' . mysql_error());
                        }
                        $qry_row = mysqli_fetch_array($post_qry);
                        $img_id = $qry_row[0];
            ?>
            <div class="border mt-3 p-3 w-100">
                <p>Post date: <?php echo date("F Y, \a\\t g.i a",$timeStamp); ?></p>
                <p style="white-space: pre-line;"><?php echo $post_text; ?></p>
                <?php 
                    $img_name_qry = "SELECT img_name FROM image WHERE img_id = '$img_id'";
                    $imgn_qry = mysqli_query($cnct,$img_name_qry);
                    $post_img_name = mysqli_fetch_array($imgn_qry)[0];
                    echo '<img class="col-12" src="'.$post_img_name.'">';
                ?>
            </div>

            <?php endwhile ?>
            <div class="border mt-3 w-100 p-3">
                <p style="white-space: pre-line;">New posts of the company goes here<br>
                    business owners or institutions can post new informations about themselves here<br>
                    they can inform thir customers about their new updates and also they can <br>
                    give whatever information about their business here
                </p>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            //$(".dropdown-toggle").dropdown("toggle");
        });
    </script>

  </body>
</html>
