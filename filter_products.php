<?php
// Establish a database connection (replace with your database credentials)
require("connection.php");

// Retrieve min and max price values from the AJAX request
$minPrice = $_POST['min_price'];
$maxPrice = $_POST['max_price'];

// Prepare and execute a SQL query to fetch products within the specified price range
$query = "SELECT product_name, unit_price FROM tbl_product WHERE unit_price >= $minPrice AND unit_price <= $maxPrice";
$result = mysqli_query($conn, $query);

// Generate HTML for the filtered product list
if (mysqli_num_rows($result) > 0) {
    echo '<ul>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<li>' . $row['product_name'] . ' - $' . $row['unit_price'] . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No products found in the selected price range.</p>';
}

// Close the database connection
mysqli_close($conn);
?>
