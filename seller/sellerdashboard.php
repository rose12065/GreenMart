<?php
require('../connection.php');
$sellerId=$_SESSION['sellerid'];
$sql = "SELECT * FROM tbl_seller_register where seller_id =$sellerId";
$all_seller = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <style>
        /* Add your custom styles here */
        body {
            background-color: #ffffff;
        }
        .sidebar {
            background-color: #ffffff;
            color: white;
        }
        .navbar {
            background-color: #090909;
        }
        .nav-link {
            color: rgb(13, 12, 12);
        }
        .nav-link:hover {
            color: #484744;
        }
        .active {
            background-color: #eceae6;
        }
        .navbar-brand {
            color: rgba(50, 47, 47, 0.518);
        }
        main {
            background-color: rgb(226, 222, 222);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-store"></i> Vendor Dashboard</a>
        <!-- Add your profile, add product, and logout buttons here -->
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="sellerdashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addproduct.php"><i class="fas fa-box"></i> Add Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addedproducts.php "><i class="fas fa-list"></i> List Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php"><i class="fas fa-person"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
             
                <!-- Add your colorful content here -->
                <?php
                        while ($row = mysqli_fetch_assoc($all_seller)){

                        
                    ?>
    <div class="container mt-5">
        <div class="row">
            
            <div class="col-md-6">
                <!-- Seller details card on the right side -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Seller Details</h5>
                        <p  class="card-text">
                        <img src="../images/sellericon.png" class="img-fluid rounded-circle mb-3" width=30px height=30px alt="Seller Avatar"><br>
                        <?php echo $row['seller_name']; ?></p>
                        <p class="card-text"><?php echo $row['company']; ?></p>
                        <p class="card-text"><?php echo $row['seller_email']; ?> | <?php echo $row['seller_mobile']; ?></p>
                        
                    </div>
                </div>
            </div>
<?php

                        }
                        ?>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-Ber3r6BHA7zjcqD51zS6NME1z2tE2K5z2PpC5ta5F5CqDn5Iq5K5Bd5Bd5Bd5Bd5Bd5" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>
