<?php  
    include('navbar.php');
?>
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
            
            <button type="submit" name="login" id ="login"class="btn btn-secondary">Login</button>
            <p>Not have an account <a href="signup.php">sign up</a> </p>

        </form>
    </div>
    
</div>
</div>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="js/myscripts.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
               

<?php

     include('connection.php');
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
            header("Location: dashboard.php"); 
          }
        }
        elseif($role=='seller'){
            $query = "SELECT * FROM tbl_seller_register WHERE seller_email='$email' AND seller_password='$password'";
            $find_user = mysqli_query($conn,$query);
            $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
          if(count($result) > 0) {
              $_SESSION['name'] = $result[0]['seller_name']; // Access name from $result array
              $_SESSION['sellerid'] = $result[0]['seller_id'];
            header("Location: seller/sellerdashboard.php"); 
          }
        }
        else{
            header("Location: admindashboard.php"); 
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