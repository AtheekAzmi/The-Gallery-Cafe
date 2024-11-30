<?php
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the reservation
    $sql = "DELETE FROM reservations WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation deleted successfully!";
    } else {
        echo "Error deleting reservation: " . $conn->error;
    }
}

$conn->close();

// Redirect to the manage reservations page after deletion
header("Location: manage_reservations.php");
exit();
?>
