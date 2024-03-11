<?php

include('server/connection.php');

if(isset($_POST['order_details_btn']) && isset($_POST['order_id'])) {
    
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");

    if(!$stmt) {
        die('Error preparing statement: ' . $conn->error);
    }
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
  
    $order_details_result = $stmt->get_result();
    
    // Fetch results into an array
    $order_details = [];
    while ($row = $order_details_result->fetch_assoc()) {
        $order_details[] = $row;
    }

    // Calculate total order price
    $order_total_price = calculateTotalOrderPrice($order_details);
}
else{
    header('location:account.php');
}


function calculateTotalOrderPrice($order_details) {
    $total = 0;
    foreach ($order_details as $row) {
        $product_price = $row['product_price'];
        $product_quantity = $row['product_quantity'];
        $total += $product_price * $product_quantity;
    }
    return $total;
}

?>

<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>
<section>
<div id="orders" class="container" style="margin-top: 50px;">
    <h2>Your Orders</h2>
    <div>
        <table class="table mx-auto">
            <thead>
                <tr>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Product Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($order_details)) {
                    foreach ($order_details as $row) {
                ?>
                <tr>
              
                    <td><img src="assets/imgs/<?php echo $row['product_image']?> " width="50px" height="50px"></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>$<?php echo $row['product_price']; ?></td>
                    <td><?php echo $row['product_quantity']; ?></td>
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <?php 
         if($order_status == "not paid"){
        ?>
        <form method="POST" action="payment.php" style="float:right">
            <input type="text" name="total_order_price" value="<?php  echo $order_total_price;?>"/>
            <input type="hidden" name="order_status" value="<?php echo $order_status;?>"/>
            <input type="text" name="order_id" value="<?php echo $order_id; ?>"/>
            <input type="submit" class="btn btn-info" value="Pay Now" name="order_pay_btn"/>
        </form> 
        <?php
        }

        ?>
    </div>
    <hr>

</div>
    </section>
