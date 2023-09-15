<?php
require("connection.php");
if (isset($_GET['address_id'])) {
    $addressId = $_GET['address_id'];

$id = $_SESSION['id'];
$sql = "DELETE FROM tbl_address WHERE address_id = $addressId and user_id= $id";
  if ($conn->query($sql) === TRUE) {
    // Item deleted successfully
    header('Location: account-settings.php'); // Redirect back to the cart page
  } else {
    // Handle the error
    echo "Error deleting item: " . $conn->error;
  }

}
?>