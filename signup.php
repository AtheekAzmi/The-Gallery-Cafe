<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <title>Register</title>
    <style>
        /* General styling for the form container */
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

        /* Form heading */
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        /* Input fields styling */
        .form-container input[type="text"],
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

        /* Focus effect on input fields */
        .form-container input[type="text"]:focus,
        .form-container input[type="email"]:focus,
        .form-container input[type="password"]:focus {
            border-color: #007bff;
        }

        /* Error message styling */
        .form-container .error-msg {
            color: #d9534f;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }

        /* Submit button styling */
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

        /* Hover effect on submit button */
        .form-container .form-btn:hover {
            background-color: #218838;
        }

        /* Link styling */
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

        /* Hover effect on links */
        .form-container a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" id="registerForm">
            <h3>Customer Register</h3>
            <?php
            if (isset($error) && !empty($error)) {
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . htmlspecialchars($errorMsg) . '</span>';
                }
            }
            ?>
            <input type="text" placeholder="Enter your name" name="name" required><br>
            <input type="email" placeholder="Enter your email" name="email" required><br>
            <input type="password" placeholder="Enter your password" name="password" id="password" required><br>
            <input type="password" placeholder="Confirm password" name="cpassword" id="cpassword" required><br>
            <span class="error-msg" id="passwordError"></span><br>
            <input type="submit" name="submit" value="Register now" class="form-btn">
            <p>Already have an account? <a href="login.php">Login now</a></p>
        </form>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            var password = document.getElementById('password').value;
            var cpassword = document.getElementById('cpassword').value;
            var passwordError = document.getElementById('passwordError');

            if (password !== cpassword) {
                event.preventDefault();
                passwordError.textContent = "Passwords do not match!";
            } else {
                passwordError.textContent = "";
            }
        });
    </script>
</body>
</html>

<?php
// Start the session if not already started
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Include database configuration file
@include 'config.php';

// Check if form is submitted
if (isset($_POST['submit'])) {
    $error = array(); // Initialize the error array

    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if user already exists
    $select = "SELECT * FROM user_table WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $select);

    if (!$result) {
        $error[] = 'Database query error.';
    } elseif (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        // Check if passwords match
        if ($password != $cpassword) {
            $error[] = 'Passwords do not match!';
        } else {
            // Insert new user into the database without hashing the password
            $insert = "INSERT INTO user_table (name, email, password) VALUES ('$name', '$email', '$password')";
            if (mysqli_query($conn, $insert)) {
                // Output the redirection JavaScript separately to avoid issues
                echo "<script>
                        alert('Registration successful! Redirecting to login page. 🤗');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            } else {
                $error[] = 'Error: Could not register. Please try again later.';
            }
        }
    }
}
?>


