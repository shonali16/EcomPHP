<?php
include('server/connection.php');

session_start();

if(isset($_POST['order_pay_btn'])){
    $order_status = $_POST['order_status'];
    $order_total = $_POST['total_order_price'];
}

include('layouts/header.php');
include('layouts/navbar.php');

?>
<section class="my-5 py-5">
    <div class="container text-center">
        <h2 class="font-weight-bold">Payment</h2>
        <hr class="mx-auto">
    </div>  
    <div class="container card mx-auto" >
        <form action="payment.php" method="post" id="payment-form">
            <?php if(isset($_SESSION['total']) && $_SESSION['total'] != 0): ?>
                <p>Total Payment: $ <?php echo isset($_SESSION['total']) ? $_SESSION['total'] : ''; ?></p>
            <?php elseif(isset($_GET['order_status']) && $_GET['order_status'] == "not paid"): ?>
                <p>Total Payment: $ <?php echo $_POST['order_total_price']; ?></p>
            <?php else: ?>
                <p>You don't have any order</p>
            <?php endif; ?>
        </form>
        <hr>
        <div id="paypal-button-container" class="paypal-button-container"></div>
    </div>
</section>
<script src="https://www.paypal.com/sdk/js?client-id=AS9b0SFtDZ--N4LDfpLV-nrEYsveSjWDFMQceti_rzOBRzDX50ICGGLiUqT7VmXmQEmhzyYhwuaNY5Up&components=buttons"></script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $order_total; ?>' // The total amount to be paid
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Redirect to success page or show a success message
                console.log(details);
                window.location.href = "success.php";
            });
        }
    }).render('#paypal-button-container');
</script>

<?php
include('layouts/footer.php');
?>
