<?php
include 'config.php'; // Include your database connection settings

// Start session to store order details
session_start();

// Fetch cart items
$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
$grand_total = 0;
$cart_items = [];

if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $sub_total;
        $cart_items[] = $fetch_cart;
    }
} else {
    echo "<script>alert('Your cart is empty! Redirecting to the menu.'); window.location.href = 'menu2.php';</script>";
    exit;
}

// Process checkout form
if (isset($_POST['place_order'])) {
    $customer_name = mysqli_real_escape_string($conn, $_POST['name']);
    $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
    $customer_address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);

    // Insert order into `orders` table
    $order_query = mysqli_query($conn, "INSERT INTO `orders` (name, email, address, payment_method, total_amount) 
                                        VALUES ('$customer_name', '$customer_email', '$customer_address', '$payment_method', '$grand_total')");

    if ($order_query) {
        // Get the last inserted order id
        $order_id = mysqli_insert_id($conn);

        // Insert each product into the `order_items` table
        foreach ($cart_items as $item) {
            $product_name = $item['name'];
            $product_price = $item['price'];
            $product_quantity = $item['quantity'];
            mysqli_query($conn, "INSERT INTO `order_items` (order_id, product_name, product_price, product_quantity) 
                                VALUES ('$order_id', '$product_name', '$product_price', '$product_quantity')");
        }

        // Clear the cart after placing the order
        mysqli_query($conn, "DELETE FROM `cart`");
        echo "<script>alert('Order placed successfully!'); window.location.href = 'order_success.php?order_id=$order_id';</script>";
        exit;
    } else {
        echo "<script>alert('Failed to place order! Please try again.');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>

<style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.checkout-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    width: 100%;
}

.heading {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.checkout-summary {
    margin-bottom: 20px;
}

.checkout-summary h2 {
    margin-bottom: 10px;
}

.checkout-summary ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.checkout-summary ul li {
    margin-bottom: 5px;
}

.total {
    font-weight: bold;
    margin-top: 10px;
}

.checkout-form {
    display: flex;
    flex-direction: column;
}

.checkout-form input, .checkout-form textarea, .checkout-form select {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.checkout-form button {
    padding: 10px;
    border: none;
    background-color: #28a745;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.checkout-form button:hover {
    background-color: #218838;
}


</style>

<body>

<div class="checkout-container">

    <h1 class="heading">Checkout Page</h1>

    <div class="checkout-summary">
        <h2>Order Summary</h2>
        <ul>
            <?php foreach ($cart_items as $item): ?>
                <li><?php echo htmlspecialchars($item['name']); ?> x <?php echo htmlspecialchars($item['quantity']); ?> - LKR <?php echo number_format($item['price'] * $item['quantity'], 2); ?></li>
            <?php endforeach; ?>
        </ul>
        <p class="total">Total Amount: LKR <?php echo number_format($grand_total, 2); ?>/-</p>
    </div>

    <form action="" method="post" class="checkout-form">
        <h2>Billing Details</h2>
        <input type="text" name="name" placeholder="Enter your name" required>
        <input type="email" name="email" placeholder="Enter your email" required>
        <textarea name="address" placeholder="Enter your address" required></textarea>
        <label for="payment_method">Select Payment Method:</label>
        <select name="payment_method" id="payment_method" required>
            <option value="Credit Card">Credit Card</option>
            <option value="Debit Card">Debit Card</option>
            <option value="Cash on Delivery">Cash on Delivery</option>
        </select>
        <button type="submit" name="place_order" class="btn">Place Order</button>
    </form>

</div>

</body>
</html>
