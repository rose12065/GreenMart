<?php
require("connection.php");
if (isset($_GET['address_id'])) {
    $addressId = $_GET['address_id'];

$id = $_SESSION['id'];
$sql = "SELECT * FROM tbl_address WHERE user_id=$id and address_id=$addressId";
$all_product=$conn->query($sql);
while($row = mysqli_fetch_assoc($all_product)){
    $name=$row['name'];
    $phone=$row['mobile'];
    $pincode=$row['pincode'];
    $flat=$row['flat'];
    $landmark=$row['landmark'];
}

}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<?php
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
                <input type="text" class="form-control" id="uname" name="uname" value="<?php echo $name;?> " onkeyup="validateName()"required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            <div class="form-group">
                <label for="mobileNumber">Mobile number</label>
                <input type="text" class="form-control" id="phone" name="phone"    value="<?php echo $phone;?> " onkeyup="validatePhone()"required>
                <span id="lblErrorPhone" style="color: red"></span>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="pincode">Pincode</label>
                    <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter pincode"value="<?php echo $pincode;?> " onkeyup="validatePincode()"required>
                    <span id="lblErrorPincode" style="color: red"></span>
                </div>
                <div class="form-group col-md-8">
                    <label for="flat">Flat, House no., Building, Apartment</label>
                    <input type="text" class="form-control" id="flat" name="flat" placeholder="Enter flat or house no." value="<?php echo $flat;?> "onkeyup="validateFlat()"required>
                    <span id="lblErrorFlat" style="color: red"></span>
                </div>
            </div>
            <div class="form-group">
                <label for="area">Area, Street, Landmark</label>
                <input type="text" class="form-control" id="area"name="area" placeholder="Enter area, street, landmark"value="<?php echo $landmark;?> " onkeyup="validateArea()"required>
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
            
            <button type="submit" id="update_address"name="update_address"class="btn btn-primary">update Address</button>
        </form>
        <?php
                if (isset($_POST['update_address'])) {
                    echo'<script>alert("hai")</script>';
                    $name = $_POST['uname'];
                    $mobile_number = $_POST['phone'];
                    $pincode = $_POST['pincode'];
                    $flat = $_POST['flat'] ;
                    $area = $_POST['area'];
                echo '<script>alert("hai")</script>' ;
                    $sql="UPDATE tbl_address SET name='$name',mobile='$mobile_number',pincode='$pincode',flat='$flat',landmark='$area' WHERE address_id=$addressId ";
                    if ($conn->query($sql) === TRUE) {
                        echo "Address updated successfully.";
                        
                    } else {
                        echo "Error: " . $conn->error;
                    }
                    
                    
                    }
                    
                    mysqli_close($conn);
        ?>
    </div>
    <!-- Include Bootstrap JS and jQuery -->
    <script src="js/myscripts.js"> </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>