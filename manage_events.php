<?php
// Assume you have a database connection setup in config.php
include 'config.php'; 

$query = "SELECT * FROM events ORDER BY event_date ASC"; 
$select_events = mysqli_query($conn, $query);

// Check if the query was successful
if (!$select_events) {
    // Output the MySQL error for debugging
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Restaurant Events</title>
    <link rel="stylesheet" href="events_copy.css">


<!-- <style>


</style> -->
</head>

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

    

    <div class="events-container">

    <h2 class="title"> Manage Events</h2>

        <div class="addevent">
            <button onclick="location.href='add_event.php'">Add Event</button>
        </div>

        <?php
        if (mysqli_num_rows($select_events) > 0) {
            while ($row = mysqli_fetch_assoc($select_events)) {
        ?>
            <div class="event-card">
                <img src="uploadedimage/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['e_name']); ?>" class="event-image">
                <div class="event-info">
                    <h2><?php echo htmlspecialchars($row['e_name']); ?></h2>
                    <h3>Event Id: #<?php echo htmlspecialchars($row['id']); ?></h3>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <p><strong>Available Tickets:</strong> <?php echo htmlspecialchars($row['available_tickets']); ?></p>

                    <div class="event-actions">
                        <button class="btn edit-btn" onclick="window.location.href='edit_event.php?id=<?php echo htmlspecialchars($row['id']); ?>'">Edit</button>
                        <button class="btn delete-btn" onclick="confirmDelete('<?php echo htmlspecialchars($row['id']); ?>')">Delete</button>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<p>No events scheduled at the moment.</p>';
        }
        ?>
    </div>

    <script>
        function confirmDelete(eventId) {
            if (confirm('Are you sure you want to delete this event?')) {
                window.location.href = 'delete_event.php?id=' + eventId;
            }
        }
    </script>

</body>
</html>
