<?php
    require('connection.php');
    require('usernav.php');
    $id=$_SESSION['id'];
    $query="SELECT o.order_id, p.product_name, o.order_date, o.quantity, o.total_amount,o.status,o.unit_price
    FROM tbl_order o
    INNER JOIN tbl_product p ON o.product_id = p.product_id
    WHERE o.user_id = $id";

    $all_product=$conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Orders History</h2>
        
        <!-- Bootstrap Table to Display Orders -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample Order Data (You would fetch this from your database) -->
<?php
while ($row = mysqli_fetch_assoc($all_product)) {
?>
                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['unit_price']; ?></td>
                    <td><?php echo $row['total_amount']; ?></td>

                    <?php
                        if ($row['status']=='Delivered'){
                            echo'<td><span class="badge badge-success">Delivered</span></td>';
                        }
                        else if($row['status']=='Not Delivered'){
                            echo'<td><span class="badge badge-warning">Not Delivered</span></td>';
                        }

                ?>
                    
                    <td>
                        <a href="cancelOrder.php?order_id=<?php echo $row['order_id'];?>" class="btn btn-primary btn-sm">Cancel</a>
                    </td>
                </tr>

                <?php
}
                ?>
                <!-- Add more rows for each order -->
            </tbody>
        </table>
        
    </div>

    <!-- Add Bootstrap JS scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
