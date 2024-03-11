<?php

session_start();
if(isset($_POST['add_to_cart'])){

    // if user has already added a product to cart
  if(isset($_SESSION['cart'])){

        //if this is the first product
        $products_array_ids =  array_column($_SESSION['cart'], "product_id");

        // if product has already been add to cart  or  not
        if(!in_array($_POST['product_id'], $products_array_ids)){
          $product_id = $_POST['product_id'];
            // Product has already been added to cart
            $product_array  = array(
                'product_id'  => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_quantity' => $_POST['product_quantity'],
                'product_image' => $_POST['product_image']
            );
            $_SESSION['cart'][$product_id] = $product_array;
        }  
         else{
            echo '<script>alert("Product was  already to cart   ");</script>';
            // echo '<script>window.location="index.php"</script>';
        }
       
    }
    else{
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = $_POST['product_image'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array(
            'product_id'  => $product_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_quantity' => $product_quantity,
           'product_image' => $product_image
        );
        $_SESSION['cart'][$product_id] =$product_array;
    }
    calculateTotalCart();
  }
 

  // remove product from cart
  else if(isset($_POST['remove_product']))
  {

      $product_id = $_POST['product_id'];
      unset($_SESSION['cart'][$product_id]); // Remove the product with the specified product_id
      calculateTotalCart();
      // header('Location: cart.php'); // Redirect back to the cart page after removing the product
      // exit(); // Exit to prevent further execution

  }
  else if( isset($_POST['edit_quantity'])){
      // WE get id and quantity from the form
      $product_id= $_POST['product_id'];
      $product_quantity = $_POST['product_quantity'];
      // get the product array from teh session
      $product_array = $_SESSION['cart'][$product_id];
      // update product qunatity
      $product_array['product_quantity'] = $product_quantity; 
      // return array back its place
      $_SESSION['cart'][$product_id] = $product_array;
      calculateTotalCart();
  }
  
else{
    // header('location: index.php');
}

function calculateTotalCart(){
  $total = 0;
  foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'][$key];

    $price = $product['product_price'];
    $quantity = $product['product_quantity'];
    $total = $total +   ($price * $quantity);
    
  }
 echo  $_SESSION['total'] = $total;  
}
?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>
<div class="container">
  <h1 class="mt-5 mb-4">Your Shopping Cart</h1>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Product Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Total</th>
        <th scope="col">Edit</th>
      </tr>
    </thead>
    <tbody>
     
      <tr>
      <?php 
      foreach($_SESSION['cart'] as $key => $value ){
        print_r($value);
        ?>
        <th scope="row">1</th>
        <td>
          <img src="assets/imgs/<?php echo $value['product_image'];?>" class="product-image">
      
        </td>
        <td><?php echo $value['product_name']?>

      </td>
        <td><?php echo $value['product_price']?></td>
        <td>
          <form action ="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
            <input type="number" value="<?php echo $value['product_quantity'];?>" class="form-control" style="width: 70px;" name="product_quantity"/>
            <input type="submit" class="btn btn-info"  name="edit_quantity" value="edit"/>
          </form>
        </td>
        <td><?php echo $value['product_quantity']  * $value['product_price']; ?></td>
        <td>
          <form action ="cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
            <input type="submit" class="btn btn-danger" name="remove_product" value="remove"/>
          </form>
         
        </td>
      </tr>
  <?php  }?>
    </tbody>
  </table>

  <div class="row justify-content-end">
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <!-- <h5 class="card-title"></h5>
          <p class="card-text">$49.98</p> -->
          <hr>
          <h5 class="card-title">Total</h5>
          <p class="card-text">$ <?php  echo $_SESSION['total']?></p>
          <form action="checkout.php" method="POST">
            <input type="submit" class="btn btn-primary btn-block" value="Checkout" name="checkout" /> 
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>