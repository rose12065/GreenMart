<?php
require('../connection.php');
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
        $sql = "SELECT * FROM tbl_product where product_id=$productId ";
        $all_product=$conn->query($sql);
        while($row = mysqli_fetch_assoc($all_product)){
            $productId=$row['product_id'];
            $productName=$row['product_name'];
            $price=$row['unit_price'];
            $productDiscription=$row['product_discription'];
            $productImage=$row['product_image'];
            $old_stock=$row['stock'];
            $catId=$row['category_id'];
        }

        $query ="SELECT * FROM tbl_category where category_id=$catId";
        $all_cat=$conn->query($query);
        while($row = mysqli_fetch_assoc($all_cat)){
                $catName=$row['category_name'];
        }

}
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
            <!-- Sidebar content here -->
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="sellerdashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
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
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">
            <div class="row pt-4">
                <div class="col-md-6 ">
                    <!-- Left column content here -->
                    <h1><i class="fas fa-store"></i> Edit Product Details</h1>
                    <form action="" method="post" enctype="multipart/form-data">
                    <!-- Add your colorful content here -->
                    <div class="mb-3">
                    <label for="price"> Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName"  value="<?php echo $productName ?>" required>
                            </div>
                            <div class="mb-3">
                            <label for="price"> Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" value="<?php echo $productDiscription?>"  required></textarea>
                            </div>
                            <script>
    document.getElementById("description").value = "<?php echo $productDiscription ?>";
    
</script>
                            <div class="mb-3">
                                <label for="price"> Price</label>
                                <input type="text" class="form-control" id="unitPrice" name="unitPrice" value="<?php echo $price ?>"  required>
                            </div>
                </div>

                <div class="col-md-6">
                    <!-- Right column content here -->
                    <div class="product-form">
                        <?php
$sql="SELECT * FROM tbl_category";
$all_cat = $conn->query($sql);


                        ?>
                            <div class="mb-3 pt-4">
                                <label for="category">Select Category:</label>
                                <select id="category" name="category" class="form-control">
                                    <?php while ($row = mysqli_fetch_assoc($all_cat)){ ?>
                                    <option <?php if ($catName == $row['category_name']) echo ' selected'; ?>><?php echo $row['category_name'] ?></option>

                                    <?php } ?>
                                </select>
                                <input type="hidden" name="cat_id" value="<?php echo $catId; ?>">
                            </div>

                            <div class="mb-3">
                            <label for="price"> Stock</label>
                                <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $old_stock ?>" required>
                            </div>
                            <?php 
                             echo '<img  src="data:images/jpeg;base64,'.base64_encode($productImage).'" width = 100px height =100px/>';
                             ?>
                            <!-- <div class="mb-3">
                                <label for="image" class="form-label">Change Image</label>
                                <input class="form-control" type="file" name="image" id="image" accept="image/*">
                            </div> -->

                            <div class="mb-3">
                                <button onclick="validate()" type="submit" class="btn btn-secondary" name="update_product">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
            </div>
           
            </main>
          
        </div>
    </div>
    
<?php
        if(isset($_POST['update_product'])){
            $sellerId=$_SESSION['sellerid'];
                        $pdtname=$_POST['productName'];
                        $price=$_POST['unitPrice'];
                        $stock=$_POST['stock'];
                        $description=$_POST['description'];
                        $cat_id=$_POST['cat_id'];
                       $new_stock=$old_stock+$stock;
                       //echo $new_stock;

                      //  if (isset($_POST["file"])){
                           // $imageData=addslashes(file_get_contents($_FILES['image']['tmp_name']));
                        
                        // elseif(empty($_POST['file'])){
                        //     $imageData=addslashes($productImage);
                        // }
                        
                        $sql="UPDATE `tbl_product` SET`product_name`='$pdtname',`unit_price`='$price',`product_discription`='$productDiscription',
                        `category_id`='$cat_id',`seller_id`='$sellerId',`stock`='$new_stock' WHERE product_id=$productId";

if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Product updated successfully")</script>';
    
} 

        }
        mysqli_close($conn); 
?>
<script>
        function validate(){
            $pname=document.getElementById("productName").value;
            $price=document.getElementById("unitprice").value;
            $stock=document.getElementById("stock").value;
            $category=document.getElementById("category").value;
            

        }

</script>
    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
