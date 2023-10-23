<!-- Bootstrap CSS -->
<?php
require('connection.php');
require('usernav.php');
$id=$_SESSION['id'];
$featch_cart="SELECT tbl_product.*,tbl_cart_items.quantity FROM tbl_cart_items JOIN tbl_product ON tbl_cart_items.product_id = tbl_product.product_id
WHERE tbl_cart_items.user_id = $id";
$all_cart=$conn->query($featch_cart);
while ($row = mysqli_fetch_assoc($all_cart)) {
        $productId=$row['product_id'];
        $productName=$row['product_name'];
        $quanity=$row['quantity'];
        $unitPrice=$row['unit_price'];
// Example usage:
$randomId = generateRandomId(7); 
$total=$quanity*$unitPrice;
$date=date('Y-m-d H:i:s');
$order_query="INSERT INTO tbl_order(order_id,user_id,product_id,quantity,unit_price,total_amount,status,order_date)VALUES ('$randomId','$id','$productId','$quanity','$unitPrice','$total','Not Delivered','$date')";
if ($conn->query($order_query)) {
        $remove_cart="DELETE FROM tbl_cart_items where user_id=$id and product_id=$productId";
            $conn->query($remove_cart);
}

}
function generateRandomId($length = 8) {

    $uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $shuffledLetters = str_shuffle($uppercaseLetters);

    $randomUppercase = substr($shuffledLetters, 0, 3);

    $randomNumbers = '';
    for ($i = 0; $i < $length - 3; $i++) {
        $randomNumbers .= mt_rand(0, 9); // Append a random number (0-9)
    }

    $randomId = $randomUppercase . $randomNumbers;

    return $randomId;
}
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (jQuery and Popper.js are required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Payment Successful!</h4>
        <p>Your order has been successfully processed.</p>
        <hr>
        <!-- <p class="mb-0">Click the button below to download your bill as a PDF.</p> -->
    </div>
    <!-- <button class="btn btn-primary" id="downloadPdfBtn">Download PDF</button> -->
</div>
