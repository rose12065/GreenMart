<?php
   require("../connection.php");
   if (isset($_GET['product_id'])) {
       $productId = $_GET['product_id'];
       $sql="DELETE FROM `tbl_product` WHERE product_id=$productId";
       if ($conn->query($sql) === TRUE) {
        echo'<script>window.location.href="viewProducts.php";</script>';
       }
   }   
?>