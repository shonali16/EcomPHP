<?php
include('server/connection.php');

session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
   $order_total = $_POST['total_order_price'];
 $order_id = $_POST['order_id'];
}
echo $_POST['order_id'];
include('layouts/header.php');
include('layouts/navbar.php');

?>
<section class="my-5 py-5">
    <div class="container text-center">
        <h2 class="font-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>  
    <div class=" container card mx-auto" >
    <form action="payment.php" method="post" id="payment-form">
         <?php
        //  CART IS NOT empty
        if(isset($_SESSION['total'])  && $_SESSION['total'] != 0){?>
        <?php $amount = $_SESSION['total'];?>
            <p class="text-center fw-bold">Total Payment : $ <?php echo (isset($_SESSION['total'])) ? $_SESSION['total']: '';?></p>
         <!-- <input type="submit" class="btn btn-primary" value="Pay now"/> -->
         <div id="paypal-button-container" class="paypal-button-container"></div>
         <?php }
         
        //  user wants to pay for an order that may need earlier
        else if(isset($_GET['order_status']) &&  $_GET['order_status'] == "not paid"){ 
             $amount = strval($_POST['order_total_price']);
            //  echo"come from orders".$amount;
            ?>

            <p>Total Payment : $ <?php echo $_POST['order_total_price']; ?></p>
            <div id="paypal-button-container" class="paypal-button-container"></div>
            <!-- <input type="submit" class="btn btn-primary" value="Pay now"/> -->

        <?php
         }else{
            ?>
            <p>You dont have any order</p>
          
         <?php }
         ?>
         
    </form>

    <hr>
    <!-- <div id="paypal-button-container" class="paypal-button-container"></div> -->
   
    </div>
</section>
<script src="https://www.paypal.com/sdk/js?client-id=AS9b0SFtDZ--N4LDfpLV-nrEYsveSjWDFMQceti_rzOBRzDX50ICGGLiUqT7VmXmQEmhzyYhwuaNY5Up&currency=CAD"></script>

<script>

// Render the button component
paypal
  .Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units:[
                {
                    amount:{
                        value : '<?php echo $amount; ?>',
                    }
                }
            ]
        })
    },  
    // Finalize the transaction after payer approval
    onApprove: function (data,actions) {
      return actions.order.capture().then(function(orderData){
            console.log('Capture result', orderData, JSON.stringify(orderData , null, 2));
            var transaction = orderData.purchase_units[0].payments.captures[0];
            alert('Tranasactionon', +transaction.status + ':'+ transaction.id + '\n\n See console for all availabilty');
            window.location.href="server/complete_payment.php?transaction_id="+transaction.id+"&order_id="+"<?php echo $order_id?>";
      });
    }
  })
  .render("#paypal-button-container");




    
</script>

<?php
include('layouts/footer.php');

