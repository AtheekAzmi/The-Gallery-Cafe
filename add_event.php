<?php
include 'config.php'; // Database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $available_tickets = mysqli_real_escape_string($conn, $_POST['available_tickets']); // New ticket field

    // Image Upload Handling
    if ($_FILES['image']['name']) {
        $image_name = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_folder = 'uploadedimage/' . $image_name;

        if (move_uploaded_file($image_tmp, $image_folder)) {
            // Insert event details into the database
            $query = "INSERT INTO events (e_name, description, event_date, image, available_tickets) 
                      VALUES ('$name', '$description', '$event_date', '$image_name', '$available_tickets')";

            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Event added successfully'); window.location.href='manage_events.php';</script>";
            } else {
                echo "<script>alert('Error adding event'); window.location.href='add_event.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image'); window.location.href='add_event.php';</script>";
        }
    } else {
        echo "<script>alert('Please upload an image'); window.location.href='add_event.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Add Event</title>
    <link rel="stylesheet" href="addevent_style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Add New Event</h1>
            <form action="add_event.php" method="POST" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="name">Event Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="input-group">
                    <label for="description">Event Description:</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>

                <div class="input-group">
                    <label for="event_date">Event Date:</label>
                    <input type="date" id="event_date" name="event_date" required>
                </div>

                <div class="input-group">
                    <label for="image">Upload Event Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required>
                </div>
                
                <!-- New Input Group for Available Tickets -->
                <div class="input-group">
                    <label for="available_tickets">Available Tickets:</label>
                    <input type="number" id="available_tickets" name="available_tickets" min="1" required>
                </div>

                <button type="submit" class="btn">Add Event</button>
            </form>
        </div>
    </div>
</body>
</html>
