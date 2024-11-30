<?php
include 'config.php'; // Include your database connection settings
session_start();

// Fetch the order ID from the URL parameter
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id == 0) {
    echo "<script>alert('Invalid order! Redirecting to the menu.'); window.location.href = 'menu1.php';</script>";
    exit;
}

// Fetch the order details
$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE `id` = '$order_id'");

if (mysqli_num_rows($order_query) > 0) {
    $order = mysqli_fetch_assoc($order_query);
} else {
    echo "<script>alert('Order not found! Redirecting to the menu.'); window.location.href = 'menu1.php';</script>";
    exit;
}

// Fetch the order items
$order_items_query = mysqli_query($conn, "SELECT * FROM `order_items` WHERE `order_id` = '$order_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Order Success</title>
    <link rel="stylesheet" href="order_success.css">
    <style>
        /* Include the CSS I shared above here */
        /* Reset some default browser styling */
body, h1, p, table, th, td {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    box-sizing: border-box;
}

body {
    background-color: #f0f8ff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: auto;
    margin: 0;
    padding: 0;
}

.success-container {
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    max-width: 800px;
    width: 100%;
    margin: 40px;
}

.success-heading {
    color: #28a745;
    font-size: 2rem;
    margin-bottom: 20px;
}

.order-details {
    margin: 20px 0;
    text-align: left;
}

.order-details p {
    font-size: 1.2rem;
    color: #333;
    margin: 5px 0;
}

.order-details h2 {
    margin-top: 30px;
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color: #007bff;
    color: white;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

table td {
    font-size: 1rem;
    color: #333;
}

.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    color: #fff;
    background-color: #007bff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 1.1rem;
}

.btn:hover {
    background-color: #0056b3;
}

.gif img{
    width: 25%;
}

    </style>
</head>
<body>

<div class="success-container">
    <h1 class="success-heading">Thank You for Your Order!</h1>
    <p>Your order has been placed successfully. Here are your order details:</p>

    <div class="gif">
        <img src="assets/bag.gif" alt="">
    </div>

    <div class="order-details">
        <p><strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?></p>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address']); ?></p>
        <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($order['payment_method']); ?></p>
        <p><strong>Total Amount:</strong> LKR <?php echo number_format($order['total_amount'], 2); ?>/-</p>
        <p><strong>Order Date:</strong> <?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></p>

        <h2>Ordered Products:</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($item = mysqli_fetch_assoc($order_items_query)) {
                    $product_total = $item['product_price'] * $item['product_quantity'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['product_quantity']); ?></td>
                    <td>LKR <?php echo number_format($item['product_price'], 2); ?>/-</td>
                    <td>LKR <?php echo number_format($product_total, 2); ?>/-</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <a href="menu1.php" class="btn">Continue Shopping</a>
</div>

<script>
    /* Include the JS I shared above here */
    document.addEventListener("DOMContentLoaded", function () {
    // Add a simple fade-in effect to the success container
    const successContainer = document.querySelector('.success-container');
    successContainer.style.opacity = '0';
    successContainer.style.transition = 'opacity 1s ease';

    setTimeout(function () {
        successContainer.style.opacity = '1';
    }, 200); // Delay the animation to make it more natural

    // Add an event listener to the continue shopping button for a hover effect
    const continueButton = document.querySelector('.btn');
    continueButton.addEventListener('mouseenter', function () {
        continueButton.style.backgroundColor = '#28a745'; // Green color on hover
    });
    continueButton.addEventListener('mouseleave', function () {
        continueButton.style.backgroundColor = '#007bff'; // Back to original color
    });
});

</script>

</body>
</html>

