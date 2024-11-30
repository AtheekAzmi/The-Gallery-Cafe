<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="style1.css">
    <title>Register-Staff</title>
</head>
<style>

    /* Container styling */
.form-container {
    width: 400px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
}

/* Form title */
.form-container h3 {
    text-align: center;
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

/* Input fields styling */
.form-container input[type="text"],
.form-container input[type="email"],
.form-container input[type="password"],
.form-container select {
    width: calc(100% - 20px);
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

/* Select dropdown */
.form-container select {
    height: 40px;
    background-color: #fff;
}

/* Error message styling */
.error-msg {
    display: block;
    color: #d9534f;
    font-size: 12px;
    margin-top: -8px;
    margin-bottom: 10px;
}

/* Submit button styling */
.form-container .form-btn {
    width: 100%;
    padding: 10px;
    background-color: #28a745;
    border: none;
    border-radius: 4px;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-container .form-btn:hover {
    background-color: #218838;
}

/* Link to login page */
.form-container p {
    text-align: center;
    margin-top: 10px;
}

.form-container a {
    color: #007bff;
    text-decoration: none;
}

.form-container a:hover {
    text-decoration: underline;
}


</style>


<body>
    
    <div class="form-container">
        <form action="" method="post" id="registerForm">

            <h3>Staff Register</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $errorMsg) {
                    echo '<span class="error-msg">' . $errorMsg . '</span>';
                }
            }
            ?>
            <input type="text" placeholder="Enter your name" name="name" required><br>
            <input type="email" placeholder="Enter your email" name="email" required><br>
            <input type="password" placeholder="Enter your password" name="password" id="password" required><br>
            <input type="password" placeholder="Confirm password" name="cpassword" id="cpassword" required><br>
            <span class="error-msg" id="passwordError"></span><br>
            <select name="user_type">
                <option>User</option>
                <option>Staff</option>
                <option>Admin</option>
            </select> 
            <input type="submit" name="submit" value="Register now" class="form-btn">
            <p>Already have an account? <a href="login-staff.php">Login now</a></p>
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

@include 'config.php';

if (isset($_POST['submit'])) {
    $error = array(); // Initialize the error array

    // Sanitize user inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $usertype = $_POST['user_type'];

    // Check if user already exists
    $select = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        // Check if passwords match
        if ($password != $cpassword) {
            $error[] = 'Passwords do not match!';
        } else {
            // Insert new user into the database without hashing the password
            $insert = "INSERT INTO users (name, email, password, user_type) VALUES ('$name', '$email', '$password', '$usertype')";
            if (mysqli_query($conn, $insert)) {
                header('location:login-staff.php');
            } else {
                $error[] = 'Error: Could not register. Please try again later.';
            }
        }
    }
}
?>

