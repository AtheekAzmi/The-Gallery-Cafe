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

// Update order details
if (isset($_POST['update_order'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];
    $total_amount = $_POST['total_amount'];

    $update_query = mysqli_query($conn, "UPDATE `orders` SET `name` = '$name', `email` = '$email', `address` = '$address', `payment_method` = '$payment_method', `total_amount` = '$total_amount' WHERE `id` = '$order_id'");

    if ($update_query) {
        echo "<script>alert('Order updated successfully!'); window.location.href = 'manage_orders.php';</script>";
    } else {
        echo "<script>alert('Error updating order!'); window.location.href = 'update_order.php?id=$order_id';</script>";
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
    <title>Update Order</title>
    <link rel="stylesheet" href="update_order.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        margin: 0;
        padding: 0;
    }

    .update-order-container {
        max-width: 500px;
        margin: 40px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
    }

    .form-input {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
    }

    .btn {
        display: inline-block;
        padding: 10px 20px;
        color: #fff;
        background-color: #007bff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }
</style>

<body>

<div class="update-order-container">
    <h1>Update Order</h1>
    <form action="" method="post">
        <label class="form-label">Name:</label>
        <input type="text" class="form-input" name="name" value="<?php echo $order['name']; ?>">

        <label class="form-label">Email:</label>
        <input type="email" class="form-input" name="email" value="<?php echo $order['email']; ?>">

        <label class="form-label">Address:</label>
        <textarea class="form-input" name="address"><?php echo $order['address']; ?></textarea>

        <label class="form-label">Payment Method:</label>
        <input type="text" class="form-input" name="payment_method" value="<?php echo $order['payment_method']; ?>">

        <label class="form-label">Total Amount:</label>
        <input type="number" class="form-input" name="total_amount" value="<?php echo $order['total_amount']; ?>">

        <input type="submit" class="btn" name="update_order" value="Update Order">
    </form>
</div>

</body>
</html>