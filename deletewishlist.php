<?php
require("connection.php");
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

$id = $_SESSION['id'];
$sql = "DELETE FROM tbl_wishlist WHERE product_id = $productId and user_id= $id";
  if ($conn->query($sql) === TRUE) {
    // Item deleted successfully
    header('Location: wishlist.php'); // Redirect back to the cart page
  } else {
    // Handle the error
    echo "Error deleting item: " . $conn->error;
  }

}
?>