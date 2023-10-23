
<?php
require('../connection.php');
$sql="SELECT * FROM tbl_category";
        $all_cat = $conn->query($sql);
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
                            <a class="nav-link" href="addedproducts.php"><i class="fas fa-list"></i> List Products</a>
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
                <h3>Add Products</h3>
            <div class="product-form">
                <form action="" method="post" enctype="multipart/form-data" >
                    <!-- Product Name -->
                    <div class="mb-3 col-md-3">
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name"required>
                    </div>

                    <div class="col-md-3">

                        <textarea class="form-control" id="description" name="description" rows="3"placeholder="Description" required></textarea>
                    </div>
                    <!-- Unit Price -->
                    <br><div class="col-md-3">
                        
                        <input type="text" class="form-control" id="unitPrice" name="unitPrice" placeholder="Unit Price"required>
                    </div><br>
                    <div class="col-md-3">
                   
                    <label for="category">Select Category:</label>
                    

                            <select id="category" name="category" class="form-control"  placeholder="Select Category">
                            <?php
 while ($row = mysqli_fetch_assoc($all_cat)) {
    $catId=$row['category_id'];
                                ?>
                                <option value="<?php echo $row['category_id'] ?>" ><?php echo $row['category_name'] ?></option>
                                
                              <?php
                              
 }

 ?>
                            </select>
                            <input type="hidden" name="cat_id" value="<?php echo $catId; ?>">
        </div>
                    <br><div class="col-md-3">
                        
                        <input type="text" class="form-control" id="stock" name="stock"placeholder="stock" required>
                    </div>

                    <!-- Description -->
                    
                    <div class="col-md-3">
                        <label for="image" class="form-label">Upload Image</label>
                        <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
                         </div><br>
                    <div class="col-md-3">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-secondary" name="add_product">Add Product</button>
                     </div>
        </form> 

            </div>

            <?php
                    if(isset($_POST['add_product'])){
                        $sellerId=$_SESSION['sellerid'];
                        $pdtname=$_POST['productName'];
                        $price=$_POST['unitPrice'];
                        $stock=$_POST['stock'];
                        $description=$_POST['description'];
                        $cat_id=$_POST['category'];
                        $imageData=addslashes(file_get_contents($_FILES['image']['tmp_name']));
                        
                        $sql = "INSERT INTO tbl_product (product_name, unit_price, product_discription, category_id, seller_id,product_image,stock) 
                        VALUES ('$pdtname', '$price', '$description', '$cat_id ', '$sellerId', '$imageData','$stock')";

                    if ($conn->query($sql) === TRUE) {
                        echo '<script>alert("Product inserted successfully")</script>';
                        
                    } else {

                    } 
                        }
                    
                    mysqli_close($conn); 
                
            ?>
        </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
