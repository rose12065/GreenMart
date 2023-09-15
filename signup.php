<?php  
    include('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User & Seller Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="js/myscripts.js"> </script>
</head>
<body>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="registrationTabs">
        <li class="nav-item">
            <a class="nav-link active" id="userTab" data-toggle="tab" href="#userRegistration">User Registration</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sellerTab" data-toggle="tab" href="#sellerRegistration">Seller Registration</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- User Registration Form -->
        <div id="userRegistration" class="tab-pane fade show active">
            <form action="" method="post">
                <!-- User registration form fields go here -->
                <h2>User Registration</h2>
                <div class="form-group col-md-3" >
                
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" onkeyup="validateName()" required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="validateEmail()" required>
                <span id="lblErrorEmail" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Mobile Number" onkeyup="validatePhone()"required>
                <span id="lblErrorPhone" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" onkeyup="validatePassword()" required>
                <span id="lblErrorPass" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="password" class="form-control" id="repeat-pwd" name="repeat-pwd" placeholder="Repeat Password" onkeyup="validateRepeatPassword()" required>
                <span id="lblErrorRepeatPass" style="color: red"></span>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="send" id="send" class="btn btn-success" onclick="validateRegister()">Register As User</button></form>
            <p>Already have an account <a href="login.php">Login</a></p>
        </div>

        <!-- Seller Registration Form -->
        <div id="sellerRegistration" class="tab-pane fade">
            <form action="" method="post">
                <!-- Seller registration form fields go here -->
                <h2>Seller Registration</h2>
                <div class="form-group col-md-3" >
                
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" onkeyup="validateName()" required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            <div class="form-group col-md-3" >
                
                <input type="text" class="form-control" id="company" name="company" placeholder="company" onkeyup="validateName()" required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            <div class="form-group col-md-3">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="validateEmail()" required>
                <span id="lblErrorEmail" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Mobile Number" onkeyup="validatePhone()"required>
                <span id="lblErrorPhone" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" onkeyup="validatePassword()" required>
                <span id="lblErrorPass" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="password" class="form-control" id="repeat-pwd" name="repeat-pwd" placeholder="Repeat Password" onkeyup="validateRepeatPassword()" required>
                <span id="lblErrorRepeatPass" style="color: red"></span>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="sendseller" id="sendseller" class="btn btn-success" onclick="validateRegister()">Register As seller</button>
            </form>
            <p>Already have an account <a href="login.php">Login</a></p>
        </div>
    </div>
</div>
<?php
            $con=mysqli_connect("localhost","root","","greenmart");
            if($con===false){
                die(Error);
            }
           if(isset($_POST['send']))
           {
            $name = $_POST['uname'];
            $email = $_POST['email'];
            $phone=$_POST['phone'];
            $pwd = $_POST['pwd'];

            $emailCheckQuery = "SELECT * FROM tbl_user_register WHERE user_email='$email'";
            $emailCheckResult = mysqli_query($con, $emailCheckQuery);
            
            if (mysqli_num_rows($emailCheckResult) > 0) {
                echo "Email is already registered.";
                exit();
            }
            $query="INSERT INTO tbl_role(email, password,  role)  values('$email','$pwd','customer')";
            if(mysqli_query($con,$query)){
                $sql="INSERT INTO tbl_user_register(user_name , user_email, user_password,  user_mobile)  values('$name','$email','$pwd',$phone)";
                if(mysqli_query($con,$sql))
                {?>
                  <script>
                  if(window.confirm('REgistration succsesful'))
                  {
                  window.location.href='login.php';
                  header("Location: login.php");
                  };
                </script><?php
                }
                
                else{
                    echo"Error";
                }
            }
            
        }
           
           if(isset($_POST['sendseller']))
           {
            $name = $_POST['uname'];
            $company=$_POST['company'];
            $email = $_POST['email'];
            $phone=$_POST['phone'];
            $pwd = $_POST['pwd'];

            $emailCheckQuery = "SELECT * FROM tbl_user_register WHERE user_email='$email'";
            $emailCheckResult = mysqli_query($con, $emailCheckQuery);
            
            if (mysqli_num_rows($emailCheckResult) > 0) {
                echo "Email is already registered.";
                exit();
            }
            $query="INSERT INTO tbl_role(email, password,  role)  values('$email','$pwd','seller')";
            if(mysqli_query($con,$query)){
            $sql="INSERT INTO tbl_seller_register(seller_name , company, seller_mobile,seller_email, seller_password)  values('$name','$company',$phone,'$email','$pwd')";
            if(mysqli_query($con,$sql))
            {?>
              <script>
              if(window.confirm('REgistration succsesful'))
              {
              window.location.href='login.php';
              header("Location: login.php");
              };
            </script><?php
            }
            
            else{
                echo"Error";
            }
           }
        }
           mysqli_close($con); 
        
  ?>
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
