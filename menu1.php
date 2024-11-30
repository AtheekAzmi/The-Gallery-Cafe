<?php
include 'config.php'; 

$category = isset($_GET['category']) ? mysqli_real_escape_string($conn, $_GET['category']) : '';
$type = isset($_GET['type']) ? mysqli_real_escape_string($conn, $_GET['type']) : '';
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$query = "SELECT * FROM products WHERE 1"; // Base query

if (!empty($category)) {
    $query .= " AND category = '$category'";
}

if (!empty($type)) {
    $query .= " AND f_type = '$type'";
}

if (!empty($search)) {
    $query .= " AND name LIKE '%$search%'";
}

$select_products = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="menustyle.css">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <!-- Include Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>Food Menu</title>
    
</head>

<!-- <style>

body {
    background: url(images/pattern.avif);
    background-repeat: repeat;
    background-size: 20%;
    color: #333;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    overflow: scroll; /* Prevent scrolling */
}
   

</style> -->

<body>
<!-- <video class="video-background" autoplay muted loop>
    <source src="v11.mp4" type="video/mp4">
    Your browser does not support the video tag.
</video> -->

<!-- Navigation Bar -->
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


<div class="menu-container">

<!-- Slider for Daily Offers -->
<div class="swiper-container offer-slider">
    <div class="swiper-wrapper">
        <!-- Slide 1 -->
        <div class="swiper-slide">
            <img src="assets/offer1.jpg" alt="Offer 1" />
            <div class="offer-info">
                <h2>Special Discount on Sri Lankan Dishes!</h2>
                <p>Enjoy 20% off today!</p>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="swiper-slide">
            <img src="assets/asset 24.jpeg" alt="Offer 2" />
            <div class="offer-info">
                <h2>Get Free Beverages</h2>
                <p>Buy 1 Get 1 Free on selected beverages.</p>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="swiper-slide">
            <img src="assets/asset 36.jpeg" alt="Offer 3" />
            <div class="offer-info">
                <h2>Special Combo Deals</h2>
                <p>Combo offers starting from LKR 499/-</p>
            </div>
        </div>
        <!-- Slide 4 -->
        <div class="swiper-slide">
            <img src="assets/asset 26.jpeg" alt="Offer 3" />
            <div class="offer-info">
                <h2>Special Combo Deals</h2>
                <p>Combo offers starting from LKR 499/-</p>
            </div>
        </div>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>


    <h1>Our Food Menu</h1>

    <!-- Dropdown for sorting -->
    <form method="GET" class="sort-form" style="margin-bottom: 35px;">
        <input type="text" name="search" placeholder="Search food..." value="<?php echo htmlspecialchars($search); ?>" style="padding: 10px; border-radius: 5px; font-size: 16px; border: none; box-shadow: 0 5px 12px gray; background-color: #ffb259;">
        <select name="category" onchange="this.form.submit()" style="padding: 10px; border-radius: 5px; font-size: 16px; border: none; box-shadow: 0 5px 12px gray; background-color: #ffb259;">
            <option value="">All Categories</option>
            <option value="Sri Lankan" <?php if (isset($_GET['category']) && $_GET['category'] == 'Sri Lankan') echo 'selected'; ?>>Sri Lankan</option>
            <option value="Chinese" <?php if (isset($_GET['category']) && $_GET['category'] == 'Chinese') echo 'selected'; ?>>Chinese</option>
            <option value="Italian" <?php if (isset($_GET['category']) && $_GET['category'] == 'Italian') echo 'selected'; ?>>Italian</option>
            <option value="Indian" <?php if (isset($_GET['category']) && $_GET['category'] == 'Indian') echo 'selected'; ?>>Indian</option>
            <option value="Arabian" <?php if (isset($_GET['category']) && $_GET['category'] == 'Arabian') echo 'selected'; ?>>Arabian</option>
        </select>

        <select name="type" onchange="this.form.submit()" style="padding: 10px; border-radius: 5px; font-size: 16px; margin-left: 10px; border: none; box-shadow: 0 5px 12px gray; background-color:#ffb259;">
            <option value="">All Types</option>
            <option value="Food" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Food') echo 'selected'; ?>>Food</option>
            <option value="Beverages" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Beverages') echo 'selected'; ?>>Beverages</option>
            <option value="Salad" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Salad') echo 'selected'; ?>>Salad</option>
            <option value="Special" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Special') echo 'selected'; ?>>Special</option>
            <option value="Side Dish" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Side Dish') echo 'selected'; ?>>Side Dish</option>
            <option value="Desserts" <?php if (isset($_GET['f_type']) && $_GET['f_type'] == 'Desserts') echo 'selected'; ?>>Desserts</option>
        </select>
    </form>

    
    <div class="menu-items">
        <?php
        if (mysqli_num_rows($select_products) > 0) {
            while ($row = mysqli_fetch_assoc($select_products)) {
        ?>
                <div class="menu-item">
                    <img src="uploadedimage/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="menu-item-image">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Price: LKR <?php echo htmlspecialchars($row['price']); ?></p>
                    <form method="post" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['image']); ?>">
                        <button type="submit" class="btn" name="add_to_cart"><i class='bx bxs-cart-add'></i></button>
                    </form>
                </div>
        <?php
            }
        } else {
            echo '<p>No food items available yet.</p>';
        }
        ?>
    </div>


    
</div>

</body>
<script>
  var swiper = new Swiper('.offer-slider', {
    loop: true,
    autoplay: {
      delay: 5000, // Slide delay in milliseconds
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });
</script>

</html>
