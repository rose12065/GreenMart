<?php
require('../connection.php');
$sellerId=$_SESSION['sellerid'];
$sql = "SELECT * FROM tbl_product where seller_id=$sellerId";
  $all_product=$conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <!-- Add Bootstrap CSS link here -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        /* Add your custom styles here */
        body {
            background-color: #ffffff;
        }
        .sidebar {
            background-color: #ffffff;
            color: white;
        }
        .navbar {
            background-color: #090909;
        }
        .nav-link {
            color: rgb(13, 12, 12);
        }
        .nav-link:hover {
            color: #484744;
        }
        .active {
            background-color: #eceae6;
        }
        .navbar-brand {
            color: rgba(50, 47, 47, 0.518);
        }
        main {
            background-color: rgb(226, 222, 222);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#"><i class="fas fa-store"></i> Vendor Dashboard</a>
        <!-- Add your profile, add product, and logout buttons here -->
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="sellerdashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="addproduct.php"><i class="fas fa-box"></i> Add Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addedproducts.php"><i class="fas fa-list"></i> List Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php"><i class="fas fa-person"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h1>Added Products</h1>
                <table class="table align-middle mb-0 bg-white">
  <thead class="bg-light">
    <tr>
      <th>Product Name</th>
      <th>Description</th>
      <th>Status</th>
      <th>unit price</th>
      <th>Stock</th>
      <th>Actions</th>
    </tr>
  </thead>
  <?php
while ($row = mysqli_fetch_assoc($all_product)) {
  $productId=$row['product_id'];
  $productName=$row['product_name'];
  $price=$row['unit_price'];
  $productDiscription=$row['product_discription'];
  $productImage=$row['product_image'];
  $stock=$row['stock'];
?>
  <tbody>
    <tr>
      <td>
        <div class="d-flex align-items-center">
        <?php  echo '<img  src="data:images/jpeg;base64,'.base64_encode($row['product_image']).'" alt=""
              style="width: 45px; height: 45px"
              class="rounded-circle"/>';?>
          <div class="ms-3">
            <p class="fw-bold mb-1"><?php echo $productName; ?></p>
          </div>
        </div>
      </td>
      <td>
        <p class="fw-normal mb-1"><?php echo $productDiscription; ?></p>
      </td>
      <td>
    <?php
    if ($stock <= 0) {
        echo '<span class="badge badge-danger rounded-pill d-inline">Out of Stock</span>';
    } elseif ($stock <= 10) {
        echo '<span class="badge badge-warning rounded-pill d-inline">Low Stock</span>';
    } elseif ($stock >= 50) {
        echo '<span class="badge badge-success rounded-pill d-inline">High Stock</span>';
    } else {
        echo '<span class="badge badge-info rounded-pill d-inline">Medium Stock</span>';
    }
    ?>
</td>
      <td><?php echo $price; ?></td>
      <td>
        <button type="button" class="btn btn-link btn-sm btn-rounded">
        <?php echo $stock; ?>
        </button>
      </td>
      <form action="" method="post">

      <td>
        <a href="edit-added-product.php ? product_id=<?php echo $productId ?>">
        <button type="button" class="btn btn-sm btn-rounded" name="edit">
          Edit 
        </button>
        </a>
        
      </td>
      </form>
    </tr>

    <?php
}
?>  
  </tbody>
</table>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Added Products
    </title>
    <!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
  rel="stylesheet"
/>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
></script>
</head>
<body>

</body>
</html>