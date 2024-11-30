<?php
// Assume you have a database connection setup in config.php
include 'config.php'; 

$query = "SELECT * FROM events ORDER BY event_date ASC"; 
$select_events = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <title>Restaurant Events</title>
    <link rel="stylesheet" href="events.css">
</head>

<style>
    /* Google Fonts */
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f9;
        color: #333;
    }

    header {
        background-color: #343a40;
        color: white;
        padding: 20px 0;
        text-align: center;
        top: 95px;
        position: fixed;
        width: 100%;
        z-index: 1;
    }

    header h1 {
        font-weight: 500;
        margin: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .events-container {
        display: grid;
        /* grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px; */
        padding: 40px 20px;
        margin: 150px auto;
    }

    .event-card {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-10px);
    }

    .event-image {
        width: 350px;
        height: 200px;
        object-fit: cover;
    }

    .event-info {
        padding: 20px;
    }

    .event-info h2 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #007bff;
    }

    .event-info p {
        margin: 5px 0;
        color: #455;
        font-weight: 530;
    }

    .event-info p strong {
        font-weight: 600;
        color: #333;
    }

    .btn {
        display: inline-block;
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        text-align: center;
        cursor: pointer;
        font-size: 1rem;
        margin-top: 10px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #218838;
    }

    .btn.disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: white;
        margin: 10% auto;
        padding: 20px;
        width: 120%;
        max-width: 500px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .modal h2 {
        margin-bottom: 20px;
        font-weight: 500;
    }

    .input-group {
        margin-bottom: 15px;
    }

    .input-group label {
        font-weight: 500;
        margin-bottom: 5px;
        display: block;
    }

    .input-group input {
        width: 90%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .close-btn {
        position: absolute;
        right: 10px;
        top: 10px;
        font-size: 1.5rem;
        color: #333;
        cursor: pointer;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .modal-content {
            width: 90%;
        }

        .events-container {
            grid-template-columns: 1fr;
        }
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
            <a href="events.php">
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


<!-- Header Section -->
<header>
    <div class="container">
        <h1>Events in Our Restaurant</h1>
    </div>
</header>

<!-- Events Section -->
<div class="events-container">
    <?php
    if (mysqli_num_rows($select_events) > 0) {
        while ($row = mysqli_fetch_assoc($select_events)) {
    ?>
        <div class="event-card">
            <img src="uploadedimage/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['e_name']); ?>" class="event-image">
            <div class="event-info">
                <h2><?php echo htmlspecialchars($row['e_name']); ?></h2>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($row['event_date']); ?></p>
                <p><?php echo htmlspecialchars($row['description']); ?></p>
                <p><strong>Available Tickets:</strong> <?php echo htmlspecialchars($row['available_tickets']); ?></p>
                
                <!-- Disable the button if tickets are sold out -->
                <?php if ($row['available_tickets'] > 0) { ?>
                    <button class="btn" onclick="bookEvent('<?php echo htmlspecialchars($row['id']); ?>', '<?php echo htmlspecialchars($row['e_name']); ?>', '<?php echo htmlspecialchars($row['available_tickets']); ?>')">Book Now</button>
                <?php } else { ?>
                    <button class="btn" disabled>Sold Out</button>
                <?php } ?>
            </div>
        </div>
    <?php
        }
    } else {
        echo '<p>No events scheduled at the moment.</p>';
    }
    ?>
</div>

<!-- Booking Modal -->
<div id="booking-modal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Book your ticket</h2>
        <form id="booking-form" method="POST" action="book_ticket.php">
            <input type="hidden" name="event_id" id="event-id">
            <input type="hidden" name="available_tickets" id="available-tickets">

            <div class="input-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-group">
                <label for="tickets">Number of Tickets:</label>
                <input type="number" id="tickets" name="tickets" min="1" required>
            </div>
            
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</div>

<script src="events.js"></script>
</body>
</html>
