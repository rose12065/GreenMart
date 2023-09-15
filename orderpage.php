<?php
 include('connection.php');
 $id=$_SESSION['id'];
 $sql = "SELECT * FROM tbl_address WHERE user_id=$id";
 $all_product=$conn->query($sql);

 $s="SELECT * FROM tbl_price WHERE user_id=$id";
 $all_amount = $conn->query($s);
 while ($r = mysqli_fetch_assoc($all_amount))
          {
            $total=$r['total_amount'];
            $shiping_amount=$r['checkout_amount'];
          }
?>
<html>

<!-- Font Awesome -->
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

<section style="background-color: #eee;">
  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <div class="row d-flex justify-content-center pb-5">
          <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
            <div class="py-4 d-flex flex-row">
              <h5><span class="far fa-check-square pe-2"></span><b>Billing & Shipping</b> </h5>
            </div>
            <h4>shipping address</h4>
            <div class="py-0 d-flex justify-content-end">
              <h6><a href="add_address.php">Add Address</a></h6>
            </div>
            
            <hr />
            
            <div class="pt-2">
            <?php
                
                while($row = mysqli_fetch_assoc($all_product)){
                    
                    ?>
              <form class="pb-3" >
                <div class="d-flex flex-row pb-3">
                  <div class="d-flex align-items-center pe-2">
                    <input class="form-check-input shipaddress" type="radio" name="shipaddress" id="shipaddress"
                      value="<?php echo $row['address_id'] ?>" aria-label="..." />
                  </div>
                  <div class="rounded border d-flex w-100 p-3 align-items-center">
                    <p class="mb-0">
                    <?php echo $row['name'] ?> , <?php echo $row['flat'] ?>, <?php echo $row['pincode'] ?>
                    Phone number: <?php echo $row['mobile'] ?>
                    </p>
                    <a href="editaddress.php? address_id=<?php echo $row['address_id'] ?>"><span class="material-symbols-outlined">edit</span></a> <br><br>
                  </div>
                </div>
              </form>
              <?php
                }
              ?>
            </div>
          </div>
         
          <div class="col-md-5 col-xl-4 offset-xl-1">
            <div class="py-4 d-flex justify-content-end">
              <h6><a href="#!">Cancel and return to website</a></h6>
            </div>
            <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
              <div class="p-2 me-3">
                <h4>Order Recap</h4>
              </div>
              <div class="border-top px-2 mx-2"></div>
              <div class="p-2 d-flex pt-3">
                <div class="col-8">items charge</div>
                <div class="ms-auto"><b><span>&#8377;</span><?php echo $total ?></b></div>
              </div>
              <div class="p-2 d-flex">
                <div class="col-8">
                  Shipping charge <span class="fa fa-question-circle text-dark"></span>
                </div>
                <div class="ms-auto"><b>--</b></div>
              </div>
              <div class="border-top px-2 mx-2"></div>
              <div class="p-2 d-flex pt-3">
                <div class="col-8"><b>Total</b></div>
                <div class="ms-auto"><b class="text-success"><span>&#8377;</span><?php echo $shiping_amount ?></b></div>
              </div>
             
              <form action="checkout.php" method="post" id="myForm">
                <input type="hidden" name="amount" id ="amount" value="<?php echo $shiping_amount ?>">
              <button type="submit" class="btn btn-primary btn-block btn-lg">Proceed to payment</button>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script>
        // Add an event listener to the form for the form submission event
        document.getElementById("myForm").addEventListener("submit", function (event) {
            // Get all radio buttons with the "radio-group" class
            var radioButtons = document.getElementsByClassName("shipaddress");
            
            // Initialize a variable to keep track of whether any radio button is selected
            var atLeastOneSelected = false;

            // Loop through radio buttons to check if at least one is selected
            for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                    atLeastOneSelected = true;
                    break; // Exit the loop if one is selected
                }
            }

            // If none are selected, prevent form submission and show an error message
            if (!atLeastOneSelected) {
                event.preventDefault(); // Prevent form submission
                alert("Please select an address."); // Display an error message
            }
        });


    </script>
</body>
</html>
