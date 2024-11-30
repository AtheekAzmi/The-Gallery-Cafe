<?php
session_start();

// Check if the user is an admin, redirect if not
// if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
//     header("Location: admin_login.php");
//     exit;
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Admin Control Panel</title>
    <link rel="stylesheet" href="control_panel.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f7;
    background-image: url(images/);
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

</style>

<body>

<div class="admin-container">
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Staff Dashboard</h2>
        </div>
        <ul class="nav-links">
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_bookings.php">Manage Bookings</a></li>
            <li><a href="manage_reservations.php">Manage Reservations</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </aside>

    <main class="content">
        <?php
        echo "<h1></h1>";
        ?>
        <h1>Welcome to Staff Control Panel</h1>
        <p>Use the sidebar to navigate through different management sections.</p>
    </main>
</div>

</body>
</html>
