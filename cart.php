<?php

include('connection.php');
include('usernav.php');
$id = $_SESSION['id'];
$sql = "SELECT c.cart_id, c.product_id, c.quantity, p.product_name, p.unit_price, p.product_discription,p.product_image
        FROM tbl_cart_items c
        INNER JOIN tbl_product p ON c.product_id = p.product_id
        WHERE c.user_id = $id";

$all_products = $conn->query($sql);



    // Output the product details
    // echo "Product ID: $productId<br>";
    // echo "Product Name: $productName<br>";
    // echo "Quantity: $quantity<br>";
    // echo "Unit Price: $unitPrice<br>";
    // echo "Product Description: $productDescription<br>";
    // echo "<hr>"; // Add a horizontal line between products for clarity




//header('Location: index.php'); // Redirect back to the product listing page
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
                    <p class="mb-1">Shopping cart</p>
  
                  </div> 
                </div>
                <?php
                $total=0;
                $totalAmount=0;
                $checkoutAmount=0;
                while ($row = mysqli_fetch_assoc($all_products)) {
                  $productId = $row['product_id'];
                  $productName = $row['product_name'];
                  $quantity = $row['quantity'];
                  $unitPrice = $row['unit_price'];
                  $productDescription = $row['product_discription'];
                  $productimage=$row['product_image'];
                  $cartid=$row['cart_id'];
    
                ?>
                <form action="" method="post">
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
                      <div class="d-flex flex-row align-items-center">
                        <div style="width: 70px;">
                        
                          <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <input class ="form-control"type="number" name="quantity" id="quantity" min="1" max="100" value="<?php echo $quantity; ?>">
                    
                          <!-- <h5 class="fw-normal mb-0"><?php echo $quantity; ?></h5> -->
                        </div>
                        <div style="width: 80px;">
                          <h5 class="mb-0"><span>&#8377;</span> <?php echo  $unitPrice; ?></h5>
                        </div>
                        <a href="deletecartproduct.php ? product_id=<?php echo $productId?>" style="color: #cecece;"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
<?php 


$total = $quantity*$unitPrice;
$shipcharge=0.00;
$totalAmount+=$total;
$checkoutAmount=$shipcharge+$totalAmount;
}
 
?>
                
              </div>
              <div class="col-lg-5">
            
                <div class="card bg-light text-black rounded-3">
                  <div class="card-body">
                    <h4> <b>CART TOTALS</b></h4>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2"><span>&#8377;</span><?php echo $totalAmount; ?></p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2"><span>&#8377;</span>--</p>
                    </div>
<hr>
                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2"><span>&#8377;</span><?php echo $checkoutAmount; ?></p>
                    </div>

                    

                    <input type="hidden" name="user_id" value="<?php echo $id; ?>">
                    
                    <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
                    
                    <input type="hidden" name="checkout_amount" value="<?php echo $checkoutAmount; ?>">
                    <button type="submit" class="btn text-black btn-block btn-lg" name='checkout_btn' style="background-color:rgba(4, 143, 4, 0.497);">
                      <div class="d-flex justify-content-between">
                        <span>Proceed To Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>
                    </form>

                    <?php
                   
                    if(isset($_POST['checkout_btn'])){
                      
                      $user_id = $_POST['user_id'];
                      $total_amount = $_POST['total_amount'];
                      $checkout_amount = $_POST['checkout_amount'];
                      $quanityNew=$_POST['quantity'];
                      $sqlupdate="UPDATE `tbl_cart_items` SET `quantity`='$quanityNew' WHERE product_id= $productId";
                      $conn->query( $sqlupdate);
                      $sql = "INSERT INTO tbl_price (user_id, total_amount, checkout_amount) VALUES ('$user_id', '$total_amount', '$checkout_amount')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
        window.location.href = "http://localhost/GreenMart/orderpage.php";
        </script>';
       // header("Location: orderpage.php"); 
        exit;

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
      </div>
    </div>
  </div>
</section>

