<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Restaurant Table Reservation</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #000;
        background-image: url(assets/asset\ 25.jpeg);
        background-repeat: no-repeat;
        background-size: 100%;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: auto;
    }

    .reservation-form {
        background-color: rgba(0, 0, 0, 0.73);
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0px 0px 10px 0px #000;
        margin: 250px 50px 60px 50px;
        width: 650px;
        backdrop-filter: blur(10px) black;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
        color: #ccc;
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
    }

    input[type="submit"] {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #218838;
    }

    #availability {
        margin-top: 20px;
        font-weight: bold;
        color:#ccc;
    }

    #success-message {
        color: green;
    }

    #error-message {
        color: red;
    }

    h1{
        color: #ccc;
    }

    button{
        background-color: transparent;
        margin-top: 20px;
        border: none;
        font-weight: 600;
    }

    button i{
        font-size: 35px;
        font-weight: 800;
    }

    button:hover{
        cursor: pointer;
        color: #cf7147;
    }

    /* Navigation Bar */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fcbe7c;
    padding: 12px 25px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    position: absolute;
    width: 96.7%;
    top: 0;
    z-index: 10;
}

.header .logo img {
    height: 50px;
    margin-left: 20px;
}

.header .bar {
    display: none; /* Hide for now; used for mobile */
}

.header .nav ul {
    display: flex;
    list-style: none;
    gap: 20px;
}

.header .nav ul a {
    text-decoration: none;
    color: #333;
}

.header .nav ul a li {
    padding: 10px 15px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.header .nav ul a li:hover {
    color: #c5a72d;
    background-color: #ffe942;
    box-shadow: 0 0 18px #ffe942;
    border-radius: 8px;
    border: none;
    transition: 0.5s ease;
}

.header .account ul {
    display: flex;
    list-style: none;
    gap: 15px;
}

.header .account ul a i {
    font-size: 24px;
    color: #333;
    margin-right: 20px;
}

.header .account ul a:hover i {
    color: #ff6f00;
}

</style>

<body>


<div class="header">
    <div class="logo">
        <a href="index.php"><img src="images/logo 1.png" alt="Logo"></a>
    </div>
    <div class="bar">
        <i class='bx bx-menu bx-md'></i>
        <i class='bx bx-x bx-md' id="cross"></i>
    </div>
    <div class="nav">
        <ul>
            <a href="#aboutus">
                <li>About</li>
            </a>
            <a href="menu1.php">
                <li>Menu</li>
            </a>
            <a href="#story">
                <li>Story</li>
            </a>
            <a href="#event">
                <li>Events</li>
            </a>
            <a href="reserve.php">
                <li>Reserve Online</li>
            </a>
        </ul>
    </div>
    <div class="account">
        <ul>
            <a href="#">
                <li>
                    <a href="#contactus"><i class='bx bx-phone-call bx-sm'></i></a>
                </li>
                <li>
                    <a><i class="bx bx-user bx-sm" id="user"></i></a>
                </li>
                <li>
                    <a><i class="fi fi-br-exit"></i></a>
                </li>
            </a>
        </ul>
    </div>
</div>


    <!-- <div class="bgimage">
        <img src="assets/asset 25.jpeg" alt="">
    </div> -->
    <div class="reservation-form">
        <h1>Table Reservation</h1>
        <form id="reservationForm" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Ex: John Wick" required><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="example@gmail.com" required><br>

            <label for="phone">Phone:</label>
            <input type="text" id="tel" name="phone" placeholder="07X-XXX-XXXX" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required><br>

            <label for="date">Reservation Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="time">Reservation Time:</label>
            <input type="time" id="time" name="time" required><br>

            <label for="guests">Number of Guests:</label>
            <input type="number" id="guests" name="guests" min="1" max="10" placeholder="Ex: 4" required><br>

            <input type="submit" value="Check Availability">
        </form>
        <div id="availability"></div>
        <div id="success-message"></div>
        <div id="error-message"></div>

        <button onclick="location.href='index.php'"><i class='bx bxs-chevrons-left' style='color:#f5af68'></i></button>
    </div>

    <script>
    document.getElementById('reservationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        // Check availability before submitting the reservation
        fetch('check_availability.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.available) {
                // Now submit the reservation if available
                fetch('reservation.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    // Redirect to reservation_status.php with appropriate status
                    window.location.href = 'reservation_status.php?status=success';
                })
                .catch(error => {
                    window.location.href = 'reservation_status.php?status=failed';
                });
            } else {
                // No availability message
                window.location.href = 'reservation_status.php?status=failed';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.href = 'reservation_status.php?status=failed';
        });
    });
</script>

</body>
</html>


