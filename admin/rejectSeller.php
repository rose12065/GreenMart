<?php
   require("../connection.php");
   if (isset($_GET['seller_id'])) {
       $sellerId = $_GET['seller_id'];
       $sql="UPDATE tbl_seller_register SET status = 2 WHERE seller_id=$sellerId";
       echo $sql;
       if ($conn->query($sql) === TRUE) {
        echo'<script>window.location.href="sellerDetails.php";</script>';
       }
      
   }   
?>
