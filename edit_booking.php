<?php
include 'config.php'; // Database connection

// Fetch the booking details
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    $query = "SELECT * FROM bookings WHERE id = '$booking_id'";
    $result = mysqli_query($conn, $query);
    $booking = mysqli_fetch_assoc($result);
}

// Handle form submission for booking update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $tickets = mysqli_real_escape_string($conn, $_POST['tickets']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update_query = "UPDATE bookings SET name = '$name', email = '$email', tickets = '$tickets', status = '$status' WHERE id = '$booking_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Booking updated successfully!'); window.location.href='manage_bookings.php';</script>";
    } else {
        echo "<script>alert('Error updating booking!'); window.location.href='edit_booking.php?id=$booking_id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>

<div class="container">
    <h1>Edit Booking</h1>

    <form action="edit_booking.php" method="POST">
        <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">

        <div class="input-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($booking['name']); ?>" required>
        </div>

        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($booking['email']); ?>" required>
        </div>

        <div class="input-group">
            <label for="tickets">Tickets:</label>
            <input type="number" id="tickets" name="tickets" value="<?php echo htmlspecialchars($booking['tickets']); ?>" min="1" required>
        </div>

        <div class="input-group">
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending" <?php echo $booking['status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                <option value="Confirmed" <?php echo $booking['status'] == 'Confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Cancelled" <?php echo $booking['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn">Update Booking</button>
    </form>
</div>

</body>
</html>
