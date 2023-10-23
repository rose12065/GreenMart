<?php
    require('navbar.php');
    //require('connection.php');
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
 
 </head>
 <body>
  <div class="container">
   <div class="panel panel-default">
   
   </div>
  </div>
 </body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <script src="script.js"> </script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>
<body>
    <div class="container mt-5" >
        <h2 class="mb-3 text-center">Login Form</h2>
         <div class="row">
        <div class="col-md-6 offset-md-3">

        <form  method="post">
            
            
            <div class="form-group">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email"  required>
                <span id="lblErrorEmail" style="color: red"></span>
            </div>
            
            
            <div class="form-group">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password"  required>
                <i class="bi bi-eye-slash" id="togglePassword"></i>
                <span id="lblErrorPass" style="color: red"></span>
            </div>

           <a href="recover_psw.php">forgot password ?</a><br><br>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="login" id ="login"class="btn btn-secondary">Login</button>
            <?php

include('google_config.php');

$login_button = '';


if(isset($_GET["code"]))
{

 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


 if(!isset($token['error']))
 {
 
  $google_client->setAccessToken($token['access_token']);

 
  $_SESSION['access_token'] = $token['access_token'];


  $google_service = new Google_Service_Oauth2($google_client);

 
  $data = $google_service->userinfo->get();

 
  if(!empty($data['given_name']))
  {
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name']))
  {
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email']))
  {
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender']))
  {
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture']))
  {
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}


if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'" class="btn btn-sm btn-google text-uppercase btn-outline"><img src="https://img.icons8.com/color/16/000000/google-logo.png"> Signup Using Google</a>';
}

 ?>
             <p>Not have an account <a href="signup.php">sign up</a> </p>

</form>
     </div>
    
 </div>
 </div>
 <?php
   if($login_button == '')
   {
    $email=$_SESSION['user_email_address'];
    $query = "SELECT * FROM tbl_role WHERE email='$email'";
      $find_user = mysqli_query($conn,$query);
      $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
      if(count($result) > 0) {
        $role=$result[0]['role'];

        if($role=='customer'){
            $query = "SELECT * FROM tbl_user_register WHERE user_email='$email'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['user_name']; // Access name from $result array
              $_SESSION['id'] = $result[0]['user_id'];
              echo"<script>window.location.href='dashboard.php';</script>";
          }
        }
        elseif($role=='seller'){
            $query = "SELECT * FROM tbl_seller_register WHERE seller_email='$email'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['seller_name']; // Access name from $result array
              $_SESSION['sellerid'] = $result[0]['seller_id'];
              echo"<script>window.location.href='seller/sellerdashboard.php';</script>";
          }
        }
        elseif ($role=='admin'){
          $query = "SELECT * FROM tbl_admin_register WHERE admin_email='$email' AND admin_password='$password'";
          $find_user = mysqli_query($conn,$query);
          $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
        if(count($result) > 0) {
            $_SESSION['name'] = $result[0]['admin_name']; // Access name from $result array
            $_SESSION['adminid'] = $result[0]['admin_id'];
            echo"<script>window.location.href='admin/admindashboard.php';</script>";
        }
      }
      else{
        echo"<script>alert('No user Exist');</script>";
      }

      }
      else{
        echo"<div class='text-center'>Not a registered user <a href='logout.php'>Create Account </div> ";
      }
   }
   else
   {
    echo '<div align="center">'.$login_button . '</div>';
   }
    ?>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="js/myscripts.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
               

<?php

    //  include('connection.php');
    if (isset($_POST['login'])) {
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $password = filter_var($_POST['pwd'],FILTER_SANITIZE_SPECIAL_CHARS);

      $query = "SELECT * FROM tbl_role WHERE email='$email' AND password='$password'";
      $find_user = mysqli_query($conn,$query);
      $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
      if(count($result) > 0) {
        $role=$result[0]['role'];

        if($role=='customer'){
            $query = "SELECT * FROM tbl_user_register WHERE user_email='$email' AND user_password='$password'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['user_name']; // Access name from $result array
              $_SESSION['id'] = $result[0]['user_id'];
              echo"<script>window.location.href='dashboard.php';</script>";
          }
        }
        elseif($role=='seller'){
            $query = "SELECT * FROM tbl_seller_register WHERE seller_email='$email' AND seller_password='$password' and status=1";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['seller_name']; // Access name from $result array
              $_SESSION['sellerid'] = $result[0]['seller_id'];
              echo"<script>window.location.href='seller/sellerdashboard.php';</script>";
          }
          else{?>

<div class="alert alert-danger alert-dismissible w-50">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Can't Login!!</strong> Not Approved By Admin.
  </div>

         <?php }
        }
        else{
          $query = "SELECT * FROM tbl_admin_register WHERE admin_email='$email' AND admin_password='$password'";
          $find_user = mysqli_query($conn,$query);
          $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
        if(count($result) > 0) {
            $_SESSION['name'] = $result['admin_name'];// Access name from $result array
            $_SESSION['adminid'] = $result[0]['admin_id'];
            echo"<script>window.location.href='admin/admindashboard.php';</script>";
        }
      }
    }
    else {
        echo "Email or password incorrect";
    }
    }


?>
</body>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('pwd');

    toggle.addEventListener('click', function(){
        if(password.type === "pwd"){
            password.type = 'text';
        }else{
            password.type = 'pwd';
        }
        this.classList.toggle('bi-eye');
    });
</script>

</html>