<?php
@include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE FROM users WHERE user_id='$id'";
    if (mysqli_query($conn, $delete)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!'); window.location.href='manage_users.php';</script>";
    }
}
?>

<!-- 


<?php
@include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = "DELETE FROM orders WHERE id='$id'";
    if (mysqli_query($conn, $delete)) {
        echo "<script>alert('User deleted successfully!'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error deleting user!'); window.location.href='manage_users.php';</script>";
    }
}
?>

manage_orders.php

-->