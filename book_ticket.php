<?php
include 'config.php';

// Assuming you have form data validation and database logic here

if (isset($_POST['event_id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['tickets'])) {
    $event_id = $_POST['event_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $tickets = $_POST['tickets'];
    $available_tickets = $_POST['available_tickets'];

    // Insert booking information into the bookings table
    $query = "INSERT INTO bookings (event_id, name, email, tickets) VALUES ('$event_id', '$name', '$email', '$tickets')";
    
    if (mysqli_query($conn, $query)) {
        // Decrement the available tickets
        $new_available_tickets = $available_tickets - $tickets;
        $update_tickets_query = "UPDATE events SET available_tickets = '$new_available_tickets' WHERE id = '$event_id'";
        mysqli_query($conn, $update_tickets_query);
        
        // Redirect to success page
        header("Location: booking_success.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
