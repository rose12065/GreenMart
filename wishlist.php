<?php

include('connection.php');
include('usernav.php');
$id = $_SESSION['id'];
$sql = "SELECT c.wishlist_id, c.product_id , p.stock , p.product_name, p.unit_price, p.product_discription,p.product_image
        FROM tbl_wishlist c
        INNER JOIN tbl_product p ON c.product_id = p.product_id
        WHERE c.user_id = $id";

$all_products = $conn->query($sql);


?>

</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<section class="h-100 h-custom" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4">
          
            <div class="row">

              <div class="col-lg-7">
                <h5 class="mb-3"><a href="dashboard.php" class="text-body"><i
                      class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                <hr>

                <div class="d-flex justify-content-between align-items-center mb-4">
                  <div>
                    <p class="mb-1">Wishlist Products</p>
  
                  </div> 
                </div>
                <?php
                while ($row = mysqli_fetch_assoc($all_products)) {
                  $productId = $row['product_id'];
                  $productName = $row['product_name'];
                  $unitPrice = $row['unit_price'];
                  $productDescription = $row['product_discription'];
                  $productimage=$row['product_image'];
                  $stock=$row['stock'];
                ?>
                  
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex flex-row align-items-center">
                        <div>
                        <?php  echo '<img  src="data:images/jpeg;base64,'.base64_encode($row['product_image']).'" class="img-fluid rounded-3" style="width: 65px;/>';?>
                         </div>
                        <div class="ms-3">
                          <h5><?php echo $productName; ?></h5>
                          <p class="small mb-0"><?php echo $productDescription; ?></p>
                        </div>
                      </div>
                      <form action="" method="post">
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 60px;">
                      <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                          <div class="input-group product-qty col-md-2 border border-secondary border-3">
                              <input type="number" id="quantity" name="quantity" class="form-control"value="1" min="1" max="100">
                          </div>
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0">&nbsp;&nbsp;<span>&#8377;</span> <?php echo  $unitPrice; ?></h5>
                        </div>
                        <a href="deletewishlist.php ? product_id=<?php echo $productId?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php 
                        if ($stock > 0) {
                          echo '<button type="submit" name="add_to_cart"><h5 class="btn fw-normal mb-0" " style="color: #cecece;"> <i class="fas fa-shopping-cart"></i></h5></button>';
                      }  
                  ?>
                          </form> 
                      </div>
                    </div>
                  </div>
                </div>
                        <?php 
                        }
                        if (isset($_POST['add_to_cart'])) {
                          // Get the product_id and quantity from the form submission
                          $userId=$_SESSION['id'];
                          $productId=$_POST['product_id'];
                          $quantity = $_POST['quantity'];
                      
                          // You should perform further validation and sanitation of these values here.
                      
                          // Assuming you have a database connection established
                      
                            $sql = "INSERT INTO tbl_cart_items (product_id,user_id,quantity) VALUES (' $productId', '$userId','$quantity')";
                                  if ($conn->query($sql) === TRUE) {
                                    '<script>
                                    alert("Product details inserted successfully.");
                                  </script>';
                                
                                  
                             } else {
                               echo "Error: " . $conn->error;
                             }
                              
                          // Close the database connection
                          mysqli_close($conn);
                            }
                        ?>
                
             

                   
                
                

             

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

