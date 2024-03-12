<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include('../server/connection.php');

// get all proiducts

$stmt2 = $conn->prepare("SELECT * FROM products");
$stmt2->execute();
$products = $stmt2->get_result();
// print_r($products);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-blue-100">

<!-- Sidebar -->
<div class="bg-blue-200 h-screen w-48 fixed top-0 left-0 pt-10">

    <a href="#" class="block px-4 py-2 hover:bg-blue-300">Products</a>
    <!-- <a href="#" class="block px-4 py-2 hover:bg-blue-300">Orders</a>
    <a href="#" class="block px-4 py-2 hover:bg-blue-300">Account</a> -->
    <a href="add_product.php" class="block px-4 py-2 hover:bg-blue-300">Add New Product</a>
    <a href="dashboard.php" class="block px-4 py-2 hover:bg-blue-300">Dashboard</a>
    <!-- <a href="#" class="block px-4 py-2 hover:bg-blue-300">Help</a> -->
</div>

<!-- Page content -->
<div class="ml-48 p-6">
    <h2 class="text-4xl font-semibold text-center">Welcome to the Dashboard</h2>
   
    
    <!-- Product Table -->
    <h3 class="mt-8 mb-4 text-lg font-semibold">Product Information</h3>
    <table class="table-auto w-full">

        <thead>
            <tr class="bg-gray-200">
                <th class="px-4 py-2">Product ID</th>
                <th class="px-4 py-2">Product Name</th>
                <th class="px-4 py-2">Category</th>
                <th class="px-4 py-2">Description</th>
                <th class="px-4 py-2">Price</th>
                <th class="px-4 py-2">Image</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product){?>
            <tr>
                <td class="border px-4 py-2"><?php echo  $product['product_id'] ?></td>
                <td class="border px-4 py-2"><?php echo  $product['product_name'] ?></td>
                <td class="border px-4 py-2"><?php echo  $product['product_category'] ?></td>
                <td class="border px-4 py-2"><?php echo  $product['product_description'] ?></td>
                <td class="border px-4 py-2"><?php echo  "$ ".$product['product_price'] ?></td>
                <td class="border px-4 py-2"><img src="../assets/imgs/<?php echo $product['product_image'] ?>" class="w-10 h-auto"/></td>
                <td class="border px-4 py-2">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded"><a href="edit_product.php?product_id=<?php echo $product['product_id'];?>">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M11.293 5.293a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-9 9a1 1 0 01-.32.221l-4 1a1 1 0 01-1.215-1.215l1-4a1 1 0 01.221-.32l9-9zM12 6l-2 2-8 8 3-1 7-7 2-2v-2h-2z" clip-rule="evenodd" />
                        </svg>
                        </a>
                    </button>
                    <button onclick="confirmDelete(<?php echo $product['product_id']; ?>)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zM4 6a1 1 0 011-1h10a1 1 0 011 1v10a1 1 0 01-1 1H5a1 1 0 01-1-1V6zm6 3a1 1 0 011 1v1a1 1 0 01-2 0V9a1 1 0 011-1zm-1 5a1 1 0 112 0 1 1 0 01-2 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </td>
            </tr>
            <?php }?>
        
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(productId) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = "delete_product.php?product_id=" + productId;
        }
    }
</script>

</body>
</html>
