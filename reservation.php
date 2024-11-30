<?php
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "gallery_cafe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $guests = (int)$_POST['guests'];

    

    // Insert the reservation into the database
    $sql = "INSERT INTO reservations (name, email, phone, date, time, guests)
            VALUES ('$name', '$email', '$phone', '$date', '$time', '$guests')";

    if ($conn->query($sql) === TRUE) {
        echo "Reservation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $reservationSuccess = true; // or false based on logic

    if ($reservationSuccess) {
        // Redirect with success message
        header("Location: reservation_status.php?status=success");
    } else {
        // Redirect with error message
        header("Location: reservation_status.php?status=failed");
    }
    exit;
}

$conn->close();
?>
