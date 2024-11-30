<?php
include 'config.php'; // Include your database connection settings
session_start();

// Check if the user is an admin
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header('Location: login.php'); // Redirect to login page if not an admin
//     exit;
// }

// Get the order ID from the URL
$order_id = $_GET['id'];

// Fetch the order details
$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE `id` = '$order_id'");
if (mysqli_num_rows($order_query) > 0) {
    $order = mysqli_fetch_assoc($order_query);
} else {
    echo "<script>alert('Order not found!'); window.location.href = 'order_management.php';</script>";
    exit;
}

// Fetch the order items
$order_items_query = mysqli_query($conn, "SELECT * FROM `order_items` WHERE `order_id` = '$order_id'");
$order_items = array();
while ($order_item = mysqli_fetch_assoc($order_items_query)) {
    $order_items[] = $order_item;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Order Details</title>
    <link rel="stylesheet" href="order_details.css">
</head>

<style>

    :root{
        --color1: #cf7147;
        --color2: #bca898;
        --color3: #edd9bf;
        --color4: #f6d496;
        --color5: #f3e0bf;
        --color6: #f0e8d7;
        --color7: #e9ddc7;
        --color8: #f7ef77;
        --color9: #c5a72d;
        --color10: #ffe942;
        --color11: #f6b066;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        margin: 0;
        padding: 0;
    }

    .order-details-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .order-details-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .order-details-table th, .order-details-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .order-details-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .order-items-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .order-items-table th, .order-items-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .order-items-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .order-items-table td {
        vertical-align: middle;
    }

    button{
        background-color: transparent;
        margin-top: 20px;
        border: none;
        font-weight: 600;
    }

    button i{
        font-size: 35px;
        font-weight: 800;
    }

    button:hover{
        cursor: pointer;
        color: #cf7147;
    }

</style>

<body>

<div class="order-details-container">
    <h1>Order Details</h1>

    <!-- Order Details Table -->
    <table class="order-details-table">
        <tr>
            <th>Order ID</th>
            <td><?php echo $order['id']; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $order['name']; ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo $order['email']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $order['address']; ?></td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td><?php echo $order['payment_method']; ?></td>
        </tr>
        <tr>
            <th>Total Amount</th>
            <td>LKR <?php echo number_format($order['total_amount'], 2); ?>/-</td>
        </tr>
    </table>

    <!-- Order Items Table -->
    <h2>Order Items</h2>
    <table class="order-items-table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($order_items as $order_item) { ?>
            <tr>
                <td><?php echo $order_item['product_name']; ?></td>
                <td><?php echo $order_item['product_quantity']; ?></td>
                <td>LKR <?php echo number_format($order_item['product_price'], 2); ?>/-</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <button onclick="location.href='manage_orders.php'"><i class='bx bxs-chevrons-left'></i></button>
    
    <!-- <i class="fi fi-sr-arrow-small-left"></i> -->
</div>



</body>
</html>
