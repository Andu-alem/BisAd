<?php
  include "register_sub.php";
  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
      user_registration($cnct);
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" href="icon-search.PNG" type="text/img">
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <link rel="stylesheet" href="bootstrap-4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="jquery/jquery.js"></script> 
    <script type="text/javascript" src="bootstrap-4.1.3/js/bootstrap.js"></script>
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
      <div class="col-12 col-sm-8 mt-5 p-4 bg-white">
        <div class="col-sm-9 pb-3">
          <h5 class="h5 text-dark">Submit Information By Filling The Form Properly</h5>
        </div>

        <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  name="myForm" role="form" novalidate>
          <div class="col-sm-8 col-md-6">
            <label class="form-text"><strong>User Registration:</strong></label>
          </div>

          <div class="form-group col-sm-8 col-md-6" id="unDiv">
            <input type="name" class="form-control" placeholder="Your Name/User Name" name="username" id="username" required>
          </div>

          <div class="form-group col-sm-8 col-md-6" id="emailDiv">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
          </div>

          <div class="form-group col-sm-8 col-md-6">
            <input type="tel" class="form-control" placeholder="phone" name="phone" id="phone" required>
          </div>

          <div class="form-group col-sm-8 col-md-6" id="pwdDiv">
            <input type="password" class="form-control" placeholder="Enter Password" name="password" id="password" required>
          </div>

          <div class="form-group col-sm-8 col-md-6" id="confirmDiv">
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm" id="confirmation" required>
          </div>
          <div class="form-group col-sm-10">
            <input type="submit" id="submitBtn" name="submit" class="btn btn-outline-secondary" value="Continue">
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            //$("#submitBtn").disabled = true;
            $("#submitBtn").attr("disabled", true);
            $("#confirmation").attr("disabled", true);
            var errors = {'name': true, 'pwd': true, 'confirm': true, 'phone': true, 'email': true};

            $("#username").on({
              change: function(){
                if($(this).val().length == 0){
                  $("#unDiv").append("<p class='text-danger'>Please enter your name</p>");
                  errors['name'] = true;
                }else{
                  errors['name'] = false;
                }
                enableSubmit();
              }
            });

            $("#email").on({
              change: function(){
                if($(this).val().length == 0){
                  $("#emailDiv").append("<p class='text-danger'>Please enter your email</p>");
                  errors['email'] = true;
                }else{
                  var email = $(this).val();
                  if(!(/@/.test(email)) && !(/.com/i.test(email))){
                     $("#emailDiv").append("<p class='text-danger'>Email must look like this: name@example.com</p>");
                     errors['email'] = true;
                  }else{
                    errors['email'] = false;
                    enableSubmit();
                  }
                }
              }
            });

            $("#phone").on({
              change: function(){
                if($(this).val().length == 0){
                  $("#unDiv").append("<p class='text-danger'>Please enter your name</p>");
                  errors['phone'] = true;
                }else if($(this).val().length < 10){
                }else {
                  errors['phone'] = false;
                }
                enableSubmit();
              }
            });

            $("#password").on({
                change: function(){
                  var pwdLength = $(this).val().length;
                  if(pwdLength == 0){
                    $("#pwdDiv").append("<p class='text-danger'>Please type your password");
                    $("#confirmation").attr("disabled", true);
                    errors['pwd'] = true;
                  }else if(pwdLength > 0 && pwdLength < 8){
                    $("#pwdDiv").append("<p class='text-danger'>Password must be >= 8");
                    $("#confirmation").attr("disabled", true);
                    errors['pwd'] = true;
                  }else{
                    $("#confirmation").attr("disabled", false);
                    errors['pwd'] = false;
                  }
                  enableSubmit();
                }
            });
            $("#confirmation").on({
                change: function(){
                  var pwdLength = $(this).val().length;
                  if(pwdLength == 0){
                    $("#confirmDiv").append("<p class='text-danger'>Please confirm your password");
                    errors['confirm'] = true;
                  }else if(pwdLength > 0 && pwdLength < 8){
                    $("#confirmDiv").append("<p class='text-danger'>Password must be >= 8");
                    errors['confirm'] = true;
                  }else if($("#password").val() != $(this).val()){
                    $("#confirmDiv").append("<p class='text-danger'>Password didn't match");
                    errors['confirm'] = true;
                  }else {
                    errors['confirm'] = false;
                  }
                  enableSubmit();
                }
            });

            function enableSubmit(){
              var counter = 0;
              for(k in errors){
                if(errors[k] == true){
                  counter++;
                }
              }
              if(counter > 0){
                $('#submitBtn').attr('disabled', true);
              }else{
                $('#submitBtn').attr('disabled', false);
              }
            }
        });
    </script>
  </body>
</html>
