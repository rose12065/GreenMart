<?php
    include('connection.php');
    include('usernav.php');
    if(isset($_GET['product_id'])){
        $userId=$_SESSION['id'];
        $productId=$_GET['product_id'];
        $sql = "SELECT * FROM tbl_product where product_id=$productId";
        $all_product=$conn->query($sql);

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .product {
            display: flex;
            align-items: center;
        }
        .product-image {
            flex: 1;
            padding: 20px;
        }
        .product-image img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .product-details {
            flex: 1;
            padding: 20px;
        }
        .product-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-price {
            font-size: 20px;
            color: #FF5733;
            margin-bottom: 10px;
        }
        .product-description {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .quantity-input {
            width: 100px;
            padding: 5px;
            text-align: center;
            border-radius: 5px;
        }
        .add-to-cart {
            background-color: rgba(4, 143, 4, 0.497);
            color: #fff;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 10px;
        }
        .add-to-wishlist{
            background-color: rgba(4, 143, 4, 0.497);
            color: #fff;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
            font-size: 18px;
            border-radius: 10px;
        }
        .reviews {
            margin-top: 40px;
            
        }
        .review h6{
            color: grey;
        }
        .review p{
            color: black;
        }
        .review-form {
            margin-top: 20px;
        }
        .review-form textarea {
            width: 100%;
            height: 100px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .review-submit {
            background-color: rgba(4, 143, 4, 0.497);
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .review {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php
while ($row = mysqli_fetch_assoc($all_product)) {
?>
    <div class="container">
    <form action="" method="post">   
        <div class="product">
    
 
            <div class="product-image">
            <?php  echo '<img  src="data:images/jpeg;base64,'.base64_encode($row['product_image']).'"/>';?>
            </div>
        
            <div class="product-details">
                <h1 class="product-title"><?php echo $row['product_name'] ?></h1>
                <p class="product-price"><span>&#8377;</span><?php echo $row['unit_price'] ?></p>
                <p class="product-description">
                <?php echo $row['product_discription'] ?>
                </p>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                <?php 
                        if ($row['stock'] > 0) {
                          echo '<button type="submit" class="add-to-cart" name="add_to_cart">Add to Cart</button>';
                      }  
                  ?>
                  <button type="submit" class="add-to-wishlist" name="add_to_wishlist">Add to wishlist</button>
                
                
            </div>
           
           
        </div>
        </form>
            <?php
                }


                ?>
                
        <div class="reviews">
        <form action="" method="post">
            <div class="review-form">
                <h3>Add Your Review</h3>
                <input type="hidden" name="product_id" value="<?php echo $row['product_id'] ?>">
                <textarea placeholder="Write your review here" name="review_content" required></textarea>
                <button type="submit" class="review-submit" name="submit_review">Submit Review</button>
            </div>
            </form>
            

            <?php
if(isset($_POST['add_to_wishlist'])){
    $userId=$_SESSION['id'];
    $product_id = $_POST['product_id'];
   
  
    $sql = "INSERT INTO tbl_wishlist (user_id,product_id) VALUES ('$userId','$product_id')";
              if ($conn->query($sql) === TRUE) {
                echo '<script>
                alert("Product added to wishlist.");
              </script>';
            
              
         } else {
           echo "Error: " . $conn->error;
         }
          
}




if (isset($_POST['submit_review'])){
    $product_id = $_POST['product_id'];
    $reviewcontent=$_POST['review_content'];
    $date=date('Y-m-d H:i:s');

    $sql="INSERT INTO `tbl_review`( `user_id`, `product_id`, `review_content`, `review_date`) VALUES ('$userId','$productId','$reviewcontent','$date')";
    if ($conn->query($sql) === TRUE) {
        '<script>
        alert("Product details inserted successfully.");
      </script>';
    
      
 } else {
   echo "Error: " . $conn->error;
 }
  
// Close the database connection

}
       $s = "SELECT r.*, u.user_name
                FROM tbl_review r
                INNER JOIN tbl_user_register u ON r.user_id = u.user_id
                WHERE r.user_id = $userId AND r.product_id = $productId
                ORDER BY r.review_date DESC";
                 
                $all_review=$conn->query($s); 
                ?>
            
            <h2>Customer Reviews</h2>
            <?php
            while ($row = mysqli_fetch_assoc($all_review)) {
            ?>
            <div class="review">
                <h6><br><span class="material-symbols-outlined">person</span><?php echo $row['user_name'];?> | <?php echo $row['review_date'];?></br></h6>
                <p><?php echo $row['review_content'];?> </p>
                
            </div>
            <?php   } ?>
        </div>
    </div>
</body>
<?php
// Check if the form is submitted




if (isset($_POST['add_to_cart'])) {
    '<script>
              alert("Product details inserted successfully.");
            </script>';
    // Get the product_id and quantity from the form submission
    $userId=$_SESSION['id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // You should perform further validation and sanitation of these values here.

    // Assuming you have a database connection established
      echo $product_id;
      echo $quantity;

      $sql = "INSERT INTO tbl_cart_items (product_id,user_id,quantity) VALUES ('$product_id', '$userId','$quantity')";
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
</html>
