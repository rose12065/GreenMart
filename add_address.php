<!DOCTYPE html>
<html lang="en">
<html>
<?php
require 'connection.php'; 
        include('usernav.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Address</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add a New Address</h2>
        <form action ="account-settings.php"method="post">
            <div class="form-group">
                <label for="fullName">Full name (First and Last name)</label>
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter your full name" onkeyup="validateName()" required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile number</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your mobile number" pattern="[0-9]{10}"  onkeyup="validatePhone()"required>
                <span id="lblErrorPhone" style="color: red"></span>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="pincode">Pincode</label>
                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pincode" onkeyup="validatePincode()"required>
                    <span id="lblErrorPincode" style="color: red"></span>
                </div>
                <div class="form-group col-md-8">
                    <label for="flat">Flat, House no., Building, Apartment</label>
                    <input type="text" class="form-control" id="flat" name="flat" placeholder="Enter flat or house no." onkeyup="validateFlat()"required>
                    <span id="lblErrorFlat" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="area">Area, Street, Landmark</label>
                <input type="text" class="form-control" id="area"name="area" placeholder="Enter area, street, landmark" onkeyup="validateArea()"required>
                <span id="lblErrorArea" style="color: red"></span>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="defaultAddress">
                    <label class="form-check-label" for="defaultAddress">
                        Make this my default address
                    </label>
                </div>
            </div>
            
            <button type="submit" id="address"name="address"class="btn btn-primary">Add Address</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="js/myscripts.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php


if (isset($_POST['address'])) {
$user_id = $_SESSION['id'];
$name = $_POST['uname'];
$mobile_number = $_POST['phone'];
$pincode = $_POST['pincode'];
$flat = $_POST['flat'] ;
$area = $_POST['area'];


$sql = "INSERT INTO tbl_address (user_id, name, mobile, pincode, flat, landmark) 
        VALUES ('$user_id', '$name', '$mobile_number', '$pincode', '$flat', '$area')";

if ($conn->query($sql) === TRUE) {
    echo "Address inserted successfully.";
    
} else {
    echo "Error: " . $conn->error;
}


}

mysqli_close($conn); // Close the database connection
?>

</html>

   