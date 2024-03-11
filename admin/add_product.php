<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add  Product</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-red-100">

<div class="container mx-auto max-w-md mt-10 p-6 bg-white rounded-md shadow-md">
    <h2 class="text-3xl font-semibold text-center mb-6">Add a  Product</h2>
    <form action="addaction.php" method="POST" enctype="multipart/form-data">
   
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
            <input type="file" name="image" id="product_image"  class="w-full px-3 py-2 border rounded-md">
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
            <input type="submit" name="add" class="w-full bg-pink-500 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded" value="Add the Product">
        </div>
    </form>
</div>

</body>
</html>
