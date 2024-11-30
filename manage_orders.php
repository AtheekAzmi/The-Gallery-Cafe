

<!-- ============================================ -->


<?php
include 'config.php';
session_start();

// Fetch all orders
$orders_query = mysqli_query($conn, "SELECT * FROM `orders` ORDER BY `id` DESC");

// Handle confirm action
if (isset($_GET['confirm_id'])) {
    $confirm_id = $_GET['confirm_id'];
    mysqli_query($conn, "UPDATE `orders` SET `status` = 'confirmed' WHERE `id` = $confirm_id");
    header("Location: manage_orders.php");
}

// Handle cancel action
if (isset($_GET['cancel_id'])) {
    $cancel_id = $_GET['cancel_id'];
    mysqli_query($conn, "UPDATE `orders` SET `status` = 'canceled' WHERE `id` = $cancel_id");
    header("Location: manage_orders.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Manage Orders</title>
    <link rel="stylesheet" href="manage.css">
</head>

<style>
    .content {
    padding: 20px;
    flex: 1;
}

.content h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th, table td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
    font-size: 14px;
}

table th {
    background-color: #FFBB3A;
    color: white;
}

table tbody tr:hover {
    background-color: #f9f9f9;
}

table a {
    color: #007bff;
    text-decoration: none;
}

table a:hover {
    text-decoration: underline;
}

/* ------------ */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f7;
    display: flex;
    height: 100vh;
}

.admin-container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #333333b5;
    padding: 20px;
    color: white;
}

.sidebar-header {
    margin-bottom: 30px;
}

.sidebar h2 {
    color: #fcbe7c;
    font-size: 24px;
    text-align: center;
}

.nav-links {
    list-style: none;
    padding-left: 0;
}

.nav-links li {
    margin: 15px 0;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 10px;
    display: block;
    transition: background-color 0.3s ease;
}

.nav-links a:hover {
    background-color: #fcbe7c;
    color: #333;
}

.logout {
    margin-top: 50px;
}

.logout a {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    background-color: #ff6f00;
    display: inline-block;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.logout a:hover {
    background-color: #e65c00;
}

.content {
    padding: 20px;
    flex: 1;
}

.content h1 {
    font-size: 28px;
    color: #333;
}

.content p {
    font-size: 18px;
    color: #555;
    margin-top: 20px;
}

i{
    font-size: 15px;
}


</style>

<body>
<div class="admin-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="nav-links">
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_bookings.php">Manage Bookings</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_reservations.php">Manage Reservations</a></li>
            <li><a href="admin.php">Manage Menu</a></li>
            <li><a href="manage_events.php">Manage Events</a></li>

            <li><a href="index.php">Home</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </aside>

    <main class="content">
        <h1>Manage Orders</h1>

        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Email</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($orders_query)) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['name']); ?></td>
                        <td><?php echo htmlspecialchars($order['email']); ?></td>
                        <td>LKR <?php echo number_format($order['total_amount'], 2); ?>/-</td>
                        <td><?php echo htmlspecialchars($order['payment_method']); ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($order['order_date'])); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>
                            <a href="order_detail.php?id=<?php echo $order['id']; ?>" class="btn"><i class='bx bxs-show'></i></a> |
                            <a href="update_order.php?id=<?php echo $order['id']; ?>" class="btn"><i class='bx bxs-edit-alt'></i></a> |
                            <a href="manage_orders.php?confirm_id=<?php echo $order['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to confirm this order?')"><i class='bx bx-check-circle'></i></a> |
                            <a href="manage_orders.php?cancel_id=<?php echo $order['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to cancel this order?')"><i class='bx bxs-x-circle'></i></a> |
                            <a href="delete_order.php?id=<?php echo $order['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?')"><i class='bx bxs-trash'></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
