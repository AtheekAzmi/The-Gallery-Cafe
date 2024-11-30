<?php
@include 'config.php';

// Check if the ID parameter is set and is not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare a SQL query to fetch the user details
    $query = "SELECT * FROM users WHERE user_id='$id'";
    $result = mysqli_query($conn, $query);

    // Check if the user exists in the database
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result); // Fetch user details
    } else {
        echo "<script>alert('User not found'); window.location.href='manage_users.php';</script>";
        exit; // Stop script execution if user not found
    }
} else {
    echo "<script>alert('Invalid user ID'); window.location.href='manage_users.php';</script>";
    exit; // Stop script execution if ID is missing or invalid
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_type = $_POST['user_type'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password reset if entered
    if (!empty($new_password) && $new_password === $confirm_password) {
        // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT); // Use password hashing for security
        $update_password_query = "UPDATE users SET password='$new_password' WHERE user_id='$id'";
        mysqli_query($conn, $update_password_query);
    } elseif (!empty($new_password)) {
        echo "<script>alert('Passwords do not match!');</script>";
    }

    // Update user information in the database
    $update = "UPDATE users SET name='$name', email='$email', user_type='$user_type' WHERE user_id='$id'";
    if (mysqli_query($conn, $update)) {
        echo "<script>alert('User updated successfully!'); window.location.href='manage_users.php';</script>";
    } else {
        echo "<script>alert('Error updating user!'); window.location.href='manage_users.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Edit User</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        /* Global Styling */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: calc(100% - 20px);
            padding: 12px 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        select {
            appearance: none;
            background-color: #fff;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #218838;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="" method="POST">
            <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
            <select name="user_type" required>
                <option value="User" <?php if ($user['user_type'] == 'User') echo 'selected'; ?>>User</option>
                <option value="Staff" <?php if ($user['user_type'] == 'Staff') echo 'selected'; ?>>Staff</option>
                <option value="Admin" <?php if ($user['user_type'] == 'Admin') echo 'selected'; ?>>Admin</option>
            </select><br>

            <!-- Password reset fields -->
            <input type="password" name="new_password" placeholder="New Password (optional)"><br>
            <input type="password" name="confirm_password" placeholder="Confirm New Password"><br>

            <button type="submit" class="btn">Update User</button>
        </form>
    </div>
</body>
</html>
