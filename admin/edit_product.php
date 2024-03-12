<?php
// Enable error display
ini_set('display_errors', 1);
include_once("classes/Crud.php");
$crud = new Crud();
// Initialize variables to avoid undefined variable errors
$product_id = $product_name = $product_category = $product_desc = $product_price = $product_color = $product_special_offer = "";
if(isset($_GET['product_id'])){
    $id = $crud->escape_string($_GET['product_id']);
    $result = $crud->getData("SELECT * FROM products WHERE product_id=$id");



if($result){
    foreach($result as $res){
        $product_id = $res['product_id'];
        $product_name = $res['product_name'];
        $product_category =$res['product_category'];
        $product_desc =$res['product_description'];
        $product_price = $res['product_price'];
        $product_color = $res['product_color'];
        $product_special_offer = $res['product_special_offer'];
    }
}

}
// print_r($res);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-100">

<div class="container mx-auto max-w-md mt-10 p-6 bg-white rounded-md shadow-md">
    <h2 class="text-3xl font-semibold text-center mb-6">Edit Product</h2>
    <form action="editaction.php" method="POST">
    <input type="text" name="product_id" id="product_id" value="<?php echo $product_id ?>" class="w-full px-3 py-2 border rounded-md">
        <div class="mb-4">
            <label for="product_name" class="block mb-2 font-semibold">Product Name</label>
            <input type="text" name="product_name" id="product_name" value="<?php echo $product_name ?>" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="product_category" class="block mb-2 font-semibold">Product Category</label>
            <input type="text" name="product_category" id="product_category" value="<?php echo $product_category ?>" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="product_description" class="block mb-2 font-semibold">Product Description</label>
            <textarea name="product_description" id="product_description" class="w-full px-3 py-2 border rounded-md"><?php echo $product_desc ?></textarea>
        </div>
        <div class="mb-4">
            <label for="product_image" class="block mb-2 font-semibold">Product Image</label>
            <input type="file" name="product_image" id="product_image"  class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="product_price" class="block mb-2 font-semibold">Product Price</label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $product_price ?>" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="product_color" class="block mb-2 font-semibold">Product Color</label>
            <input type="text" name="product_color" id="product_color" value="<?php echo $product_color ?>" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="mb-4">
            <label for="product_special_offer" class="block mb-2 font-semibold">Product Special Offer</label>
            <input type="text" name="product_special_offer" id="product_special_offer" value="<?php echo $product_special_offer;?>" class="w-full px-3 py-2 border rounded-md">
        </div>
        <div class="text-center">
            <input type="submit" name="update" class="w-full bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Product</button>
        </div>
    </form>
</div>

</body>
</html>