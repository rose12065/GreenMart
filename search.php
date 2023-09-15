<?php
// Establish a database connection
require('connection.php');
if (isset($_POST['search'])) {
    
    $searchQuery = $_POST['search'];

    // Construct SQL query to search for products
    $sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$searchQuery%'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any matching products were found
    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Search Results:</h2>";
        echo "<ul>";
        ?>
        <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

                  <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
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
                    <input type="number" id="quantity" name="quantity" class="form-control"value="1" min="1" max="100">
                </div>

                <button type="submit" class="btn btn-default btn-xs pull-right" name="add_to_cart">Add to Cart</button>
            </div>
        </form>
    </div>

            <?php
        }

        ?>

       <?php
    } else {
        echo "No matching products found.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
