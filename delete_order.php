<?php
// include 'config.php'; // Include your database connection settings
// // session_start();

// // // Check if the user is an admin
// // if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
// //     header('Location: login.php'); // Redirect to login page if not an admin
// //     exit;
// // }

// // Get the order ID from the URL
// $order_id = $_GET['id'];

// // Sanitize the order ID to prevent SQL injection
// $order_id = mysqli_real_escape_string($conn, $order_id);

// // Delete the order from the database
// $delete_query = mysqli_query($conn, "DELETE FROM `orders` WHERE `id` = '$order_id'");

// if ($delete_query) {
//     echo "<script>alert('Order deleted successfully!'); window.location.href = 'manage_orders.php';</script>";
// } else {
//     echo "<script>alert('Error deleting order!'); window.location.href = 'manage_orders.php';</script>";
// }

?>

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

// Check if 'id' is set in the URL and sanitize it
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id']; // Cast to an integer for safety
    
    // Check if the order exists before trying to delete
    $check_query = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $check_query->bind_param("i", $id);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        // If the order exists, proceed with deletion
        $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "<script>alert('Order deleted successfully!'); window.location.href = 'manage_orders.php';</script>";
        } else {
            echo "<script>alert('Error deleting order: " . $conn->error . "'); window.location.href = 'manage_orders.php';</script>";
        }

        $stmt->close();
    } else {
        // Order does not exist
        echo "<script>alert('Order not found with ID: $id'); window.location.href = 'manage_orders.php';</script>";
    }
    
    $check_query->close();
} else {
    // Invalid or missing order ID
    echo "<script>alert('Invalid order ID!'); window.location.href = 'manage_orders.php';</script>";
}

// Close the database connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Order</title>
</head>

<body>
    <!-- No need for a form or any content, just a simple redirect -->
</body>
</html>