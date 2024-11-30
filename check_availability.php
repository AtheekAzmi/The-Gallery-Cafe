<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Assuming the restaurant has 5 tables
    $max_tables = 8;

    // Query to check how many reservations are already made for the selected date and time
    $sql = "SELECT COUNT(*) as total_reservations FROM reservations WHERE date='$date' AND time='$time'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($row['total_reservations'] >= $max_tables) {
        // No tables available
        $response = array('available' => false);
    } else {
        // Tables available
        $response = array('available' => true);
    }

    echo json_encode($response);
}

$conn->close();
?>
