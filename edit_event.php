<?php
include 'config.php';

if (isset($_GET['id'])) {
    $event_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the event details
    $query = "SELECT * FROM events WHERE id = '$event_id'";
    $result = mysqli_query($conn, $query);
    $event = mysqli_fetch_assoc($result);
    
    if (!$event) {
        echo "<script>alert('Event not found'); window.location.href='manage_events.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='manage_events.php';</script>";
    exit;
}

// Update event details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $available_tickets = mysqli_real_escape_string($conn, $_POST['available_tickets']);

    $image_name = $event['image']; // Keep the current image if no new image is uploaded

    // Handle new image upload if present
    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['e_name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = 'uploadedimage/' . $image_name;
        move_uploaded_file($image_tmp, $image_folder);
    }

    // Update query
    $update_query = "UPDATE events SET e_name='$name', description='$description', event_date='$event_date', available_tickets='$available_tickets', image='$image_name' WHERE id='$event_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Event updated successfully'); window.location.href='manage_events.php';</script>";
    } else {
        echo "<script>alert('Error updating event'); window.location.href='edit_event.php?id=$event_id';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Edit Event</title>
    <link rel="stylesheet" href="addevent_style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Edit Event</h1>
            <form action="edit_event.php?id=<?php echo htmlspecialchars($event['id']); ?>" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="name">Event Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($event['e_name']); ?>" required>
                </div>
                
                <div class="input-group">
                    <label for="description">Event Description:</label>
                    <textarea id="description" name="description" rows="5" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                </div>

                <div class="input-group">
                    <label for="event_date">Event Date:</label>
                    <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($event['event_date']); ?>" required>
                </div>

                <div class="input-group">
                    <label for="available_tickets">Available Tickets:</label>
                    <input type="number" id="available_tickets" name="available_tickets" value="<?php echo htmlspecialchars($event['available_tickets']); ?>" required>
                </div>

                <div class="input-group">
                    <label for="image">Upload Event Image:</label>
                    <input type="file" id="image" name="image" accept="image/*">
                    <p>Current Image: <img src="uploadedimage/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" width="100"></p>
                </div>

                <button type="submit" class="btn">Update Event</button>
            </form>
        </div>
    </div>
</body>
</html>
