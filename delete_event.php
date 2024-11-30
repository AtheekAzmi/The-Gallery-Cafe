<?php
include 'config.php';

if (isset($_GET['id'])) {
    $event_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete the event
    $delete_query = "DELETE FROM events WHERE id = '$event_id'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('Event deleted successfully'); window.location.href='manage_events.php';</script>";
    } else {
        echo "<script>alert('Error deleting event'); window.location.href='events.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='events.php';</script>";
}
?>
