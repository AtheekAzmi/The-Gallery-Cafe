<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session to manage user login state
session_start();

// Include database configuration file
@include 'config.php'; // Make sure this file exists and has the correct DB credentials

// Initialize the $loginError variable as an array
$loginError = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])) {
    // Sanitize and retrieve user input
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $usertype = $_POST['user_type'];

    // Check if connection is established
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a matching user is found
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['user_id']; // Set session variables
            $_SESSION['user_email'] = $user['email'];

            // Redirect to index.php
            header("Location: http://localhost/cafe/control_panel_staff.php");
            exit(); // Ensure the script stops after redirect
        } else {
            $loginError[] = "Invalid staff email or password.";
        }

        // Close statement
        $stmt->close();
    } else {
        // Debugging output for statement preparation errors
        $loginError[] = "Failed to prepare SQL statement: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <title>Login</title>
    <style>
        /* Your existing styles */
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
        }

        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .form-container input[type="email"]:focus,
        .form-container input[type="password"]:focus {
            border-color: #007bff;
        }

        .form-container .error-msg {
            color: #d9534f;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        .form-container .form-btn {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .form-container .form-btn:hover {
            background-color: #218838;
        }

        .form-container p {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }

        .form-container a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .form-container a:hover {
            color: #0056b3;
        }

        .form-container select {
            height: 30px;
            width: 40%;
            border-radius: 6px;
            font-size: 15px;
            background-color: #fff;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <form action="" method="post" id="loginForm">
            <h3>Staff Login</h3>
            <?php
            // Display error messages if there are any
            if (!empty($loginError)) {
                foreach ($loginError as $errorMsg) {
                    echo '<span class="error-msg">' . htmlspecialchars($errorMsg) . '</span>';
                }
            }
            ?>
            <input type="email" placeholder="Enter your email" name="email" required><br>
            <input type="password" placeholder="Enter your password" name="password" required><br>
            <select name="user_type">
                <option>Staff</option>
            </select>
            <input type="submit" name="login" value="Login now" class="form-btn">
            <p>Are you admin? <a href="login-admin.php">Admin Login</a></p>

            <!-- Hidden field to pass PHP error to JavaScript -->
            <input type="hidden" id="phpError" value="<?php echo htmlspecialchars(implode(', ', $loginError)); ?>">
        </form>
    </div>

</body>

<script>
    // Get the error message from the hidden input
    var loginError = document.getElementById('phpError').value;

    // Show an alert if the error message is not empty
    if (loginError) {
        alert(loginError);
    }
</script>

</html>
