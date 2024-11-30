<?php
include 'config.php'; // Database connection

// Handle delete booking
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $delete_query = "DELETE FROM bookings WHERE id = '$booking_id'";
    mysqli_query($conn, $delete_query);
    echo "<script>alert('Booking deleted successfully!'); window.location.href='manage_bookings.php';</script>";
}

// Handle confirm/cancel booking
if (isset($_GET['action']) && isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $status = $_GET['action'] === 'confirm' ? 'Confirmed' : 'Cancelled';
    $update_status_query = "UPDATE bookings SET status = '$status' WHERE id = '$booking_id'";
    mysqli_query($conn, $update_status_query);
    echo "<script>alert('Booking status updated!'); window.location.href='manage_bookings.php';</script>";
}

// Fetch all bookings
$query = "SELECT * FROM bookings ORDER BY created_at DESC";
$select_bookings = mysqli_query($conn, $query);
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
        <h1>Manage Bookings</h1>

        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Event ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Tickets</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($select_bookings) > 0) {
                while ($row = mysqli_fetch_assoc($select_bookings)) {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['event_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['tickets']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?php echo $row['id']; ?>" class="btn-edit"><i class='bx bxs-edit-alt'></i></a> |
                            <a href="manage_bookings.php?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this booking?')"><i class='bx bxs-trash-alt'></i></a> |
                            <a href="manage_bookings.php?action=confirm&id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to confirm this booking?')" class="btn-confirm"><i class='bx bx-check-circle'></i></a> |
                            <a href="manage_bookings.php?action=cancel&id=<?php echo $row['id']; ?>"  class="btn-cancel" ><i class='bx bxs-x-circle'></i></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='7'>No bookings found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </main>
</div>

</body>
</html>
