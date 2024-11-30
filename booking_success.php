<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <!-- <link rel="stylesheet" href="events.css"> -->
    <title>Booking Successful</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&display=swap');

    body{
        font-family: "M PLUS Rounded 1c", sans-serif; 
    }

    .container h1{
        text-align: center;
    }
.success-message {
    background-color: #e6ffe6;
    border: 1px solid #00cc44;
    padding: 30px;
    border-radius: 8px;
    width: 50%;
    margin: 0 auto 80px auto;
}

.success-message h2 {
    color: #00cc44;
}

.success-message p {
    font-size: 1.2rem;
    color: #555;
}

.success-message .btn {
    background-color: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.success-message .btn:hover {
    background-color: #218838;
}

.success img{
    display: block;
    margin: 0 auto;
    width: 15%;
}

.success h2{
    text-align: center;
}
.success{
    margin-bottom: -50px;
}
</style>

<body>

<header>
    <div class="container">
        <h1>Booking Confirmation</h1>
    </div>
</header>

    <div class='success'>
        <img src='assets/event_booked.gif' class='giffy'>
    </div><br>

<div class="container">
    <div class="success-message" style="text-align: center; margin-top: 50px;">
        <h2>Thank you for your booking!</h2>
        <p>Your tickets have been successfully booked. You will receive a confirmation email shortly.</p>
        <p><a href="events.php" class="btn">Go Back to Events</a></p>
    </div>
</div>

</body>
</html>
