<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle confirm action
if (isset($_GET['confirm_id'])) {
    $confirm_id = $_GET['confirm_id'];
    $conn->query("UPDATE `reservations` SET `status` = 'confirmed' WHERE `id` = $confirm_id");
    header("Location: manage_reservations.php");
    exit();
}

// Handle cancel action
if (isset($_GET['cancel_id'])) {
    $cancel_id = $_GET['cancel_id'];
    $conn->query("UPDATE `reservations` SET `status` = 'canceled' WHERE `id` = $cancel_id");
    header("Location: manage_reservations.php");
    exit();
}

// Fetch reservations from the database
$sql = "SELECT * FROM reservations";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Manage Reservations</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<style>
    /* body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    } */

    .reservation-container {
        width: 80%;
        margin-top: 20px;
    }

    .reservation-container h1{
        text-align: center;
    }

    table {
        width: 90%;
        border-collapse: collapse;
        margin-left: 30px;
        margin-top: 30px;
    }

    table, th, td {
        border: 1px solid #ddd;
        padding: 10px;
        font-size: 15px;
    }

    th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #28a745;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .edit-btn, .delete-btn, .confirm-btn, .cancel-btn {
        padding: 5px 10px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 20px;
    }

    /* --------- */
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
    color: gray;
}
    
</style>

<body>
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

<div class="reservation-container">
    <h1>Manage Reservations</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                            <td>{$row['guests']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='edit_reservation.php?id={$row['id']}' class='edit-btn'><i class='bx bxs-edit-alt'></i></a>
                                <a href='delete_reservation.php?id={$row['id']}' class='delete-btn' onclick=\"return confirm('Are you sure you want to delete this reservation?');\"><i class='bx bx-trash'></i></a>
                                <a href='manage_reservations.php?confirm_id={$row['id']}' class='confirm-btn' onclick=\"return confirm('Are you sure you want to confirm this reservation?');\"><i class='bx bxs-check-circle'></i></a>
                                <a href='manage_reservations.php?cancel_id={$row['id']}' class='cancel-btn' onclick=\"return confirm('Are you sure you want to cancel this reservation?');\"><i class='bx bx-x-circle'></i></a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No reservations found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
