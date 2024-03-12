<?php
include('../server/connection.php');
if(isset($_GET['product_id']))
{
    $productId = $_GET['product_id']; // Correct variable name
    
    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();

    header('location: dashboard.php');
}
?>
