<?php

// Enable error reporting and display errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("classes/Crud.php");

$crud = new Crud();



if(isset($_POST['update'])) {
    // Get the product ID from the form
    $id = $_POST['product_id'];

    // Escape user input to prevent SQL injection
    $product_name = $crud->escape_string($_POST['product_name']);
    $product_category = $crud->escape_string($_POST['product_category']);
    $product_desc = $crud->escape_string($_POST['product_description']);
    $product_price = $crud->escape_string($_POST['product_price']);
    $product_color = $crud->escape_string($_POST['product_color']);
    $product_special_offer = $crud->escape_string($_POST['product_special_offer']);

    // Execute the update query
    $result = $crud->execute("UPDATE products SET 
        product_name='$product_name',
        product_category='$product_category',
        product_description='$product_desc',
        product_price='$product_price',
        product_color='$product_color',
        product_special_offer='$product_special_offer'
        WHERE product_id=$id");

    // Redirect to the edit_product.php page
    header("Location: dashboard.php");
    exit; // Ensure that no more code is executed after redirection
}
?>
