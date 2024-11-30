<?php

// Check if the user is an admin
// if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
//     header('Location: control_panel.php'); // Redirect to login page if not an admin
//     exit;
// }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Admin Dashboard - User Management</title>
    <link rel="stylesheet" href="style2.css">
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    table th {
        background-color: #007bff;
        color: #fff;
    }

    .btn {
        padding: 8px 16px;
        background-color: #28a745;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #218838;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .add-user-btn {
        display: inline-block;
        margin-bottom: 20px;
        text-align: right;
        width: 100%;
    }

    .add-user-btn button {
        background-color: #007bff;
    }

    .add-user-btn button:hover {
        background-color: #0056b3;
    }

    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f4f7;
    display: flex;
    height: 100vh;
}

.admin-container {
    display: flex;
    width: 100%;
}

.sidebar {
    width: 250px;
    background-color: #333333b5;
    padding: 20px;
    color: white;
}

.sidebar-header {
    margin-bottom: 30px;
}

.sidebar h2 {
    color: #fcbe7c;
    font-size: 24px;
    text-align: center;
}

.nav-links {
    list-style: none;
    padding-left: 0;
}

.nav-links li {
    margin: 15px 0;
}

.nav-links a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    padding: 10px;
    display: block;
    transition: background-color 0.3s ease;
}

.nav-links a:hover {
    background-color: #fcbe7c;
    color: #333;
}

.logout {
    margin-top: 50px;
}

.logout a {
    text-decoration: none;
    color: white;
    padding: 10px 15px;
    background-color: #ff6f00;
    display: inline-block;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.logout a:hover {
    background-color: #e65c00;
}
</style>

<body>


    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>Admin Dashboard</h2>
        </div>
        <ul class="nav-links">
            <li><a href="manage_orders.php">Manage Orders</a></li>
            <li><a href="manage_bookings.php">Manage Bookings</a></li>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="manage_reservations.php">Manage Reservations</a></li>
            <li><a href="admin.php">Manage Menu</a></li>
            <li><a href="manage_events.php">Manage Events</a></li>

            <li><a href="index.php">Home</a></li>
        </ul>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
    </aside>

    <div class="container">
        <h1>User Management</h1>

        <div class="add-user-btn">
            <button class="btn" onclick="document.getElementById('addUserModal').style.display='block'">Add User</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                @include 'config.php';
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['user_id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['user_type']}</td>
                                <td>
                                    <button class='btn' onclick='editUser({$row['user_id']})'>Edit</button>
                                    <button class='btn btn-danger' onclick='deleteUser({$row['user_id']})'>Delete</button>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0, 0, 0, 0.5);">
        <div style="background-color:#fff; width: 50%; margin: 10% auto; padding: 20px; border-radius: 8px;">
            <h2>Add New User</h2>
            <form action="manage_users.php" method="POST">
                <input type="text" name="name" placeholder="Enter name" required><br><br>
                <input type="email" name="email" placeholder="Enter email" required><br><br>
                <input type="password" name="password" placeholder="Enter password" required><br><br>
                <select name="user_type" required>
                    <option value="User">User</option>
                    <option value="Staff">Staff</option>
                    <option value="Admin">Admin</option>
                </select><br><br>
                <button type="submit" class="btn">Add User</button>
                <button type="button" class="btn btn-danger" onclick="document.getElementById('addUserModal').style.display='none'">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function editUser(id) {
            window.location.href = 'edit_user.php?id=' + id;
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = 'delete_user.php?id=' + id;
            }
        }
    </script>
</body>

</html>

<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $user_type = $_POST['user_type'];

    // Check if user already exists
    $check = "SELECT * FROM users WHERE email='$email'";
    $check_result = mysqli_query($conn, $check);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('User already exists!'); window.location.href='manage_users.php';</script>";
    } else {
        // Insert new user
        $insert = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        if (mysqli_query($conn, $insert)) {
            echo "<script>alert('User added successfully!'); window.location.href='manage_users.php';</script>";
        } else {
            echo "<script>alert('Error adding user!'); window.location.href='manage_users.php';</script>";
        }
    }
}
?>
