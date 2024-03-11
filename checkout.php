
<?php
include('server/connection.php');
session_start();


// if(isset($_POST['place_order'])){
//   echo "PLACE order";
//   if(!isset($_SESSION['logged_in'])){

      
//   }
// }

// Add a section where checks if logged in on clicking on placeorder
?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h2>Checkout</h2>
      <form action="server/placeorder.php" method="POST">
        <div class="mb-3">
          <label for="fullName" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" name="name">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email Address</label>
          <input type="text" class="form-control" id="email" placeholder="Enter your email address" name="email">
        </div>
        <div class="mb-3">
          <label for="text" class="form-label">Phone Number</label>
          <input type="tel" class="form-control" id="phone" placeholder="Enter your phone number" name="phone">
        </div>
  
        <div class="mb-3">
          <label for="phone" class="form-label">City</label>
          <input type="tel" class="form-control" id="phone" placeholder="Enter your city" name="city">
        </div>
        <div class="mb-3">
          <label for="phone" class="form-label">Address</label>
          <input type="tel" class="form-control" id="phone" placeholder="Enter your  address" name="address">
        </div>
        <button type="submit" class="btn btn-primary" name="place_order">Place Order</button>
      </form>
    </div>
  </div>
</div>