<?php
// Establish a database connection (replace with your database credentials)
require("connection.php");

// Retrieve min and max price values from the AJAX request
$minPrice = $_POST['min_price'];
$maxPrice = $_POST['max_price'];
$cat_id=$_POST['category_id'];

// Prepare and execute a SQL query to fetch products within the specified price range
$query = "SELECT product_id, product_name,stock,product_image,product_discription, unit_price FROM tbl_product WHERE unit_price >= $minPrice AND unit_price <= $maxPrice AND category_id=$cat_id";
$result = mysqli_query($conn, $query);

// Generate HTML for the filtered product list
if (mysqli_num_rows($result) > 0) {
   
   ?>
<div class="col-md-12">
              
              <div class="bootstrap-tabs product-tabs">
                <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                  <h3>Your Choice</h3>
                  
                </div>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
  
                    <div class="product-grid row row-cols-1 row-cols-sm-2 ">
                    <?php
                          while ($row = mysqli_fetch_assoc($result)) {
                            $stock=$row['stock'];
                          ?>
      <div class="col">
          <form class="product-item" method="post">
          <button type="submit" class="btn-wishlist" name="wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></button>
              <figure>
                  <a href="productdetails.php?product_id=<?php echo $row['product_id'] ?>" title="Product Title">
                  <?php  echo '<img  src="data:images/jpeg;base64,'.base64_encode($row['product_image']).'" class="tab-image" />';?>
                       
                  </a>
                  <?php if ($stock <= 0) {
          echo '<div class="alert alert-danger" role="alert">
          OUT OF STOCK
        </div>';
      } ?>
              </figure>
              
              <h3><?php echo $row['product_name'] ?></h3>
              <h6><?php echo $row['product_discription'] ?></h6>
              <span class="price"><?php echo "Rs." . $row['unit_price'] ?></span>
  
              <!-- Hidden input fields for product_id and quantity -->
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
              
              <div class="d-flex align-items-center justify-content-between">
                  <div class="input-group product-qty col-md-2 border border-secondary border-3">
                      <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="100" value="1">
                  </div>
  
                  <?php 
                          if ($stock > 0) {
                            echo '<button type="submit" class="btn btn-default btn-xs pull-right" name="add_to_cart">Add to Cart</button>';
                        }  
                    ?></div>
          </form>
      </div>
  <?php
  }
  ?>
                        </div>
                      </div>
  
  
      </div>
  </div>
  <hr>

        
   <?php }
   
else {
    echo '<p>No products found in the selected price range.</p>';
}

// Close the database connection
mysqli_close($conn);
?>
