<?php
include('connection.php');
$id = $_SESSION['id'];
$sql= "SELECT * From tbl_user_register where user_id=$id";
$all_product=$conn->query($sql);
while ($row = mysqli_fetch_assoc($all_product)) {

$username=$row['user_name'];

}
$s="SELECT * FROM tbl_price WHERE user_id=$id";
 $all_amount = $conn->query($s);
 while ($r = mysqli_fetch_assoc($all_amount))
          {
            $total=$r['total_amount'];
            $shiping_amount=$r['checkout_amount'];
          }
?>

<html>
    <head>
    <link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
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
    <style>
        /* Style the container div that holds the Razorpay button */
        .razorpay-container {
            text-align: center;
            margin: 20px;
        }

        /* Style the Razorpay button */
        .razorpay-payment-button {
            background-color: rgba(4, 143, 4, 0.497);
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        /* Style the button on hover */
        .razorpay-payment-button:hover {
            background-color: rgba(4, 143, 4, 0.497);
        }
    </style>

    </head>
    <section style="background-color: #eee;">
  <div class="container py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-4">
        <div class="card rounded-3">
          <div class="card-body mx-1 my-2">
            <div class="d-flex align-items-center">
              
              <div>
                <p class="d-flex flex-column mb-0">
                  <b><?php echo $username; ?></b>
                </p>
              </div>
            </div>

            <div class="pt-3">
              

              <div class="d-flex flex-row pb-3">
                <div class="rounded border d-flex w-100 px-3 py-2 align-items-center">
                <div class="col-8">Order Total</div>
                <div class="ms-auto"><b><span>&#8377;</span><?php echo $total ?></b></div>
                  
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pb-1">
              <a href="orderpage.php" class="text-muted">Go back</a>
              <?php


require 'congfig.php';
require 'vendor/autoload.php';

use Razorpay\Api\Api;

if(!empty($_POST['amount'])){
    $amount=$_POST['amount'];
    $api= new Api(API_KEY,API_SECRET);

    $res=$api->order->create(
        array(
            'receipt' => '123',
            'amount' => $amount. '00', // Amount in paise (e.g., 1000 paise = 10 INR)
            'currency' => 'INR',
            'notes'=>array('key1'=>'value3','key2'=>'value2')
         )

    );

    if(!empty($res['id'])){
        $_SESSION['order_id']=$res['id'];
        ?>
        <div class="razorpay-container">
        <form action="<?php echo BASE_URL ?> success.php" method="post">
            <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo API_KEY ?>"
            data-amount="<?php echo $amount; ?>"
            data-currency="INR"
            data-order_id="<?php echo $res['id']; ?>"
            data-buttontext="Pay Now"
            data-name="<?php echo COMPANY_NAME;?>"
            data-description="Company Description"
            data-prefill.name="<?php echo $name; ?>"
            data-pref111.email="<?php echo $email;?>"
            data-theme.color="rgba(4, 143, 4, 0.497)"
            >

            </script>
            <input type="hidden" name="hidden" custom="Hidden Element"/>
        </form>
        </div>
  <?php      
    }
}
?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</html>
