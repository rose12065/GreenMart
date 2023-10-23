<?php
   require("../connection.php");
   if (isset($_GET['category_id'])) {
       $categoryId = $_GET['category_id'];
       $sql="DELETE FROM `tbl_category` WHERE category_id=$categoryId";
       if ($conn->query($sql) === TRUE) {
        echo'<script>window.location.href="viewCategory.php";</script>';
       }
   }   
?>
