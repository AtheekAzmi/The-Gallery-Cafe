<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Reservation Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(0, 0, 0, 0.65);
            color: #ffb300;
            text-align: center;
        }

        .message-container {
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #000;
            display: inline-block;
            position: relative;
            top: 60px;
        }

        h1 {
            color: #28a74f;
        }

        p {
            font-size: 20px;
        }

        a {
            text-decoration: none;
            color: #28a745;
        }

        a:hover {
            color: #218838;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
        .exit{
            background-color: #ccc;
            color: black;
        }
        .exit:hover{
            background-color: red;
        }
        img{
            width: 25%;
        }
    </style>
</head>
<body>

    <div class="message-container">
        <?php
        $status = $_GET['status'] ?? '';

        if ($status == 'success') {
            echo "<div class='success-message'>
            <h2>Reservation Updated</h2>
            <img src='assets/reserveddone.gif' class='giffy'>
        </div><br>";
            echo "<h1>Reservation Confirmed!</h1>";
            echo "<p>Your table reservation was successful. We look forward to serving you!</p>";
        } elseif ($status == 'failed') {
            echo "<h1>Reservation Failed</h1>";
            echo "<p>Unfortunately, we were unable to reserve a table. Please try again later.</p>";
        }
        ?>
        <a href="reserve.php"><button>Make Another Reservation</button></a>
        <a href="index.php"><button class="exit">Exit</button></a>
    </div>

</body>
</html>
