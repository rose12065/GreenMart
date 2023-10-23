<?php

    include('connection.php');
    include('usernav.php');
    $id=$_SESSION['id'];
    $sql = "SELECT * FROM tbl_address WHERE user_id=$id";
    $all_product=$conn->query($sql);
    /*$find_user = mysqli_query($conn,$query);
    $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
  if(count($result) > 0) {
      $name= $result[0]['name']; // Access name from $result array
      $mobile= $result[0]['mobile'];
      $pin = $result[0]['pincode'];
      $flat= $result[0]['flat'];
      $landmark = $result[0]['landmark'];

  }*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Addresses</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
        .address-tile {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 15px;
        }

        .address-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Your Addresses</h2><br>

<div class="row" >
    <div class="col-md-4">
        <a href="add_address.php">
        <button  class="btn btn-primary">+ ADD ADDRESS</button></a>
    </div><br><br>
    <?php
       while($row = mysqli_fetch_assoc($all_product)){

      

?>
    <div class="col-md-4">
        <div class="">
            <p><strong><?php echo $row['name'] ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="editaddress.php ? address_id=<?php echo $row['address_id'] ?>"><span class="material-symbols-outlined">edit</span></a>
            &nbsp;&nbsp;&nbsp;<a href="deleteaddress.php ? address_id=<?php echo $row['address_id'] ?>">
            <span class="material-symbols-outlined">delete</span>
        </a>
            <p> Address : <?php echo $row['flat'] ?></p>
            <p>Pincode : <?php echo $row['pincode'] ?></p>
            <p>Area, Street, Landmark : <?php echo $row['landmark'] ?></p>
            <p>Phone number:<?php echo $row['mobile'] ?></p>
            <!-- <div class="address-actions">
                <button class="btn ">Set as Default</button>
            </div> -->
        </div>
    </div><br><br>

         
<?php


       }
?>
    </div>
</div>
    
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<?php
 
/*if (!isset($_SESSION['id'])) {
 header('location:./');
}
if (isset($_SESSION['address_id'])) {
 $addressId = $_SESSION['address_id'];
 $deleteQuery = "DELETE FROM tbl_address WHERE address_id = '$addressId' ";
 
 if (mysqli_query($conn, $deleteQuery)) { header("Location: profile.php"); 
exit();
 } else {
 echo "<script>alert('Default address cannot be deleted.')</script>";
}
}

mysqli_close($conn); */

?>
</html>
