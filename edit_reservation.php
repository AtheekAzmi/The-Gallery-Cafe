<?php
$servername = "localhost";
$username = "root";
$password = "pass123";
$dbname = "gallery_cafe";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an empty $reservation array to avoid undefined variable warning
$reservation = array();

// Check if an ID is provided in the URL query string
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the reservation details based on the provided ID
    $sql = "SELECT * FROM reservations WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $reservation = $result->fetch_assoc();
    } else {
        echo "No reservation found!";
        exit();
    }
}

// Check if the form has been submitted to update the reservation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    // Update the reservation details in the database
    $sql = "UPDATE reservations SET name='$name', email='$email', phone='$phone', date='$date', time='$time', guests='$guests' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='success-message'>
    <h2>Reservation Updated</h2>
    <img src='assets/reserved.gif' class='giffy'>
</div><br>";
    } else {
        echo "Error updating reservation: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
        }

        .edit-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin: 60px 0 60px 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 0;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .error-message {
            text-align: center;
            color: red;
            font-weight: bold;
        }

        .success-message {
            text-align: center;
            color: green;
            font-weight: bold;
            position: absolute;
            top: 50px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
        img{
            width: 20%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="edit-form-container">
        
        <?php if (!empty($reservation)) { ?>

            <h1>Edit Reservation</h1>
            <form method="POST" action="edit_reservation.php">
                <input type="hidden" name="id" value="<?php echo $reservation['id']; ?>">

                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($reservation['name']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($reservation['email']); ?>" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($reservation['phone']); ?>" required>

                <label for="date">Reservation Date:</label>
                <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($reservation['date']); ?>" required>

                <label for="time">Reservation Time:</label>
                <input type="time" id="time" name="time" value="<?php echo htmlspecialchars($reservation['time']); ?>" required>

                <label for="guests">Number of Guests:</label>
                <input type="number" id="guests" name="guests" value="<?php echo htmlspecialchars($reservation['guests']); ?>" min="1" max="10" required>

                <input type="submit" value="Update Reservation">
            </form>
        <?php } else { ?>
            <p class="error-message">Reservation not found or no reservation ID provided.</p>
        <?php } ?>

        <a href="manage_reservations.php" class="back-link">Go Back to Reservations</a>
    </div>
</body>
</html>
